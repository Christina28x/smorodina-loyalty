@extends('layouts.app')
@section('title', 'Линейки - sensitive')
@section('content')
<main class="">




<section class="catalog-section">
    <div class="catalog-section__head" style="background-image: url('{{ asset('img/SMRDN_web_series_sensitive_main2.jpg') }}')">
        <div class="catalog-section__head-bg" style="background: linear-gradient(180deg, rgba(255,255,255,0) 0%,  #fffff00 cc 100%)"></div>
        <div class="container-xxl h-100 position-relative d-flex flex-column justify-content-end justify-content-lg-between">
            <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                <a href="/">Главная страница</a>
                <span>/</span>
                <a href="/catalog/">Каталог</a>
            </div>
            <h1>sensitive </h1>
        </div>
    </div>
    <div class="container-xxl">
        <div class="series-change-buttons d-flex justify-content-lg-center mt-6">
            <div class="series-change-menu">
                <div class="series-change-menu__slides swiper">
                    <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                <a data-code="microbiome" data-name="microbiome" data-id="2253"
                                   style="color: #7A74CA; border-color: #7A74CA"
                                   href="/sets/microbiome/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #E5DCFF"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #7A74CA"></span>
                                    <span class="series-change-menu__item-name">microbiome</span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="lifting" data-name="lifting" data-id="2254"
                                   style="color: #FF79BA; border-color: #FF79BA"
                                   href="/sets/smart-lifting/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #FEE3F0 "></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #FF79BA"></span>
                                    <span class="series-change-menu__item-name">smart-lifting</span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="smart anti-acne" data-name="smart anti-acne" data-id="2255"
                                   style="color: #909A1F; border-color: #909A1F"
                                   href="/sets/smart anti-acne/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #EAF2BB"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #909A1F"></span>
                                    <span class="series-change-menu__item-name">smart anti-acne</span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="smart-age" data-name="smart-age" data-id="2256"
                                   style="color: #FF935B; border-color: #FF935B"
                                   href="/sets/smart-age/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #FFE7DA"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #FF935B"></span>
                                    <span class="series-change-menu__item-name">smart-age</span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="sensitive" data-name="sensitive" data-id="2257"
                                   style="color: #C685D2; border-color: #C685D2"
                                   href="/sets/sensitive/" class="series-change-menu__item series-change-menu__item_active">
                                    <span class="series-change-menu__item-bg" style="background-color: #F7DAFF"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #C685D2"></span>
                                    <span class="series-change-menu__item-name">sensitive </span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="hydration" data-name="hydration" data-id="2258"
                                   style="color: #5BA8EF; border-color: #5BA8EF"
                                   href="/sets/hydration/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #DAE9FF"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #5BA8EF"></span>
                                    <span class="series-change-menu__item-name">hydration</span>
                                </a>
                            </div>
                                                    <div class="swiper-slide">
                                <a data-code="spf" data-name="spf" data-id="2259"
                                   style="color: #2E98AF; border-color: #2E98AF"
                                   href="/sets/spf/" class="series-change-menu__item ">
                                    <span class="series-change-menu__item-bg" style="background-color: #BAE7F1"></span>
                                    <span class="series-change-menu__item-icon" style="background-color: #2E98AF"></span>
                                    <span class="series-change-menu__item-name">spf</span>
                                </a>
                            </div>
                                            </div>
                    <div class="catalog-section__menu-scrollbar swiper-scrollbar"></div>
                </div>
            </div>
        </div>
        <div class="series-detail mt-6 mt-lg-7">
            <div class="series-detail__name mb-4 mb-lg-6">
                <h4>Серия защищает и смягчает чувствительную кожу, уменьшая раздражения, покраснения и сухость, укрепляя барьер и возвращая коже комфорт и здоровое сияние.</h4>
            </div>
            <div class="series-detail__products">
                
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
        </div>
    </div>
</section>

</main>

@endsection