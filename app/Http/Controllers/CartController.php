<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

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

