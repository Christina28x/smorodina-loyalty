@extends('layouts.app')
@section('title', 'SMORODINA : Продукты')
@section('content')
<main class="">


<a href="#" id="scroll_top" title="Наверх" style="display: inline;"></a>





<section class="catalog-section">

    <div class="catalog-section__head" style="background-image: url(https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/demo/section_bg.png)">
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

<section class="catalog-filter p-4 pt-lg-4 pe-lg-6" style="display: none;">
    <div class="row justify-content-lg-end position-relative">
        <div class="col-lg-6">
            <div class="catalog-filter__inner p-4">
                <div class="catalog-filter__close"></div>
                <h4>подбор ухода</h4>
                <div class="catalog-filter__desc mt-3">Укажите параметры вашей кожи и ее особенностей, для более гибкого подбора товаров</div>
                <form action="catalog/">
                    <div class="catalog-filter__section catalog-filter__section_unique mt-6">
                        <div class="catalog-filter__section-title">Тип кожи:</div>
                        <div class="catalog-filter__section-items d-flex flex-wrap">
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="dry" name="care[]" class="form-check-input" type="checkbox" value="215">
                                        <label for="dry" class="form-check-label">Сухая</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="oily" name="care[]" class="form-check-input" type="checkbox" value="216">
                                        <label for="oily" class="form-check-label">Жирная</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="combined" name="care[]" class="form-check-input" type="checkbox" value="217">
                                        <label for="combined" class="form-check-label">Комбинированная</label>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                    <div class="catalog-filter__section catalog-filter__section_unique mt-6">
                        <div class="catalog-filter__section-title">Состояние:</div>
                        <div class="catalog-filter__section-items d-flex flex-wrap">
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="0d59823b87179f2eddc4714798954112" name="state[]" class="form-check-input" type="checkbox" value="240">
                                        <label for="0d59823b87179f2eddc4714798954112" class="form-check-label">Нормальная</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="0b30921b7cda3a103911c88a12a54db1" name="state[]" class="form-check-input" type="checkbox" value="241">
                                        <label for="0b30921b7cda3a103911c88a12a54db1" class="form-check-label">Чувствительная</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="eb5857df3785e999d8034e4519e58832" name="state[]" class="form-check-input" type="checkbox" value="242">
                                        <label for="eb5857df3785e999d8034e4519e58832" class="form-check-label">Обезвоженная</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="e9dbe28dcbfb6ab59bd54ceec1d3edd7" name="state[]" class="form-check-input" type="checkbox" value="243">
                                        <label for="e9dbe28dcbfb6ab59bd54ceec1d3edd7" class="form-check-label">Проблемная</label>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                    <div class="catalog-filter__section catalog-filter__section_unique mt-6">
                        <div class="catalog-filter__section-title">Возраст:</div>
                        <div class="catalog-filter__section-items d-flex flex-wrap">
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="over-18" name="age[]" class="form-check-input" type="checkbox" value="219">
                                        <label for="over-18" class="form-check-label">18+</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="over-28" name="age[]" class="form-check-input" type="checkbox" value="220">
                                        <label for="over-28" class="form-check-label">28+ </label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="over-40" name="age[]" class="form-check-input" type="checkbox" value="221">
                                        <label for="over-40" class="form-check-label">40+ </label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="over-50" name="age[]" class="form-check-input" type="checkbox" value="222">
                                        <label for="over-50" class="form-check-label">50+</label>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                    <div class="catalog-filter__section mt-6">
                        <div class="catalog-filter__section-title">Дополнительные проблемы:</div>
                        <div class="catalog-filter__section-items d-flex flex-wrap">
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p1" name="problems[]" class="form-check-input" type="checkbox" value="223">
                                        <label for="p1" class="form-check-label">Морщины</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p3" name="problems[]" class="form-check-input" type="checkbox" value="225">
                                        <label for="p3" class="form-check-label">Провисание овала лица</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p4" name="problems[]" class="form-check-input" type="checkbox" value="226">
                                        <label for="p4" class="form-check-label">Пигментация</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p5" name="problems[]" class="form-check-input" type="checkbox" value="227">
                                        <label for="p5" class="form-check-label">Розацеа/Купероз</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p6" name="problems[]" class="form-check-input" type="checkbox" value="228">
                                        <label for="p6" class="form-check-label">Отеки</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p7" name="problems[]" class="form-check-input" type="checkbox" value="229">
                                        <label for="p7" class="form-check-label">Увядание / тусклый цвет</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p8" name="problems[]" class="form-check-input" type="checkbox" value="230">
                                        <label for="p8" class="form-check-label">Расш. поры / чёрн. точки / высыпания</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p9" name="problems[]" class="form-check-input" type="checkbox" value="244">
                                        <label for="p9" class="form-check-label">SPF-защита</label>
                                    </div>
                                </div>
                                                            <div class="catalog-filter__section-item mt-2 me-2">
                                    <div class="form-check d-flex align-items-center m-0">
                                        <input id="p10" name="problems[]" class="form-check-input" type="checkbox" value="248">
                                        <label for="p10" class="form-check-label">Шелушения / стянутость</label>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                    <button type="submit" class="smo-btn w-100 mt-6">Показать</button>
                </form>
            </div>
        </div>
    </div>
</section>


</main>
@endsection