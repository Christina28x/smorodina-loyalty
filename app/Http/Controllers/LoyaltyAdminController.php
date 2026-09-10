<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyLevel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;


class LoyaltyAdminController extends Controller
{
    public function index()
    {
        // Только админ
        if (auth()->user()?->is_admin != true) {
            abort(403);
        }

        $user = Auth::user();
        $orderCount = $user->orders()->count();
        $levels = LoyaltyLevel::orderBy('min_spending')->get();
        $settings = \App\Models\LoyaltySetting::first();
        $categories = Category::with('products')->get();

        $topCategories = \App\Models\Discount::select('target_id', \DB::raw('count(*) as total'))
            ->groupBy('target_id')
            ->orderByDesc('total')
            ->with('target')
            ->take(3)
            ->get();

        $categoryStats = \App\Models\Discount::select('target_id', \DB::raw('count(*) as total'))
            ->groupBy('target_id')
            ->with('target')
            ->get()
            ->filter(fn($item) => $item->target); // чтобы не было null

        $chartLabels = $categoryStats->pluck('target.rus_name');
        $chartData = $categoryStats->pluck('total');
        $topThree = $categoryStats->sortByDesc('total')->take(3);


        $loyaltyDistribution = User::select('loyalty_level_id', \DB::raw('count(*) as total'))
            ->groupBy('loyalty_level_id')
            ->with('loyaltyLevel') // связь user → loyaltyLevel
            ->get();

        $levelLabels = $loyaltyDistribution->map(fn($item) => $item->loyaltyLevel->level_name)->toArray();
        $levelData = $loyaltyDistribution->map(fn($item) => $item->total)->toArray();

        
        $ordersWithBonuses = Order::where('bonus_used', '>', 0)->count();
        $ordersWithoutBonuses = Order::where('bonus_used', 0)->count();

        $bonusUsageLabels = ['С бонусами', 'Без бонусов'];
        $bonusUsageData = [$ordersWithBonuses, $ordersWithoutBonuses];


        return view('cabinet.loyalty_admin', compact('levels', 'settings', 'orderCount',
         'topCategories', 'chartLabels','chartData','topThree','categories',
         'levelLabels', 'levelData', 'bonusUsageLabels','bonusUsageData'));
    }


    public function getProducts(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();
        return response()->json($products);
    }

    public function getForecastData(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $salesPerMonth = [];

        $months = ['2025-02', '2025-03', '2025-04', '2025-05'];

        foreach ($months as $month) {
            $start = Carbon::parse($month)->startOfMonth();
            $end = Carbon::parse($month)->endOfMonth();

            $total = OrderItem::where('product_id', $request->product_id)
                ->whereBetween('created_at', [$start, $end])
                ->sum('quantity');

            $salesPerMonth[] = $total;
        }

        $forecast = $this->exponentialSmoothing($salesPerMonth);

        $dates = ['Февраль', 'Март', 'Апрель', 'Май', 'Июнь(прогноз)'];

        return response()->json([
            'labels' => $dates,
            'real_data' => $salesPerMonth,
            'data' => array_slice($forecast, 1),
            'product_name' => $product->name,
        ]);
    }


    function exponentialSmoothing(array $data, float $alpha = 0.6): array {
        $forecast = [];
        $lastForecast = ($data[0] + $data[1]) / 2;

        // Прогноз на месяцы, начиная с 4-го
        foreach ($data as $actual) {
            $lastForecast = $alpha * $actual + (1 - $alpha) * $lastForecast;
            $forecast[] = $lastForecast;
        }

        // Прогноз на следующий месяц (июнь)
        $lastForecast = $alpha * end($data) + (1 - $alpha) * $lastForecast;
        $forecast[] = $lastForecast;

        return array_map('round', $forecast);
    }


    public function update(Request $request)
    {
        if (auth()->user()?->is_admin != true) {
            abort(403);
        }

        foreach ($request->levels as $id => $data) {
            $level = LoyaltyLevel::find($id);
            if ($level) {
                $level->update([
                    'level_name'     => $data['level_name'],
                    'min_spending'   => $data['min_spending'],
                    'bonus_percent'  => $data['bonus_percent'],
                    'description'    => match ((int) $level->id) {
                        1 => "<p>{$data['bonus_percent']}% от суммы заказа в виде бонусных баллов, доступен сразу после регистрации.</p>",
                        2 => "<p>{$data['bonus_percent']}% от суммы заказа в виде бонусных баллов. Присваивается при общей сумме покупок от {$data['min_spending']} рублей.</p>",
                        3 => "<p>{$data['bonus_percent']}% от суммы заказа. Присваивается при покупках от {$data['min_spending']} ₽, <b>ранний доступ к новинкам</b>.</p>",
                        default => '',
                    }
                ]);
            }
        }

        // Пересчёт уровня у всех пользователей
        $users = User::all();
        $levels = LoyaltyLevel::orderByDesc('min_spending')->get();

        foreach ($users as $user) {
            foreach ($levels as $level) {
                if ($user->total_spent >= $level->min_spending) {
                    $user->loyalty_level_id = $level->id;
                    $user->save();
                    break;
                }
            }
        }

        $settings = \App\Models\LoyaltySetting::first();
        $settings->update([
            'recommendations_enabled' => $request->has('recommendations_enabled'),
            'discount_choice_enabled' => $request->has('discount_choice_enabled'),
        ]);

        return redirect()->back()->with('success', 'Уровни лояльности обновлены');
    }
}

