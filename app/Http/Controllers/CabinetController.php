<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Str;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->query('view', 'orders'); // по умолчанию «мои заказы», как у них
        $user = Auth::user();

        $orderCount = $user->orders()->count();

        $favorites = [];
        if ($view === 'favorites') {
            $favorites = $user->favorites()->latest()->get(); // если надо, подгружай связанные данные
            return view('cabinet.favorites', compact('favorites', 'view', 'user', 'orderCount'));
        }

        if ($view === 'orders') {
            $orders = $user->orders()
                ->with(['items.product']) // подгружаем товары в заказах
                ->latest()
                ->get();

            foreach ($orders as $order) {
                $order->bonus_earned = $user->transactions()
                    ->where('order_id', $order->id)
                    ->where('type', 'earn')
                    ->sum('amount');

            }

            return view('cabinet.orders', compact('orders', 'view', 'user', 'orderCount'));
        }

        if ($view === 'loyalty') {
            $loyaltyLevels = \App\Models\LoyaltyLevel::orderBy('bonus_percent')->get();
            $currentLevel = $user->loyaltyLevel;

            $subcategoryNames = $user->orders()
                ->with('items.product')
                ->get()
                ->pluck('items')
                ->flatten()
                ->pluck('product.subcategory')
                ->filter()
                ->unique();

            // ID уже купленных товаров
            $purchasedIds = $user->orders()
                ->with('items')
                ->get()
                ->pluck('items')
                ->flatten()
                ->pluck('product_id')
                ->unique();

            // Рекомендации из тех же подкатегорий, которых ещё не было в заказах
            $recommended = Product::whereIn('subcategory', $subcategoryNames)
                ->whereNotIn('id', $purchasedIds)
                ->inRandomOrder()
                ->take(10)
                ->get();


            $now = Carbon::now();
            $startOfMonth = $now->copy()->startOfMonth();
            $endOfMonth = $now->copy()->endOfMonth();
            
            // Показывать форму только в первые 3 дня месяца
            $hasChosenDiscounts = Discount::where('user_id', $user->id)
            ->where('type', 'category')
            ->whereMonth('created_at', now()->month)
            ->exists();

            $availableCategories = Category::all();

            $currentDiscount = Discount::where('user_id', $user->id)
                ->where('type', 'category')
                ->whereMonth('created_at', now()->month)
                ->first();

            return view('cabinet.loyalty', compact('user', 'loyaltyLevels', 'currentLevel','orderCount',
             'recommended', 'hasChosenDiscounts', 'availableCategories', 'currentDiscount'));
        }


        return view('cabinet.index', compact('view', 'user', 'orderCount'));
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'birthday' => 'required|date|before:2021-01-01',
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'phone', 'city', 'birthday']));

        return response()->json(['success' => true]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return response()->json(['success' => true]);
    }



    public function submitDiscountChoice(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        // Проверка — не создавал ли уже выбор в этом месяце
        $already = Discount::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->where('type', 'category')
            ->exists();

        if ($already) {
            return response()->json(['error' => 'Вы уже выбрали скидку в этом месяце.'], 422);
        }

        $code = strtoupper(Str::random(8)); // Пример: W3XZ8LQN

        // Создаём запись
        $discount = Discount::create([
            'user_id' => $user->id,
            'code' => $code,
            'type' => 'category',
            'target_id' => $request->category_id,
            'value' => 15, // например, 15%
            'valid_until' => now()->addMonth()->startOfMonth()->addDays(30),
        ]);

        

        $category = Category::find($request->category_id);

        return response()->json([
            'success' => true,
            'code' => $code,
            'category' => $category,
        ]);
    }


}

