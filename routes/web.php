<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/promotions', function () {
    return app(ProductController::class)->showCategoryView('promotions');
});


Route::get('/promotions/complex-face', function () {
    return view('promotions/complex-face.index');
})->name('promotions/complex-face.index');

Route::get('/promotions/complex-face/ready', [ProductController::class, 'readyPage'])->name('promotions/complex-face.ready');

Route::get('/promotions/complex-hair', [ProductController::class, 'showComplexHair'])->name('promotions.complex-hair');

Route::get('/promotions/complex-body', [ProductController::class, 'showComplexBody'])->name('promotions.complex-body');

Route::get('/promotions/complex-aroma', [ProductController::class, 'showComplexAroma'])->name('promotions.complex-aroma');


Route::get('/sets', function () {
    return view('sets.index');
})->name('sets.index');

Route::get('/sets/all', function () {
    return view('sets.all');
})->name('sets.all');

Route::get('/sets/microbiome', function () {
    return view('sets.microbiome');
})->name('sets.microbiome');

Route::get('/sets/lifting', function () {
    return view('sets.lifting');
})->name('sets.lifting');

Route::get('/sets/smart anti-acne', function () {
    return view('sets.smart anti-acne');
})->name('sets.smart anti-acneindex');

Route::get('/sets/smart-age', function () {
    return view('sets.smart-age');
})->name('sets.smart-age');

Route::get('/sets/sensitive', function () {
    return view('sets.sensitive');
})->name('sets.sensitive');

Route::get('/sets/hydration', function () {
    return view('sets.hydration');
})->name('sets.hydration');

Route::get('/sets/spf', function () {
    return view('sets.spf');
})->name('sets.spf');


Route::get('/catalog', function () {
    return view('catalog.index');
})->name('catalog.index');


Route::get('/catalog/face/', function () {
    return view('catalog.face.index');
})->name('catalog.face.index');

Route::get('/catalog/face/accessories', function () {
    return view('catalog.face.accessories');
})->name('catalog.face.accessories');

Route::get('/catalog/face/alginate-masks', function () {
    return view('catalog.face.alginate-masks');
})->name('catalog.face.alginate-masks');

Route::get('/catalog/face/cream', function () {
    return view('catalog.face.cream');
})->name('catalog.face.cream');


Route::get('/catalog/face/enzyme-system', function () {
    return app(ProductController::class)->showCatalogView('face', 'enzyme-system');
});

Route::get('/catalog/face/hydrolate', function () {
    return view('catalog.face.hydrolate');
})->name('catalog.face.hydrolate');

Route::get('/catalog/face/kremy-s-spf', function () {
    return view('catalog.face.kremy-s-spf');
})->name('catalog.face.kremy-s-spf');

Route::get('/catalog/face/patchi', function () {
    return view('catalog.face.patchi');
})->name('catalog.face.patchi');



Route::get('/catalog/face/serum', function () {
    return view('catalog.face.serum');
})->name('catalog.face.serum');

Route::get('/catalog/face/tonery', function () {
    return view('catalog.face.tonery');
})->name('catalog.face.tonery');

Route::get('/catalog/face/ukhod-za-kozhey-vokrug-glaz', function () {
    return view('catalog.face.ukhod-za-kozhey-vokrug-glaz');
})->name('catalog.face.ukhod-za-kozhey-vokrug-glaz');


Route::get('/catalog/hair-care/', function () {
    return view('catalog.hair-care.index');
})->name('catalog.hair-care.index');

Route::get('/catalog/hair-care/shampuni', function () {
    return view('catalog.hair-care.shampuni');
})->name('catalog.hair-care.shampuni');

Route::get('/catalog/hair-care/konditsionery', function () {
    return view('catalog.hair-care.konditsionery');
})->name('catalog.hair-care.konditsionery');

Route::get('/catalog/hair-care/refily', function () {
    return view('catalog.hair-care.refily');
})->name('catalog.hair-care.refily');

Route::get('/catalog/hair-care/tverdye-shampuni-i-konditsionery', function () {
    return view('catalog.hair-care.tverdye-shampuni-i-konditsionery');
})->name('catalog.hair-care.tverdye-shampuni-i-konditsionery');

Route::get('/catalog/hair-care/aromaraschesyvanie', function () {
    return view('catalog.hair-care.aromaraschesyvanie');
})->name('catalog.hair-care.aromaraschesyvanie');

Route::get('/catalog/hair-care/polotentse-s', function () {
    return view('catalog.hair-care.polotentse-s');
})->name('catalog.hair-care.polotentse-s');


Route::get('/catalog/body/', function () {
    return view('catalog.body.index');
})->name('catalog.body.index');

Route::get('/catalog/body/sugar-and-salt', function () {
    return view('catalog.body.sugar-and-salt');
})->name('catalog.body.sugar-and-salt');

Route::get('/catalog/body/vygodnoe-predlozhenie', function () {
    return view('catalog.body.vygodnoe-predlozhenie');
})->name('catalog.body.vygodnoe-predlozhenie');

Route::get('/catalog/body/krem-dlya-tela-i-ruk', function () {
    return view('catalog.body.krem-dlya-tela-i-ruk');
})->name('catalog.body.krem-dlya-tela-i-ruk');

Route::get('/catalog/body/tverdye-produkty-dlya-tel', function () {
    return view('catalog.body.tverdye-produkty-dlya-tel');
})->name('catalog.body.tverdye-produkty-dlya-tel');

Route::get('/catalog/body/brush', function () {
    return view('catalog.body.brush');
})->name('catalog.body.brush');

Route::get('/catalog/body/oil-with-essential-oils', function () {
    return view('catalog.body.oil-with-essential-oils');
})->name('catalog.body.oil-with-essential-oils');

Route::get('/catalog/body/nabor-dlya-depilyatsii', function () {
    return view('catalog.body.nabor-dlya-depilyatsii');
})->name('catalog.body.nabor-dlya-depilyatsii');

Route::get('/catalog/body/vodostoykiy-spf-sprey', function () {
    return view('catalog.body.vodostoykiy-spf-sprey');
})->name('catalog.body.vodostoykiy-spf-sprey');


Route::get('/catalog/tverdye-produkty/', function () {
    return view('catalog.tverdye-produkty.index');
})->name('catalog.tverdye-produkty.index');

Route::get('/catalog/tverdye-produkty/tverdye-produkty-dlya-volos', function () {
    return view('catalog.tverdye-produkty.tverdye-produkty-dlya-volos');
})->name('catalog.tverdye-produkty.tverdye-produkty-dlya-volos');

Route::get('/catalog/tverdye-produkty/tverdye-produkty-dlya-litsa', function () {
    return view('catalog.tverdye-produkty.tverdye-produkty-dlya-litsa');
})->name('catalog.tverdye-produkty.tverdye-produkty-dlya-litsa');

Route::get('/catalog/tverdye-produkty/tverdye-produkty-dlya-tela', function () {
    return view('catalog.tverdye-produkty.tverdye-produkty-dlya-tela');
})->name('catalog.tverdye-produkty.tverdye-produkty-dlya-tela');

Route::get('/catalog/tverdye-produkty/aksessuary-dlya-sushki-i-khraneniya', function () {
    return view('catalog.tverdye-produkty.aksessuary-dlya-sushki-i-khraneniya');
})->name('catalog.tverdye-produkty.aksessuary-dlya-sushki-i-khraneniya');


Route::get('/catalog/aromatherapy/', function () {
    return view('catalog.aromatherapy.index');
})->name('catalog.aromatherapy.index');

Route::get('/catalog/aromatherapy/aroma-therapy-massage-candles', function () {
    return view('catalog.aromatherapy.aroma-therapy-massage-candles');
})->name('catalog.aromatherapy.aroma-therapy-massage-candles');

Route::get('/catalog/aromatherapy/interior-candles-selective', function () {
    return view('catalog.aromatherapy.interior-candles-selective');
})->name('catalog.aromatherapy.interior-candles-selective');


Route::get('/catalog/aksessuary-/', function () {
    return view('catalog.aksessuary-');
})->name('catalog.aksessuary-');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/partners', function () {
    return view('partners');
})->name('partners');

Route::get('/foreign-partnership', function () {
    return view('foreign-partnership');
})->name('foreign-partnership');




Route::get('/catalog/{category}/{subcategory}/{slug}', [ProductController::class, 'show'])->name('products.show');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/total', [CartController::class, 'total'])->name('cart.total');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
