@extends('layouts.app')
@section('title', 'Наборы')
@section('content')
<main class="">

    <section class="catalog-section">

        <div class="catalog-section__head" style="background-image: url(https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/demo/section_bg.png)">
            <div class="container-xxl h-100 d-flex flex-column justify-content-end justify-content-lg-between">
                <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                    <a href="/">Главная страница</a>
                    <span>/</span>
                    <a href="/promotions/">Готовые наборы</a>
                </div>
                <h1 class="text-lowercase">Готовые наборы</h1>
            </div>
        </div>

        <div class="container-xxl">

            <div class="catalog-section__buttons d-flex mt-4">
                <div class="catalog-section__menu w-100">
                    <div class="catalog-section__menu__slides swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 1" style="margin-right: 9px;">
                                <a href="https://smorodinacosmetic.com/promotions/" class="d-block catalog-section__menu__item catalog-section__menu__item_active">Категории</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="series-list mt-6">
                <div class="row g-4">
                                            <div class="col-6">
                            <a href="/promotions/complex-face/ready/" class="series-list__item series-list__item_114                           series-list__item_type-1 d-flex flex-column align-items-center justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url(https://smorodinacosmetic.com/upload/iblock/aa7/ug25225xvvp34zuwji2ecmhz18nn7ico/category_cards.jpg)">
                                <div class="series-list__item-bg" style="background-color: #7A74CA"></div>
                                <div class="text-center series-list__item__title text-lowercase">Лицо</div>
                                <div class="series-list__item__desc mt-2"></div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/promotions/complex-hair" class="series-list__item series-list__item_114                           series-list__item_type-1 d-flex flex-column align-items-center justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url(https://smorodinacosmetic.com/upload/iblock/a1c/n9ez89y66ebxv8g71f1bvqcnywb3fbt7/category_cards_1.jpg)">
                                <div class="series-list__item-bg" style="background-color: #7A74CA"></div>
                                <div class="text-center series-list__item__title text-lowercase">Волосы</div>
                                <div class="series-list__item__desc mt-2"></div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/promotions/complex-body" class="series-list__item series-list__item_114                           series-list__item_type-1 d-flex flex-column align-items-center justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url(https://smorodinacosmetic.com/upload/iblock/3c7/qwf10tewgzayxxjryp256m12vpbtwdgj/category_cards_2.jpg)">
                                <div class="series-list__item-bg" style="background-color: #7A74CA"></div>
                                <div class="text-center series-list__item__title text-lowercase">Тело</div>
                                <div class="series-list__item__desc mt-2"></div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/promotions/complex-aroma" class="series-list__item series-list__item_114                           series-list__item_type-1 d-flex flex-column align-items-center justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url(https://smorodinacosmetic.com/upload/iblock/f50/7mcqg5juktnxwx0qqpewg47j0aah4zks/category_cards_3.jpg)">
                                <div class="series-list__item-bg" style="background-color: #7A74CA"></div>
                                <div class="text-center series-list__item__title text-lowercase">Ароматерапия</div>
                                <div class="series-list__item__desc mt-2"></div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                    </div>
            </div>
        </div>

    </section>





<div class="mt-7">

    

<section class="">
    <div class="container-xxl">
<!--        <h1></h1>-->
        <div class="search-page__list mt-4 mt-lg-8">
            <div class="row g-4">
                                                            
                                            @foreach ($products as $product)
        <div class="nm_{{ $loop->index }} col-6 col-md-4 col-lg-3">
            <article class="product-card ssss_{{ $loop->index }} item" data-id="{{ $product->id }}">
                <div class="product-card__desc">
                    <a href="{{ route('products.show', [
    $product->category->name ?? 'unknown',
    $product->subcategory->name ?? 'unknown',
    $product->slug
]) }}"
                       class="product-card__photo metrika_good_click"
                       style="background-image: url('{{ asset($product->image) }}')">
                    </a>

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

                <a href="{{ route('products.show', [
    $product->category->name ?? 'unknown',
    $product->subcategory->name ?? 'unknown',
    $product->slug
]) }}"
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
</section>
</div>



</main>
@endsection