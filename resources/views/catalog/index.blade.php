@extends('layouts.app')
@section('title', 'SMORODINA : Продукты')
@section('content')
<main class="">


<a href="#" id="scroll_top" title="Наверх" style="display: inline;"></a>





<section class="catalog-section">

    <div class="catalog-section__head" style="background-image: url('{{ asset('img/section_bg.png') }}')">
        <div class="container-xxl h-100 d-flex flex-column justify-content-end justify-content-lg-between">
            <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                <a href="{{ route('home') }}">Главная страница</a>
                <span>/</span>
                <a href="/catalog">Каталог</a>
            </div>
            <h1 class="text-lowercase">Каталог</h1>
        </div>
    </div>

    <div class="container-xxl">
        <div class="catalog-section__buttons d-flex mt-4">
<!--            <div class="catalog-section__options d-flex">-->
<!--                <div class="catalog-section__options__modal smo-btn">Подобрать уход</div>-->
<!--            </div>-->
            <div class="catalog-section__menu">
                <div class="catalog-section__menu__slides swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-ad224142557bf4c10" aria-live="polite">
                        <div class="catalog-section__options swiper-slide swiper-slide-active" role="group" aria-label="1 / 10" style="margin-right: 9px;">
                            <div class="catalog-section__options__modal smo-btn">Подобрать уход</div>
                        </div>
                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 10" style="margin-right: 9px;">
                            <a href="/catalog" class="d-block catalog-section__menu__item catalog-section__menu__item_active">все товары</a>
                        </div>
                                                    <div class="swiper-slide" role="group" aria-label="5 / 10" style="margin-right: 9px;">
                                <a href="/catalog/face" class="d-block catalog-section__menu__item ">ЛИЦО</a>
                            </div>
                                                    <div class="swiper-slide" role="group" aria-label="6 / 10" style="margin-right: 9px;">
                                <a href="/catalog/hair-care/" class="d-block catalog-section__menu__item ">ВОЛОСЫ</a>
                            </div>
                                                    <div class="swiper-slide" role="group" aria-label="7 / 10" style="margin-right: 9px;">
                                <a href="/catalog/body/" class="d-block catalog-section__menu__item ">ТЕЛО</a>
                            </div>
                                                    <div class="swiper-slide" role="group" aria-label="8 / 10" style="margin-right: 9px;">
                                <a href="/catalog/tverdye-produkty/" class="d-block catalog-section__menu__item ">ТВЕРДЫЕ ПРОДУКТЫ</a>
                            </div>
                                                    <div class="swiper-slide" role="group" aria-label="9 / 10" style="margin-right: 9px;">
                                <a href="/catalog/aromatherapy/" class="d-block catalog-section__menu__item ">СВЕЧИ И АРОМАТЕРАПИЯ</a>
                            </div>
                                            </div>
                    <div class="catalog-section__menu-scrollbar swiper-scrollbar swiper-scrollbar-horizontal swiper-scrollbar-lock" style="display: none;"><div class="swiper-scrollbar-drag" style="transform: translate3d(0px, 0px, 0px); width: 0px;"></div></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
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
<!--            <div class="catalog-section__bottom-text">«Microbiome» нормализует pH кожи, успокаивает её после умывания, способствует росту полезной микробиоты кожи лица и служит проводником перед принятием основных средств ежедневного ухода — сыворотки и крема</div>-->

            <div class="catalog-section__bottom-text">
                Если вы не смогли найти того, что искали, мы поможем. Просто напишите нам в&nbsp;любой мессенджер по&nbsp;кнопке справа.
            </div>

        </div>

    </div>

</section>


</main>
@endsection