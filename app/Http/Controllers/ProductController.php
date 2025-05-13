<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Вывод списка товаров по категории и подкатегории
     */
    public function index($category, $subcategory = null)
    {
        $query = Product::where('category', $category);

        if ($subcategory) {
            $query->where('subcategory', $subcategory);
        }

        $products = $query->with('images')->get();

        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    /**
     * Отображение страницы одного товара
     */
    public function show($category, $subcategory, $slug)
    {
        $product = Product::where('slug', $slug)
            ->with('images')
            ->firstOrFail();

        // (опционально) проверим, что товар действительно из этой категории
        // if ($product->category !== $category || $product->subcategory !== $subcategory) {
        //     abort(404);
        // }

        return view('products.show', compact('product'));
    }

    public function readyPage()
    {
        $products_1 = Product::where('category', 'promotions')
            ->where('subcategory', 'populyarnye-tovary')
            ->get();

        $products_2 = Product::where('category', 'promotions')
            ->where('subcategory', 'nabory-s-tonerami')
            ->get();

        $products_3 = Product::where('category', 'promotions')
            ->where('subcategory', 'prodvinutyy-ukhod')
            ->get();
        return view('promotions.complex-face.ready', compact('products_1', 'products_2','products_3'));
    }

    public function showCatalogView($category, $subcategory)
    {
        $products = Product::where('category', $category)
            ->where('subcategory', $subcategory)
            ->with('images')
            ->get();

        return view("catalog.$category.$subcategory", compact('products'));
    }

    public function showComplexHair()
    {
        $products = Product::where('category', 'promotions')
            ->where('subcategory', 'nabory-dlya-ukhoda-za-volosami')
            ->with('images')
            ->get();

        return view("promotions.complex-hair", compact('products'));
    }

    public function showComplexBody()
    {
        $products = Product::where('category', 'promotions')
            ->where('subcategory', 'anti-cellulite')
            ->with('images')
            ->get();

        return view("promotions.complex-body", compact('products'));
    }

    public function showComplexAroma()
    {
        $products = Product::where('category', 'promotions')
            ->where('subcategory', 'aromaraschesyvanie')
            ->with('images')
            ->get();

        return view("promotions.complex-aroma", compact('products'));
    }

    public function showCategoryView($category)
    {
        $products = Product::where('category', $category)
            ->with('images')
            ->get();

        return view("$category.index", compact('products'));
    }
    
}

