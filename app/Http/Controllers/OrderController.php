<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $products = collect();

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->quantity = $item['quantity'];
                $products->push($product);
            }
        }

        return view('order.index', [
            'cart' => $cart,
            'total' => $total,
            'products' => $products
        ]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email',
            'city'             => 'required|string|max:255',
            'zip'              => 'required|string|max:20',
            'street'           => 'required|string|max:255',
            'house'            => 'required|string|max:50',
            'flat'             => 'nullable|string|max:50',
            'payment_method'   => 'required|in:card_now,courier',
            'delivery_method'  => 'required|in:pickup,address',
            'price' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
            'bonus_used' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'product_count' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        if (!$user) abort(403);

        // Адрес
        $fullAddress = "г. {$validated['city']}, {$validated['street']}, {$validated['house']}";
        if (!empty($validated['flat'])) $fullAddress .= ", кв. {$validated['flat']}";

        $discountUsed = 0;
$discount = session('applied_discount');

if ($discount) {
    if ($discount['type'] === 'all') {
        $discountUsed = round($validated['price'] * $discount['value'] / 100);
    } elseif ($discount['type'] === 'category') {
        $cart = session('cart', []);
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product && $product->category === $discount['target_id']) {
                $discountUsed += round($item['price'] * $item['quantity'] * $discount['value'] / 100);
            }
        }
    } elseif ($discount['type'] === 'subcategory') {
        $cart = session('cart', []);
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product && $product->subcategory === $discount['target_id']) {
                $discountUsed += round($item['price'] * $item['quantity'] * $discount['value'] / 100);
            }
        }
    }
}


        //  Создание заказа
        $order = $user->orders()->create([
            'price' => $validated['price'],
            'bonus_used' => $validated['bonus_used'],
            'discount_used' =>$validated['discount'], // появятся купоны — обновим
            'final_price' => $validated['final_price'],
            'total_quantity' => $validated['product_count'],
            'address' => $fullAddress,
            'delivery_method' => $validated['delivery_method'],
        ]);

        // Добавим товары в order_items
        $cart = session('cart', []);
        $products = collect();
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $item['price'],
                ]);
            }
        }

        // 💬 Обновляем бонусы, общие траты и транзакции
        $user->total_spent += $validated['final_price'];
        if ($validated['bonus_used'] > 0) {
            $user->bonus_balance -= $validated['bonus_used'];
            $user->transactions()->create([
                'amount' => -$validated['bonus_used'],
                'type' => 'spend',
                'order_id' => $order->id,
            ]);
        }

        // Начисляем новые бонусы
        $bonusPercent = optional($user->loyaltyLevel)->bonus_percent / 100;


        $earned = floor($validated['final_price'] * $bonusPercent);
        $user->bonus_balance += $earned;

        $user->transactions()->create([
            'amount' => $earned,
            'type' => 'earn',
            'order_id' => $order->id,
        ]);

        $newLevel = \App\Models\LoyaltyLevel::where('min_spending', '<=', $user->total_spent)
            ->orderByDesc('min_spending')
            ->first();

        // Если уровень изменился, обновить его
        if ($newLevel && $user->loyalty_level_id !== $newLevel->id) {
            $user->loyalty_level_id = $newLevel->id;
        }

        $user->save();

        Session::forget('cart');

        return redirect()->route('order.complete')->with('success', 'Заказ успешно оформлен!');
    }

}
