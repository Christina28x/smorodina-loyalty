@extends('layouts.app')
@section('title', 'Шампуни')
@section('content')
<main class="">


<a href="#" id="scroll_top" title="Наверх"></a>


<section class="catalog-section">

    <pre class="d-none">Array
(
    [0] => 18
    [1] => 1476
    [2] => 2947
    [3] => 2837
    [4] => 2838
    [5] => 1330
    [6] => 2844
    [7] => 146
    [8] => 817
    [9] => 82
    [10] => 2379
    [11] => 2394
    [12] => 2395
    [13] => 2905
    [14] => 2857
    [15] => 1924
    [16] => 73
    [17] => 1986
    [18] => 144
    [19] => 813
    [20] => 2301
    [21] => 1471
    [22] => 2761
    [23] => 1076
    [24] => 2747
    [25] => 1061
    [26] => 76
    [27] => 112
    [28] => 814
    [29] => 1474
    [30] => 1064
    [31] => 75
    [32] => 2702
    [33] => 108
    [34] => 811
    [35] => 2722
    [36] => 2817
    [37] => 2833
    [38] => 2834
    [39] => 2835
    [40] => 2928
    [41] => 2927
    [42] => 2660
    [43] => 1060
    [44] => 65
    [45] => 74
    [46] => 2667
    [47] => 2674
    [48] => 2954
    [49] => 2957
    [50] => 2884
    [51] => 2889
    [52] => 2888
    [53] => 1063
    [54] => 1026
    [55] => 1027
    [56] => 1028
    [57] => 1029
    [58] => 1025
    [59] => 2589
    [60] => 2590
    [61] => 2587
    [62] => 2588
    [63] => 2130
    [64] => 2126
    [65] => 2142
    [66] => 2141
    [67] => 2127
    [68] => 2132
    [69] => 2143
    [70] => 2144
    [71] => 2536
    [72] => 2537
    [73] => 2539
    [74] => 2540
    [75] => 2541
    [76] => 2542
    [77] => 2543
    [78] => 2544
    [79] => 2545
    [80] => 2546
    [81] => 2547
    [82] => 2548
    [83] => 1070
    [84] => 3027
    [85] => 1072
    [86] => 2952
    [87] => 1073
    [88] => 520
    [89] => 521
    [90] => 522
    [91] => 620
    [92] => 518
    [93] => 519
    [94] => 515
    [95] => 516
    [96] => 517
    [97] => 543
)
</pre>
    <pre class="d-none"></pre>

        <div class="catalog-section__head" style="background-image: url(https://smorodinacosmetic.com/upload/resize_cache/uf/0f7/iiqsj9u0o8n028blqxlpvqik417lhejm/1400_0_0/Cataloge-preview-banner_2.jpg)">
            <div class="container-xxl h-100 d-flex flex-column justify-content-end justify-content-lg-between">
            <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                <a href="/">Главная страница</a>
                <span>/</span>
                <a href="/catalog/">Каталог</a>
            </div>
            <h1 class="text-lowercase">Шампуни</h1>
        </div>
    </div>


        
    <div class="container-xxl">

        <div class="catalog-section__buttons d-flex mt-4">
                        <div class="catalog-section__menu w-100">
                <div class="catalog-section__menu__slides overflow-visible swiper">
                    <div class="swiper-wrapper">
                                                                                                            <div class="swiper-slide">
                                    <a href="/catalog/hair-care/" class="d-block catalog-section__menu__item ">все товары</a>
                                </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/hair-care/shampuni/" class="d-block catalog-section__menu__item catalog-section__menu__item_active">Шампуни</a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/hair-care/konditsionery/" class="d-block catalog-section__menu__item ">Кондиционеры</a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/hair-care/refily/" class="d-block catalog-section__menu__item ">Рефилы</a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/hair-care/aromaraschesyvanie-hair/" class="d-block catalog-section__menu__item ">Аромарасчесывание</a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/hair-care/polotentse-s/" class="d-block catalog-section__menu__item ">Полотенце</a>
                                    </div>
                                                                                                        </div>
                    <div class="catalog-section__menu-scrollbar swiper-scrollbar"></div>
                </div>
            </div>
        </div>

        
        <div class="mt-7">
        
<div class="row gx-4 gy-7 mb-7 mb-lg-9">
    @foreach ($products as $product)
        <div class="nm_{{ $loop->index }} col-6 col-md-4 col-lg-3">
            <article class="product-card ssss_{{ $loop->index }} item" data-id="{{ $product->id }}">
                <div class="product-card__desc">
                    <a href="{{ route('products.show', [$product->category->name, $product->subcategory->name, $product->slug]) }}"
                       class="product-card__photo metrika_good_click"
                       style="background-image: url('{{ asset($product->image) }}')">
                    </a>
                    <div class="product-card__favorite {{ auth()->user()?->hasFavorite($product->id) ? 'product-card__favorite_active' : '' }}" data-product-id="{{ $product->id }}">
                        <svg><use href="#heart"></use></svg>
                    </div>

                    <div class="product-card__text">
                        <div class="product-card__text__prev">
                            {{ $product->name }}
                        </div>

                        <div class="product-card__text__price" data-currency-symbol="₽">
                            <span class="product-card__text__price-current" data-current-price="{{ $product->price }}">
                                {{ number_format($product->price, 0, ',', ' ') }} ₽
                            </span>
                            <span class="product-card__text__price-quantity">0</span>
                        </div>
                    </div>

                    <div class="product-card__add-block">
                        <div class="product-card__count">
                            <div class="product-card__count__minus" data-type="minus">-</div>
                            <div class="product-card__count__value">0</div>
                            <div class="product-card__count__plus" data-type="plus">+</div>
                        </div>

                        <div class="product-card__btn-wrap product-card__btn-js"
                             data-product-name="{{ $product->name }}"
                             data-product-category="{{ $product->category->name }}"
                             data-product-price="{{ $product->price }}">
                            <div class="product-card__btn smo-btn">
                                <svg><use href="#bag"></use></svg>
                                <span class="product-card__btn-text">В корзину</span>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('products.show', [$product->category->name, $product->subcategory->name, $product->slug]) }}"
                   class="product-card__name metrika_good_click">
                    {{ $product->name }}
                                        
                    @if($product->volume)
                    <span>{{ $product->volume }}</span>  
                    @endif
                </a>

                <div class="facial-item__price">
                    <div class="product-card__price">
                        {{ number_format($product->price, 0, ',', ' ') }} ₽
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>


        </div>

                
                    <div class="mt-8">
                <div class="catalog-section__bottom-text"></div>
            </div>
                
    </div>

</section>


</main>

@endsection