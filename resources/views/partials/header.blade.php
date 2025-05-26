<header class="header">
    


<!--NEW-->
        

    <div class="top-marquee_slider swiper-fade swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
        <div class="swiper-wrapper top-marquee__track_slider" id="swiper-wrapper-327ce10514e9475c2" aria-live="off" style="transition-duration: 0ms;">
                            
                            
                    <a href="https://smorodinacosmetic.com/" class="swiper-slide top-marquee__text_slider swiper-slide-next swiper-slide-prev" role="group" aria-label="2 / 2" data-swiper-slide-index="1" style="width: 1507px; opacity: 0; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">Подарки в заказах: от 6000 рублей - полноразмерный, от 3000 рублей - мини сайз</a><a href="https://smorodinacosmetic.com/shipping_and_payment/" class="swiper-slide top-marquee__text_slider swiper-slide-visible swiper-slide-active" role="group" aria-label="1 / 2" data-swiper-slide-index="0" style="width: 1507px; opacity: 1; transform: translate3d(-1507px, 0px, 0px); transition-duration: 0ms;">Бесплатная доставка до пунктов выдачи от 3500 рублей*</a></div>
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    <div class="container-xxl">
        <div class="header__wrap d-flex justify-content-between align-items-center">
            <div class="header__wrap__lb d-flex align-items-center">
                <div class="header__menu-icon header__icon">
                    <svg class="header__menu-icon__default"><use href="#hamburger"></use></svg>
                    <svg class="header__menu-icon__close"><use href="#close"></use></svg>
                </div>
                <div class="header__search-icon header__icon">
                    <svg><use href="#loupe"></use></svg>
                </div>

                <div class="header__logo d-none d-lg-block">
                    <a href="/" title="SMORODINA - российский производитель натуральной косметики европейского качества!"><svg><use href="#logo"></use></svg></a>
                </div>
                <nav class="header__menu d-none d-lg-flex">
                    <a href="/promotions" class="header__menu__item" data-sec-id="12">Наборы</a>
                    <a href="/sets" class="header__menu__item">Серии</a>
                    <a href="/catalog/face" class="header__menu__item" data-sec-id="1">Лицо</a>
                    <a href="/catalog/body/" class="header__menu__item" data-sec-id="13">Тело</a>
                    <a href="/catalog/hair-care/" class="header__menu__item" data-sec-id="11">Волосы</a>
                    <a href="/catalog/tverdye-produkty/" class="header__menu__item" data-sec-id="68">Твердые продукты</a>
                    <a href="/catalog/aromatherapy/" class="header__menu__item" data-sec-id="15">Свечи и ароматерапия</a>
                </nav>
            </div>
            <div class="header__logo d-block d-lg-none">
                <a href="/"><svg><use href="#logo"></use></svg></a>
            </div>
            <div class="header__wrap__rb d-flex">
                                
                <div class="header__cabinet header__icon d-flex" role="button" tabindex="0">
                    <svg><use href="#person"></use></svg>
                </div>

                @auth
                    <a href="/cabinet/?view=favorites" class="header__favorites header__icon">
                        <svg><use href="#heart"></use></svg>
                    </a>
                @endauth


<a href="/cart/" class="header__cart header__icon">
    <svg><use href="#bag"></use></svg>
            <span class="count_cart"
          id="cart-count"
          style="{{ session('cart') && collect(session('cart'))->sum('quantity') > 0 ? 'display: inline' : 'display: none' }}">
        {{ session('cart') ? collect(session('cart'))->sum('quantity') : '' }}
    </span>
    </a>            </div>
        </div>
    </div>
</header>

<!-- результаты поиска -->
<section class="fast-search py-4 w-100 fixed-top">
    <div class="container-xxl" id="searchBox">
        


<!--    -->
<div id="searchHeader" class="search" role="search">

    <div class="fast-search__back" id="closeSearch">Вернуться назад</div>
    <div class="fast-search__form mt-4">
        <input class="search__input" name="search-form-query" type="search" placeholder="" autocomplete="false">
    </div>
    <div class="search__results-wrapper" id="searchHeaderResults"></div>

    
</div>    </div>
</section>

<!-- меню -->


    

<section class="mega-menu d-none">
    <div class="container-xxl">
        <pre class="d-none">Array
(
    [ICON] =&gt; https://smorodinacosmetic.com/upload/resize_cache/iblock/14c/rga69m36e9rseq8i0mfcu355y0gk1hqf/34_34_2/sets_2.png
    [LIST] =&gt; Array
        (
            [0] =&gt; Array
                (
                    [ID] =&gt; 115
                    [~ID] =&gt; 115
                    [NAME] =&gt; Лицо
                    [~NAME] =&gt; Лицо
                    [CODE] =&gt; complex-face/ready
                    [~CODE] =&gt; complex-face
                    [SORT] =&gt; 10
                    [~SORT] =&gt; 10
                )

            [1] =&gt; Array
                (
                    [ID] =&gt; 116
                    [~ID] =&gt; 116
                    [NAME] =&gt; Волосы
                    [~NAME] =&gt; Волосы
                    [CODE] =&gt; complex-hair/ready
                    [~CODE] =&gt; complex-hair
                    [SORT] =&gt; 20
                    [~SORT] =&gt; 20
                )

            [2] =&gt; Array
                (
                    [ID] =&gt; 117
                    [~ID] =&gt; 117
                    [NAME] =&gt; Тело
                    [~NAME] =&gt; Тело
                    [CODE] =&gt; complex-body/ready
                    [~CODE] =&gt; complex-body
                    [SORT] =&gt; 30
                    [~SORT] =&gt; 30
                )

            [3] =&gt; Array
                (
                    [ID] =&gt; 118
                    [~ID] =&gt; 118
                    [NAME] =&gt; Ароматерапия
                    [~NAME] =&gt; Ароматерапия
                    [CODE] =&gt; complex-aroma/ready
                    [~CODE] =&gt; complex-aroma
                    [SORT] =&gt; 40
                    [~SORT] =&gt; 40
                )

        )

)
</pre>
        <div class="mega-menu__wrap d-lg-flex justify-content-between align-items-start">
            <div class="search__input_fake fake-search-input">
                <img class="fake-search-input__icon" src="{{ asset('img/loupe_gray.svg') }}" alt="loupe">
                <div class="fake-search-input__text">Найти на сайте</div>
            </div>
            <div class="mega-menu__menu">
                <ul>
                    <li><a class="" href="/catalog/"><span><img class="burger-pic" src="{{ asset('img/all_2.png') }}" alt=""></span> <div class="get-lvl2__title">Все продукты</div></a>
                        <ul>

                        </ul>
                    </li>
                                        <li><a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow"><span><img class="burger-pic" src="{{ asset('img/sets_2.png') }}" alt=""></span> <div class="get-lvl2__title">Наборы</div></a>
                        <ul>
                            <li><a href="/promotions">Все товары</a></li>
                                                            <li><a href="/promotions/complex-face/ready/">Лицо</a></li>
                                                            <li><a href="/promotions/complex-hair/ready/">Волосы</a></li>
                                                            <li><a href="/promotions/complex-body/ready/">Тело</a></li>
                                                            <li><a href="/promotions/complex-aroma/ready/">Ароматерапия</a></li>
                                                    </ul>
                    </li>

                    <!--                    <li><a class="mega-menu__menu__get-lvl2" href="/sets/"><span></span> Линейки</a>-->
                    <li><a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow"><span><img class="burger-pic" src="{{ asset('img/series_2.png') }}" alt=""></span> <div class="get-lvl2__title">Серии</div></a>
                        <ul>
                            <li><a class="" href="/sets/">Все товары</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="microbiome" data-set-id="2253" data-products-id="18,1476,2947,2837,2838,1330,2844,146,817,82,2379,2394,2395,2905" href="/sets/microbiome/">microbiome</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="lifting" data-set-id="2254" data-products-id="2857,1924,73,1986,144,813,2301" href="/sets/lifting/">smart-lifting</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="smart anti-acne" data-set-id="2255" data-products-id="1471,2761,1076,2747,1061,76,112,814,1474" href="/sets/smart%20anti-acne/">smart anti-acne</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="smart-age" data-set-id="2256" data-products-id="1064,75,2702,108,811,2722,2817,2833,2834,2835,2928,2927" href="/sets/smart-age/">smart-age</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="sensitive" data-set-id="2257" data-products-id="2884,2889,2888,1063" href="/sets/sensitive/">sensitive </a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="hydration" data-set-id="2258" data-products-id="2660,1060,65,74,2667,2674,2954,2957" href="/sets/hydration/">hydration</a></li>
                            <!--                                <li><a class="mega-menu__menu__get-products " data-cat="--><!--" data-set-id="--><!--" data-products-id="--><!--" href="/sets/--><!--/">--><!--</a></li>-->
                                <li><a class="" data-cat="spf" data-set-id="2259" data-products-id="1026,1027,1028,1029,1025,2589,2590,2587,2588" href="/sets/spf/">spf</a></li>
                                                    </ul>
                    </li>

                                                                        <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a onclick="document.location=&#39;/catalog/novinki/&#39;" class="mega-menu__menu__get-lvl2  ">
                                    <span><img class="burger-pic" src="{{ asset('img/Novinki.jpg') }}" alt=""></span><div class="get-lvl2__title">Новинки</div>
                                </a>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow  ">
                                    <span><img class="burger-pic" src="{{ asset('img/Litso.jpg') }}" alt=""></span><div class="get-lvl2__title">ЛИЦО</div>
                                </a>
                                                                    <ul>

                                        <li><a href="/catalog/face/">Все товары</a></li>

                                                                                                                                                                                         <li><a class="mega-menu__menu__get-products" data-cat="prodykty-v-prezhnem-dyzayne" data-sec-id="122" href="/catalog/face/prodykty-v-prezhnem-dyzayne/">Продукты в прежнем дизайне</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="enzyme-system" data-sec-id="5" href="/catalog/face/enzyme-system/">Очищение</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="tonery" data-sec-id="102" href="/catalog/face/tonery/">Тонеры</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="hydrolate" data-sec-id="8" href="/catalog/face/hydrolate/">Гидролаты</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="serum" data-sec-id="6" href="/catalog/face/serum/">Сыворотки</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="cream" data-sec-id="4" href="/catalog/face/cream/">Кремы для лица</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="ukhod-za-kozhey-vokrug-glaz" data-sec-id="107" href="/catalog/face/ukhod-za-kozhey-vokrug-glaz/">Кремы для кожи вокруг глаз</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="kremy-s-spf" data-sec-id="65" href="/catalog/face/kremy-s-spf/">SPF-кремы</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="alginate-masks" data-sec-id="7" href="/catalog/face/alginate-masks/">Маски</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="patchi" data-sec-id="2" href="/catalog/face/patchi/">Патчи</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="accessories" data-sec-id="9" href="/catalog/face/accessories/">Спонжи</a></li>
                                                                                                                                                                         </ul>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow  ">
                                    <span><img class="burger-pic" src="{{ asset('img/Volosy.jpg') }}" alt=""></span><div class="get-lvl2__title">ВОЛОСЫ</div>
                                </a>
                                                                    <ul>

                                        <li><a href="/catalog/hair-care/">Все товары</a></li>

                                                                                                                                                                                         <li><a class="mega-menu__menu__get-products" data-cat="shampuni" data-sec-id="37" href="/catalog/hair-care/shampuni/">Шампуни</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="konditsionery" data-sec-id="39" href="/catalog/hair-care/konditsionery/">Кондиционеры</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="refily" data-sec-id="134" href="/catalog/hair-care/refily/">Рефилы</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="tverdye-shampuni-i-konditsionery" data-sec-id="69" href="/catalog/hair-care/tverdye-shampuni-i-konditsionery/">Твердые шампуни и кондиционеры</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="aromaraschesyvanie" data-sec-id="51" href="/catalog/hair-care/aromaraschesyvanie/">Аромарасчесывание</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="polotentse-s" data-sec-id="52" href="/catalog/hair-care/polotentse-s/">Полотенце</a></li>
                                                                                                                                                                         </ul>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow  ">
                                    <span><img class="burger-pic" src="{{ asset('img/Telo.jpg') }}" alt=""></span><div class="get-lvl2__title">ТЕЛО</div>
                                </a>
                                                                    <ul>

                                        <li><a href="/catalog/body/">Все товары</a></li>

                                                                                                                                                                                         <li><a class="mega-menu__menu__get-products" data-cat="vygodnoe-predlozhenie" data-sec-id="133" href="/catalog/body/vygodnoe-predlozhenie/">Продукты в прежнем дизайне</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="sugar-and-salt" data-sec-id="16" href="/catalog/body/sugar-and-salt/">Сахарно-соляные скрабы</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="krem-dlya-tela-i-ruk" data-sec-id="123" href="/catalog/body/krem-dlya-tela-i-ruk/">Крем для тела и рук</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-tel" data-sec-id="106" href="/catalog/body/tverdye-produkty-dlya-tel/">Твердые продукты для тела</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="brush" data-sec-id="18" href="/catalog/body/brush/">Щётки для сухого массажа</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="oil-with-essential-oils" data-sec-id="19" href="/catalog/body/oil-with-essential-oils/">Масла для тела</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="nabor-dlya-depilyatsii" data-sec-id="120" href="/catalog/body/nabor-dlya-depilyatsii/">Депиляция</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="vodostoykiy-spf-sprey" data-sec-id="67" href="/catalog/body/vodostoykiy-spf-sprey/">SPF кремы для лица и тела</a></li>
                                                                                                                                                                         </ul>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow  ">
                                    <span><img class="burger-pic" src="{{ asset('img/SMRDN_3459-1-2.jpg') }}" alt=""></span><div class="get-lvl2__title">ТВЕРДЫЕ ПРОДУКТЫ</div>
                                </a>
                                                                    <ul>

                                        <li><a href="/catalog/tverdye-produkty/">Все товары</a></li>

                                                                                                                                                                                         <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-volos" data-sec-id="71" href="/catalog/tverdye-produkty/tverdye-produkty-dlya-volos/">Для волос</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-litsa" data-sec-id="73" href="/catalog/tverdye-produkty/tverdye-produkty-dlya-litsa/">Для лица</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-tela" data-sec-id="72" href="/catalog/tverdye-produkty/tverdye-produkty-dlya-tela/">Для тела </a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="aksessuary-dlya-sushki-i-khraneniya" data-sec-id="70" href="/catalog/tverdye-produkty/aksessuary-dlya-sushki-i-khraneniya/">Аксессуары </a></li>
                                                                                                                                                                         </ul>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow  ">
                                    <span><img class="burger-pic" src="{{ asset('img/Frame-2087326659.jpg') }}" alt=""></span><div class="get-lvl2__title">СВЕЧИ И АРОМАТЕРАПИЯ</div>
                                </a>
                                                                    <ul>

                                        <li><a href="/catalog/aromatherapy/">Все товары</a></li>

                                                                                                                                                                                         <li><a class="mega-menu__menu__get-products" data-cat="aroma-therapy-massage-candles" data-sec-id="21" href="/catalog/aromatherapy/aroma-therapy-massage-candles/">Массажные свечи Aromatherapy</a></li>
                                                                                                                                                                                                 <li><a class="mega-menu__menu__get-products" data-cat="interior-candles-selective" data-sec-id="22" href="/catalog/aromatherapy/interior-candles-selective/">Интерьерные свечи Selective</a></li>
                                                                                                                                                                         </ul>
                                                            </li>
                                                    <li>
<!--                                <a class="mega-menu__menu__get-lvl2" href="--><!--"><span></span>--><!--</a>-->

                                                                <a onclick="document.location=&#39;/catalog/aksessuary-/&#39;" class="mega-menu__menu__get-lvl2  ">
                                    <span><img class="burger-pic" src="{{ asset('img/SMRDN_3459-1-3.jpg') }}" alt=""></span><div class="get-lvl2__title">ЭКОАКСЕССУАРЫ</div>
                                </a>
                                                            </li>
                                                                <li>
                        <a href="/certificate/" class="mega-menu__menu__get-lvl2_with-arrow_ ">
                            <span><img class="burger-pic" src="{{ asset('img/cert_2.png') }}" alt=""></span>
                            <div class="get-lvl2__title get-lvl2__title_static">Подарочный сертификат</div>
                        </a>
                    </li>
                </ul>

                <div class="mega-menu__banners_mob">
                                                                        
                                                            <a href="/promotions/" class="catalog-banner-2 d-flex flex-column align-items-center justify-content-between p-4" style="background-image: url(&#39;https://smorodinacosmetic.com/upload/iblock/191/cz17ag9b75fvzqxt4q1ztarc34tbwwi1/Category-Cards_4.jpg&#39;)">
                                    <div class="catalog-banner-2__tag">готовое решение</div>
                                    <span class="catalog-banner-2__title">для каждого типа кожи</span>
                                </a>
                                                                                        </div>

                <ul class="mt-8 mega-menu__points-bottom">
                    <li><a class="get-lvl2__title_static" href="/about/">О компании</a></li>
                    <li><a class="get-lvl2__title_static" href="/shipping_and_payment/">Покупателю</a></li>

                    <li class="pointed">
                        <a class="mega-menu__menu__get-lvl2 mega-menu__menu__get-lvl2_with-arrow">
                            <div class="get-lvl2__title">Партнерам</div>
                        </a>
                        <ul>
                            <li><a href="/partners/">Оптовым партнерам</a></li>
                            <li><a href="/foreign-partnership/">Зарубежным партнерам</a></li>
                        </ul>
                    </li>

                    <li><a class="get-lvl2__title_static" href="https://smorodinacosmetic.com/contacts/">Контакты</a></li>
<!--                    <li><a class="get-lvl2__title_static" href="/company_promotions/">Акции</a></li>-->

                </ul>
            </div>

            <div class="mega-menu__banners mega-menu__banners_desc">
                <div class="row">
                    <div class="mega-menu__banners mega-menu__banners_desc">
                                                    <div class=" mega-menu__banners-grid-1">
                                                                    
                                    
                                        <div class=""><!--col-md-6-->
                                            <a href="/promotions/" class="catalog-banner-2 d-flex flex-column align-items-center justify-content-between p-4" style="background-image: url(&#39;https://smorodinacosmetic.com/upload/iblock/191/cz17ag9b75fvzqxt4q1ztarc34tbwwi1/Category-Cards_4.jpg&#39;)">
                                                <div class="catalog-banner-2__tag">готовое решение</div>
                                                <span class="catalog-banner-2__title">для каждого типа кожи</span>
                                            </a>
                                        </div>

                                                                                                </div>
                                            </div>
                </div>
            </div>

            <div class="mega-menu__products d-none">
                <div class="row justify-content-end">
                    <div class="mega-menu__products-grid" id="mega-menu-products">

                    </div>


<!--                        --><!--                            <div class="mega-menu__products-grid" id="mega-menu-products_sets" data-set-id="--><!--">-->
<!--                                --><!---->
<!--                                    --><!---->
<!--                                --><!--                            </div>-->
<!--                        -->

                </div>
            </div>
        </div>
    </div>
</section>







<!--    -->

<section class="mega-menu_top d-none">
    <div class="container-xxl">
        <div class="mega-menu__wrap d-lg-flex justify-content-between align-items-start">
            <div class="mega-menu__menu">
                <ul>
                                                                        <li data-sec-id="12">
                                <ul>
                                    <li><a href="/catalog/promotions/">Все товары</a></li>
                                                                                                                        <li><a class="mega-menu__menu__get-products" data-cat="nabory-dlya-ukhoda-za-volosami-10" data-child-id="43" href="https://smorodinacosmetic.com/catalog/promotions/nabory-dlya-ukhoda-za-volosami-10/">Уход за волосами</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="nabory-s-tonerami" data-child-id="103" href="https://smorodinacosmetic.com/catalog/promotions/nabory-s-tonerami/">Наборы с тонерами</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="syvorotka-krem" data-child-id="76" href="https://smorodinacosmetic.com/catalog/promotions/syvorotka-krem/">Сыворотка  + Крем</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="ekspress-ukhod-" data-child-id="40" href="https://smorodinacosmetic.com/catalog/promotions/ekspress-ukhod-/">Дуэты</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="basic-care" data-child-id="27" href="https://smorodinacosmetic.com/catalog/promotions/basic-care/">Базовый уход</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="advanced-care" data-child-id="26" href="https://smorodinacosmetic.com/catalog/promotions/advanced-care/">Продвинутый уход плюс</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="course-masks" data-child-id="28" href="https://smorodinacosmetic.com/catalog/promotions/course-masks/">Курсы масок</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="anti-cellulite" data-child-id="30" href="https://smorodinacosmetic.com/catalog/promotions/anti-cellulite/">Антицеллюлитные комплексы</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="populyarnye-tovary-10-" data-child-id="41" href="https://smorodinacosmetic.com/catalog/promotions/populyarnye-tovary-10-/">Бестселлеры</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="podarochnye-nabory" data-child-id="105" href="https://smorodinacosmetic.com/catalog/promotions/podarochnye-nabory/">Подарочные наборы</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="prodvinutyy-ukhod" data-child-id="119" href="https://smorodinacosmetic.com/catalog/promotions/prodvinutyy-ukhod/">Продвинутый уход</a></li>
                                                                                                            </ul>
                            </li>
                                                    <li data-sec-id="68">
                                <ul>
                                    <li><a href="https://smorodinacosmetic.com/catalog/tverdye-produkty/">Все товары</a></li>
                                                                                                                        <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-volos" data-child-id="71" href="https://smorodinacosmetic.com/catalog/tverdye-produkty/tverdye-produkty-dlya-volos/">Для волос</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-litsa" data-child-id="73" href="https://smorodinacosmetic.com/catalog/tverdye-produkty/tverdye-produkty-dlya-litsa/">Для лица</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-tela" data-child-id="72" href="https://smorodinacosmetic.com/catalog/tverdye-produkty/tverdye-produkty-dlya-tela/">Для тела </a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="aksessuary-dlya-sushki-i-khraneniya" data-child-id="70" href="https://smorodinacosmetic.com/catalog/tverdye-produkty/aksessuary-dlya-sushki-i-khraneniya/">Аксессуары </a></li>
                                                                                                            </ul>
                            </li>
                                                    <li data-sec-id="1">
                                <ul>
                                    <li><a href="https://smorodinacosmetic.com/catalog/face/">Все товары</a></li>
                                                                                                                        <li><a class="mega-menu__menu__get-products" data-cat="prodykty-v-prezhnem-dyzayne" data-child-id="122" href="https://smorodinacosmetic.com/catalog/face/prodykty-v-prezhnem-dyzayne/">Продукты в прежнем дизайне</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="enzyme-system" data-child-id="5" href="https://smorodinacosmetic.com/catalog/face/enzyme-system/">Очищение</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="tonery" data-child-id="102" href="https://smorodinacosmetic.com/catalog/face/tonery/">Тонеры</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="hydrolate" data-child-id="8" href="https://smorodinacosmetic.com/catalog/face/hydrolate/">Гидролаты</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="serum" data-child-id="6" href="https://smorodinacosmetic.com/catalog/face/serum/">Сыворотки</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="cream" data-child-id="4" href="https://smorodinacosmetic.com/catalog/face/cream/">Кремы для лица</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="ukhod-za-kozhey-vokrug-glaz" data-child-id="107" href="https://smorodinacosmetic.com/catalog/face/ukhod-za-kozhey-vokrug-glaz/">Кремы для кожи вокруг глаз</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="kremy-s-spf" data-child-id="65" href="https://smorodinacosmetic.com/catalog/face/kremy-s-spf/">SPF-кремы</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="alginate-masks" data-child-id="7" href="https://smorodinacosmetic.com/catalog/face/alginate-masks/">Маски</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="patchi" data-child-id="2" href="https://smorodinacosmetic.com/catalog/face/patchi/">Патчи</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="accessories" data-child-id="9" href="https://smorodinacosmetic.com/catalog/face/accessories/">Спонжи</a></li>
                                                                                                            </ul>
                            </li>
                                                    <li data-sec-id="11">
                                <ul>
                                    <li><a href="https://smorodinacosmetic.com/catalog/hair-care/">Все товары</a></li>
                                                                                                                        <li><a class="mega-menu__menu__get-products" data-cat="shampuni" data-child-id="37" href="https://smorodinacosmetic.com/catalog/hair-care/shampuni/">Шампуни</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="konditsionery" data-child-id="39" href="https://smorodinacosmetic.com/catalog/hair-care/konditsionery/">Кондиционеры</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="refily" data-child-id="134" href="https://smorodinacosmetic.com/catalog/hair-care/refily/">Рефилы</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="tverdye-shampuni-i-konditsionery" data-child-id="69" href="https://smorodinacosmetic.com/catalog/hair-care/tverdye-shampuni-i-konditsionery/">Твердые шампуни и кондиционеры</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="aromaraschesyvanie" data-child-id="51" href="https://smorodinacosmetic.com/catalog/hair-care/aromaraschesyvanie/">Аромарасчесывание</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="polotentse-s" data-child-id="52" href="https://smorodinacosmetic.com/catalog/hair-care/polotentse-s/">Полотенце</a></li>
                                                                                                            </ul>
                            </li>
                                                    <li data-sec-id="13">
                                <ul>
                                    <li><a href="https://smorodinacosmetic.com/catalog/body/">Все товары</a></li>
                                                                                                                        <li><a class="mega-menu__menu__get-products" data-cat="sugar-and-salt" data-child-id="16" href="https://smorodinacosmetic.com/catalog/body/sugar-and-salt/">Сахарно-соляные скрабы</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="vygodnoe-predlozhenie" data-child-id="133" href="https://smorodinacosmetic.com/catalog/body/vygodnoe-predlozhenie/">Продукты в прежнем дизайне</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="krem-dlya-tela-i-ruk" data-child-id="123" href="https://smorodinacosmetic.com/catalog/body/krem-dlya-tela-i-ruk/">Крем для тела и рук</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="tverdye-produkty-dlya-tel" data-child-id="106" href="https://smorodinacosmetic.com/catalog/body/tverdye-produkty-dlya-tel/">Твердые продукты для тела</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="brush" data-child-id="18" href="https://smorodinacosmetic.com/catalog/body/brush/">Щётки для сухого массажа</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="oil-with-essential-oils" data-child-id="19" href="https://smorodinacosmetic.com/catalog/body/oil-with-essential-oils/">Масла для тела</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="nabor-dlya-depilyatsii" data-child-id="120" href="https://smorodinacosmetic.com/catalog/body/nabor-dlya-depilyatsii/">Депиляция</a></li>
                                                                                    <li><a class="mega-menu__menu__get-products" data-cat="vodostoykiy-spf-sprey" data-child-id="67" href="https://smorodinacosmetic.com/catalog/body/vodostoykiy-spf-sprey/">SPF кремы для лица и тела</a></li>
                                                                                                            </ul>
                            </li>
                                                            </ul>
            </div>

            <div class="mega-menu__banners">
                <div class="row">
                    <div class="col-md-6">
                        <div class="catalog-banner-2 d-flex flex-column align-items-center justify-content-between p-4" style="background-image: url(&#39;/local/templates/smorodinacosmetic_f61/images/mega-menu/banner_2.jpg&#39;)">
                            <div class="catalog-banner-2__tag">готовое решение</div>
                            <a href="https://smorodinacosmetic.com/catalog/promotions/" class="catalog-banner-2__title">для каждого типа кожи</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="catalog-banner-1 d-flex flex-column align-items-center justify-content-center">
                            <div class="catalog-banner-1__title">30%<br>на уход<br>для тела</div>
                            <a href="https://smorodinacosmetic.com/catalog/body/" class="smo-btn mt-2 mt-md-4 mt-lg-6">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mega-menu__products d-none">
                <div class="row justify-content-end">
                    <div class="mega-menu__products-grid" id="mega-menu-products_top">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>