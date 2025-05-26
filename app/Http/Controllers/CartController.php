<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Discount;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('id');
        $quantity = (int) $request->input('quantity', 1);

        $product = Product::findOrFail($productId);
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'cart' => $cart, 'total' => $this->getTotal()]);
    }

    public function update(Request $request)
    {
        $productId = $request->input('id');
        $quantity = (int) $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                unset($cart[$productId]);
            }
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'cart' => $cart, 'total' => $this->getTotal()]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('id');

        $cart = Session::get('cart', []);
        unset($cart[$productId]);

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'cart' => $cart, 'total' => $this->getTotal()]);
    }

    public function total()
    {
        return response()->json(['total' => $this->getTotal()]);
    }

    protected function getTotal()
    {
        $cart = Session::get('cart', []);
        return array_sum(array_map(fn($item) => $item['quantity'], $cart));
    }

    public function applyCoupon(Request $request)
    {
        $code = trim($request->input('code'));
        $user = auth()->user();

        $discount = Discount::where('code', $code)
            ->where(function ($q) use ($user) {
                $q->whereNull('user_id')
                ->orWhere('user_id', $user?->id ?? 0);
            })
            ->where('valid_until', '>=', now())
            ->first();

        if (!$discount) {
            return response()->json(['error' => 'Промокод недействителен'], 422);
        }


session()->put('applied_discount', [
    'code' => $discount->code,
    'value' => $discount->value,
    'type' => $discount->type,
    'target_id' => $discount->target_id,
]);


        return response()->json([
    'success' => true,
    'discount' => [
        'code' => $discount->code,
        'value' => $discount->value,
        'type' => $discount->type,
        'target' => match ($discount->type) {
            'category' => \App\Models\Category::find($discount->target_id)?->name,
            'subcategory' => \App\Models\Subcategory::find($discount->target_id)?->name,
            default => null,
        }
    ],
]);
    }
public function setDiscountedTotal(Request $request)
{
    $total = (int) $request->input('total');

    if (session()->has('applied_discount')) {
        $discount = session('applied_discount');
        $discount['amount'] = $this->getOriginalTotal() - $total;
        $discount['final_total'] = $total;

        session()->put('applied_discount', $discount);
    }

    return response()->json(['success' => true]);
}

protected function getOriginalTotal()
{
    $cart = Session::get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return $total;
}


    public function index()
    {
        $cart = session()->get('cart', []);
        $products = collect();

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->quantity = $item['quantity'];
                $products->push($product);
            }
        }

        return view('cart.index', compact('products'));
    }

}

