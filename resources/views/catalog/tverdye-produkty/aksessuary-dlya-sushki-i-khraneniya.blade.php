@extends('layouts.app')
@section('title', 'Аксессуары')
@section('content')
<main class="">


<a href="#" id="scroll_top" title="Наверх"></a>

<section class="catalog-section">
        <div class="catalog-section__head" style="background-image: url('{{ asset('img/Cataloge-preview-banner_3-kopiya.jpg') }}')">
            <div class="container-xxl h-100 d-flex flex-column justify-content-end justify-content-lg-between">
            <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                <a href="/">Главная страница</a>
                <span>/</span>
                <a href="/catalog/">Каталог</a>
            </div>
            <h1 class="text-lowercase">Аксессуары </h1>
        </div>
    </div>


        
    <div class="container-xxl">

        <div class="catalog-section__buttons d-flex mt-4">
                        <div class="catalog-section__menu w-100">
                <div class="catalog-section__menu__slides overflow-visible swiper">
                    <div class="swiper-wrapper">
                                                                                                            <div class="swiper-slide">
                                    <a href="/catalog/tverdye-produkty/" class="d-block catalog-section__menu__item ">все товары</a>
                                </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/tverdye-produkty/tverdye-shampuni-i-konditsionery/" class="d-block catalog-section__menu__item ">Для волос</a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/tverdye-produkty/tverdye-produkty-dlya-tel/" class="d-block catalog-section__menu__item ">Для тела </a>
                                    </div>
                                                                    <div class="swiper-slide">
                                        <a href="/catalog/tverdye-produkty/aksessuary-dlya-sushki-i-khraneniya/" class="d-block catalog-section__menu__item catalog-section__menu__item_active">Аксессуары </a>
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