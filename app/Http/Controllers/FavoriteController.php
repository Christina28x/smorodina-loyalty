<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
public function toggle(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id'
    ]);

    $user = Auth::user();
    $productId = $request->product_id;

    if ($user->favorites()->where('product_id', $productId)->exists()) {
        $user->favorites()->detach($productId);
        // 💡 Обновляем связи
        $user->load('favorites');
        return response()->json(['status' => 'removed']);
    } else {
        if (! $user->hasFavorite($productId)) {
    $user->favorites()->attach($productId);
    return response()->json(['status' => 'added']);
}
    }
}

}
