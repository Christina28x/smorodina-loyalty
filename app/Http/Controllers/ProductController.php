<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Series;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category, $subcategory = null)
    {
        $categoryModel = Category::where('name', $category)->orWhere('rus_name', $category)->firstOrFail();
        $query = Product::where('category_id', $categoryModel->id);

        if ($subcategory) {
            $subcategoryModel = Subcategory::where('name', $subcategory)->orWhere('rus_name', $subcategory)->firstOrFail();
            $query->where('subcategory_id', $subcategoryModel->id);
        }

        $products = $query->with('images')->get();

        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    public function show($category, $subcategory, $slug)
    {
        $product = Product::where('slug', $slug)
            ->with('images', 'category', 'subcategory')
            ->firstOrFail();

        return view('products.show', compact('product'));
    }

    public function readyPage()
    {
        $products_1 = $this->getBy('promotions', 'populyarnye-tovary');
        $products_2 = $this->getBy('promotions', 'nabory-s-tonerami');
        $products_3 = $this->getBy('promotions', 'prodvinutyy-ukhod');

        return view('promotions.complex-face.ready', compact('products_1', 'products_2', 'products_3'));
    }

    public function showCatalog()
    {
        $products = $this->getBy($category, $subcategory);

        return view("catalog.$category.$subcategory", compact('products'));
    }

    public function showCatalogView($category, $subcategory)
    {
        $products = $this->getBy($category, $subcategory);

        return view("catalog.$category.$subcategory", compact('products'));
    }

    public function showCategoryView($category)
    {
        $categoryModel = Category::where('name', $category)->orWhere('rus_name', $category)->firstOrFail();

        $products = Product::where('category_id', $categoryModel->id)
            ->with('images')
            ->get();

        return view("catalog.$category.index", compact('products'));
    }

    public function showCategory($category)
    {
        $categoryModel = Category::where('name', $category)->orWhere('rus_name', $category)->firstOrFail();

        $products = Product::where('category_id', $categoryModel->id)
            ->with('images')
            ->get();

        return view("$category.index", compact('products'));
    }

    public function showSeries($seriesName)
    {
        $series = Series::where('name', $seriesName)->firstOrFail();

        $products = Product::where('series_id', $series->id)
            ->with('images')
            ->get();

        return view("sets.$seriesName", compact('products'));
    }

    public function showComplexHair()
    {
        $products = $this->getBy('promotions', 'nabory-dlya-ukhoda-za-volosami');
        return view("promotions.complex-hair", compact('products'));
    }

    public function showComplexBody()
    {
        $products = $this->getBy('promotions', 'anti-cellulite');
        return view("promotions.complex-body", compact('products'));
    }

    public function showComplexAroma()
    {
        $products = $this->getBy('promotions', 'aromaraschesyvanie');
        return view("promotions.complex-aroma", compact('products'));
    }

    // 🔧 Вспомогательный метод
    private function getBy($category, $subcategory)
    {
        $categoryModel = Category::where('name', $category)->orWhere('rus_name', $category)->firstOrFail();
        $subcategoryModel = Subcategory::where('name', $subcategory)->orWhere('rus_name', $subcategory)->firstOrFail();

        return Product::where('category_id', $categoryModel->id)
            ->where('subcategory_id', $subcategoryModel->id)
            ->with('images')
            ->get();
    }
}


