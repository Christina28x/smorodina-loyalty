@extends('layouts.app')
@section('title', $product->name)
@section('content')

<main class="">


<a href="#" id="scroll_top" title="Наверх"></a>


    <!-- =======  Sprite ======= -->
    <svg style="display: none;">
        <!-- Звезда -->
        <symbol id="star" viewBox="0 0 406.125 406.125">
            <g>
                <path d="M260.133,155.967c-4.487,0-9.25-3.463-10.64-7.73L205.574,13.075c-1.39-4.268-3.633-4.268-5.023,0
                L156.64,148.237c-1.39,4.268-6.153,7.73-10.64,7.73H3.88c-4.487,0-5.186,2.138-1.553,4.78l114.971,83.521
                c3.633,2.642,5.454,8.242,4.064,12.51L77.452,391.932c-1.39,4.268,0.431,5.592,4.064,2.951l114.971-83.521
                c3.633-2.642,9.519-2.642,13.152,0l114.971,83.529c3.633,2.642,5.454,1.317,4.064-2.951l-43.911-135.154
                c-1.39-4.268,0.431-9.868,4.064-12.51l114.971-83.521c3.633-2.642,2.934-4.78-1.553-4.78H260.133V155.967z"/>
            </g>
        </symbol>
        <!-- Стрелка -->
        <symbol id="recastArrow" viewBox="0 0 26 15">
            <g>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.5582 0.524767C23.8586 -0.174922 22.7241 -0.174922 22.0244 0.524767L12.5413 10.0079L3.05824 0.524767C2.35855 -0.174922 1.22413 -0.174922 0.524442 0.524767C-0.175248 1.22446 -0.175248 2.35888 0.524442 3.05857L11.2744 13.8086C11.9741 14.5083 13.1086 14.5083 13.8082 13.8086L24.5582 3.05857C25.2579 2.35888 25.2579 1.22446 24.5582 0.524767Z"/>
            </g>
        </symbol>
    </svg>

<section class="product-page productItem-js"
         data-id="{{ $product->id }}"
         data-product-name="{{ $product->name }}"
         data-product-category="{{ $product->category }}">

<div class="container-xxl">
        <div class="product-page__top">
            <div class="d-lg-flex">
                <div class="product-page__top__gallery">
                    <div class="product-page__sticky-block pb-4">
                        <div class="position-relative">

                            <div class="product-page__gallery-awards">
                                <div class="product-page__gallery-award" style="background-image: url('{{ asset('img/award_3.png') }}')"></div>
                                <div class="product-page__gallery-award" style="background-image: url('{{ asset('img/award_2.png') }}')"></div>
                            </div>

                            <div class="product-page__gallery-slides swiper">
                                <div class="swiper-wrapper">
                                    <!-- ФОТО -->
                                                                                                                <!--GIF место 1-->
                                        
                                        <!--Детальное фото-->
                                                                                <div class="swiper-slide w-auto">
                                            <div class="product-page__gallery-item">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                        <!--MORE PHOTO-->
                                        @foreach ($product->images as $image)
                                        <div class="swiper-slide w-auto">
                                            <div class="product-page__gallery-item">
                                                <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }}"></div>
                                        </div>
                                        @endforeach                                                                                                                                       
                                                                                    
                                        
                                                                    </div>
                            </div>
                            <div class="product-page__gallery-thumbs-wrap d-none d-lg-block">
                                <div class="product-page__gallery-thumbs swiper" thumbsSlider="">
                                    <div class="swiper-wrapper p-2">
                                        <!-- ФОТО -->
                                                                                                                            <!--GIF место 1-->
                                            
                                            <!--Детальное фото-->
                                                                                        <div class="swiper-slide">
                                                <div class="product-page__gallery-thumb"
                                                    style="background-image: url('{{ asset($product->image) }}')"></div>
                                                </div>
                                            <!--MORE PHOTO-->
                                                @foreach ($product->images as $image)
                                                    <div class="swiper-slide w-auto">
                                                        <div class="product-page__gallery-item">
                                                            <img src="{{ asset($image->getThumbnailPath()) }}" alt="{{ $product->name }}">
                                                            </div>
                                                    </div>
                                                @endforeach                                                                                                                                                                             
                                            <!--GIF-->
                                            
                                                                            </div>
                                </div>
                            </div>
                                                            <div class="swiper-pagination d-flex d-lg-none justify-content-center mt-2"></div>
                                                    </div>
                    </div>

                </div>


        {{-- Правая колонка: название, цена, объем --}}
        <div class="product-page__top__base">
                    <div class="product-page__top__icons d-flex align-items-center justify-content-between">

                                                                    </div>
                    @if ($product->series)
                        <div class="mt-lg-6 d-flex justify-content-center">
                            <div class="product-page__top__tag product-tag" style="color: {{ $product->series->color }}; border-color: {{ $product->series->color }}">линейка {{ $product->series->name }}</div>
                        </div>
                    @endif
                                                                                                        <h1 class="mt-4" data-product-name="{{ $product->name }}">{{ $product->name }}</h1>
                    
                    <div class="product-page__top__price mt-2 mt-lg-4 mb-6 mb-lg-7">
                                                                                                                                                                                                                    <div class="product__price" data-product-price="{{ $product->price }}"><span>{{ $product->price }}</span> ₽</div>
                                                                                                                                            </div>

                    <div class="row">
                            <div class="col-6">
                    @if($product->volume)
                                <span class="simple-product-page__top__value">{{ $product->volume }}</span>
                            </div>
                        <div class="col-6 ps-lg-0">
                           
                    @else
    

                        </div>
                        <div class="col-6 ps-lg-0">
                    @endif

                        {{-- Описание --}}
                            <div class="product-page__top__short-about">
                                {!! $product->description_short !!}
                            </div>
                            <div class="product-page__top__about-link mt-2 js-detail-text">Полное описание</div>
                                <div class="html-detail-text" style="display: none">
                                {!! $product->description !!}
                                </div>
                            </div>

                            {{-- Кнопка В корзину --}}
                            <div class="product-page__top__add-block product-page__top__add-block_active mt-6 my-lg-7 d-flex">
                            <div class="product-page__top__count d-flex justify-content-between align-items-center">
                                <div class="product-page__top__count__minus" data-type="minus">-</div>
                                <div class="product-page__top__count__value">1</div>
                                <div class="product-page__top__count__plus" data-type="plus">+</div>
                            </div>

                                                        <div class="product-page__top__btn smo-btn product__btn"
                                data-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-category="{{ $product->category }}"
                                data-product-price="{{ $product->price }}">
                                В корзину
                            </div>
                        </div>


                            {{-- Применение --}}
                            <div class="product-page__top__sub-texts mt-4">
                                                                            <div class="product-page__top__sub-text p-4 mb-4">
                            <div class="product-page__top__sub-text__title mb-2">Применение</div>
                            <div class="product-page__top__sub-text__desc">
                                {!! $product->usage_short !!}
                            <div class="html-detail-text" style="display: none">
                                {!! $product->usage !!}
                                </div>
                                                                    </div>
                                <div class="product-page__top__sub-text__more mt-2 js-usage-detail">Подробнее</div>
                            </div>
                        
                            {{-- Ингредиенты --}}
                                <div class="product-page__top__sub-text p-4 mb-4">
                                    <div class="product-page__top__sub-text__title mb-2">Активные ингредиенты</div>
                                    <div class="product-page__top__sub-text__desc">
                                        {!! $product->ingredients_short !!}

                                <div class="html-detail-text" style="display: none">
                                        {!! $product->ingredients !!}
                                        </div>


                                </div>
                                <div class="product-page__top__sub-text__more mt-2 js-ingredients-detail">Подробнее</div>
                            </div>
                        
                            {{-- Упаковка --}}
    @if($product->packaging)
    <div class="product-page__top__sub-text p-4 mb-4">
        <div class="product-page__top__sub-text__title mb-2">Упаковка</div>
            <div class="product-page__top__sub-text__desc">
                {!! $product->packaging !!}
            </div>
    </div>

    @endif
                                                                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>
</main>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    console.log('jQuery работает');

    $('.js-detail-text').on('click', function (e) {
        e.preventDefault();
        const html = $(this).parent().find('.html-detail-text').html() || '';
        const content = '<div class="fly-popup__title">Описание</div><div class="fly-popup__text">' + html + '</div>';
        $('.fly-popup__cont').html(content);
        $('.fly-popup').css("display", "flex").removeClass('fly-popup2 fly-popup3');
        $('body').css('overflow', 'hidden');
    });

    $('.js-usage-detail').on('click', function (e) {
        e.preventDefault();
        const html = $(this).parent().find('.html-detail-text').html() || '';
        const content = '<div class="fly-popup__title">Применение</div><div class="fly-popup__text">' + html + '</div>';
        $('.fly-popup__cont').html(content);
        $('.fly-popup').css("display", "flex").removeClass('fly-popup2 fly-popup3');
        $('body').css('overflow', 'hidden');
    });

    $('.js-ingredients-detail').on('click', function (e) {
        e.preventDefault();
        const html = $(this).parent().find('.html-detail-text').html() || '';
        const content = '<div class="fly-popup__title">Ингредиенты</div><div class="fly-popup__text">' + html + '</div>';
        $('.fly-popup__cont').html(content);
        $('.fly-popup').css("display", "flex").removeClass('fly-popup2 fly-popup3');
        $('body').css('overflow', 'hidden');
    });

    $('.fly-popup__close, .fly-popup__overlay').on('click', function () {
        $('.fly-popup').hide();
        $('body').css('overflow', 'auto');
    });
});
</script>
@endpush


