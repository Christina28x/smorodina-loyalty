<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LoyaltyAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/promotions', function () {
    return app(ProductController::class)->showCategory('promotions');
});

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
    return app(ProductController::class)->showCategoryView('face');
});

Route::get('/catalog/face/accessories', function () {
    return app(ProductController::class)->showCatalogView('face', 'accessories');
});

Route::get('/catalog/face/alginate-masks', function () {
    return app(ProductController::class)->showCatalogView('face', 'alginate-masks');
});

Route::get('/catalog/face/cream', function () {
    return app(ProductController::class)->showCatalogView('face', 'cream');
});

Route::get('/catalog/face/enzyme-system', function () {
    return app(ProductController::class)->showCatalogView('face', 'enzyme-system');
});

Route::get('/catalog/face/hydrolate', function () {
    return app(ProductController::class)->showCatalogView('face', 'hydrolate');
});

Route::get('/catalog/face/kremy-s-spf', function () {
    return app(ProductController::class)->showCatalogView('face', 'kremy-s-spf');
});

Route::get('/catalog/face/patchi', function () {
    return app(ProductController::class)->showCatalogView('face', 'patchi');
});

Route::get('/catalog/face/serum', function () {
    return app(ProductController::class)->showCatalogView('face', 'serum');
});

Route::get('/catalog/face/tonery', function () {
    return app(ProductController::class)->showCatalogView('face', 'tonery');
});

Route::get('/catalog/face/ukhod-za-kozhey-vokrug-glaz', function () {
    return app(ProductController::class)->showCatalogView('face', 'ukhod-za-kozhey-vokrug-glaz');
});


Route::get('/catalog/hair-care/', function () {
    return app(ProductController::class)->showCategoryView('hair-care');
});

Route::get('/catalog/hair-care/shampuni', function () {
    return app(ProductController::class)->showCatalogView('hair-care', 'shampuni');
});

Route::get('/catalog/hair-care/konditsionery', function () {
    return app(ProductController::class)->showCatalogView('hair-care', 'konditsionery');
});

Route::get('/catalog/hair-care/refily', function () {
    return app(ProductController::class)->showCatalogView('hair-care', 'refily');
});

Route::get('/catalog/hair-care/aromaraschesyvanie-hair', function () {
    return app(ProductController::class)->showCatalogView('hair-care', 'aromaraschesyvanie-hair');
});

Route::get('/catalog/hair-care/polotentse-s', function () {
    return app(ProductController::class)->showCatalogView('hair-care', 'polotentse-s');
});


Route::get('/catalog/body/', function () {
    return app(ProductController::class)->showCategoryView('body');
});

Route::get('/catalog/body/sugar-and-salt', function () {
    return app(ProductController::class)->showCatalogView('body', 'sugar-and-salt');
});

Route::get('/catalog/body/krem-dlya-tela-i-ruk', function () {
    return app(ProductController::class)->showCatalogView('body', 'krem-dlya-tela-i-ruk');
});

Route::get('/catalog/body/brush', function () {
    return app(ProductController::class)->showCatalogView('body', 'brush');
});

Route::get('/catalog/body/oil-with-essential-oils', function () {
    return app(ProductController::class)->showCatalogView('body', 'oil-with-essential-oils');
});

Route::get('/catalog/body/nabor-dlya-depilyatsii', function () {
    return app(ProductController::class)->showCatalogView('body', 'nabor-dlya-depilyatsii');
});

Route::get('/catalog/body/vodostoykiy-spf-sprey', function () {
    return app(ProductController::class)->showCatalogView('body', 'vodostoykiy-spf-sprey');
});

Route::get('/catalog/tverdye-produkty/', function () {
    return app(ProductController::class)->showCategoryView('tverdye-produkty');
});

Route::get('/catalog/tverdye-produkty/tverdye-produkty-dlya-tel', function () {
    return app(ProductController::class)->showCatalogView('tverdye-produkty', 'tverdye-produkty-dlya-tel');
});

Route::get('/catalog/tverdye-produkty/tverdye-shampuni-i-konditsionery', function () {
    return app(ProductController::class)->showCatalogView('tverdye-produkty', 'tverdye-shampuni-i-konditsionery');
});

Route::get('/catalog/tverdye-produkty/aksessuary-dlya-sushki-i-khraneniya', function () {
    return app(ProductController::class)->showCatalogView('tverdye-produkty', 'aksessuary-dlya-sushki-i-khraneniya');
});


Route::get('/catalog/aromatherapy/', function () {
    return app(ProductController::class)->showCategoryView('aromatherapy');
});

Route::get('/catalog/aromatherapy/aroma-therapy-massage-candles', function () {
    return app(ProductController::class)->showCatalogView('aromatherapy', 'aroma-therapy-massage-candles');
});
Route::get('/catalog/aromatherapy/interior-candles-selective', function () {
    return app(ProductController::class)->showCatalogView('aromatherapy', 'interior-candles-selective');
});


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

Route::get('/purchase', [OrderController::class, 'index'])->name('purchase.index');
Route::post('/purchase', [OrderController::class, 'submit'])->name('purchase.submit');

Route::get('/complete', function () {
    return view('order.complete');
})->name('order.complete');


// AJAX-проверка email
Route::post('/auth/check-email', [AuthController::class, 'checkEmail']);

// Логин через pop-up
Route::post('/auth/login', [AuthController::class, 'login']);

// Регистрация
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');


// Кабинет 
Route::get('/cabinet', function () {
    return view('cabinet.index'); 
})->middleware('auth')->name('cabinet');




// маршрут, на который ведёт письмо
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


    Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::get('/check-auth', function () {
    return response()->json(['authenticated' => auth()->check()]);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('message', 'Вы вышли из аккаунта.');
})->name('logout');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet');
    Route::post('/cabinet/update', [CabinetController::class, 'updateProfile'])->name('cabinet.updateProfile');
    Route::post('/cabinet/update-password', [CabinetController::class, 'updatePassword'])->name('cabinet.updatePassword');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::post('/cabinet/discounts/select', [CabinetController::class, 'submitDiscountChoice'])->name('loyalty.selectDiscount');
    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon']);
    Route::post('/cart/set-discounted-total', [CartController::class, 'setDiscountedTotal']);
    Route::get('/cabinet/loyalty-admin', [LoyaltyAdminController::class, 'index'])->name('admin.loyalty');
    Route::post('/cabinet/loyalty-admin', [LoyaltyAdminController::class, 'update'])->name('admin.loyalty.update');
    Route::get('/admin/forecast/products', [ForecastController::class, 'getProducts']);
    Route::get('/admin/forecast/data', [ForecastController::class, 'getForecastData']);

});

