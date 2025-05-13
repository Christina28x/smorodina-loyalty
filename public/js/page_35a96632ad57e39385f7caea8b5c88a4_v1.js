
; /* Start:"a:4:{s:4:"full";s:111:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/banner_gif_and_pics/script.js?17199092281820";s:6:"source";s:96:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/banner_gif_and_pics/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {

    $(".hero__slide_pic").each(function( index ) {
        if (screen.width < 767) {
            if($( this ).data('bg-mob')) {
                let mobBg = $( this ).data('bg-mob');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        }
    });

    $(".hero__slide_gif").each(function( index ) {
        if (screen.width < 767 && screen.width > 700) {
            if($( this ).data('bg-mob')) {
                let mobBg = $( this ).data('bg-mob');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        } else if (screen.width < 701 && screen.width > 600) {
            if($( this ).data('bg-mob-700')) {
                let mobBg = $( this ).data('bg-mob-700');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        } else if (screen.width < 601 && screen.width > 500) {
            if($( this ).data('bg-mob-600')) {
                let mobBg = $( this ).data('bg-mob-600');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        } else if (screen.width < 501 && screen.width > 450) {
            if($( this ).data('bg-mob-500')) {
                let mobBg = $( this ).data('bg-mob-500');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        } else if (screen.width < 451) {
            if($( this ).data('bg-mob-450')) {
                let mobBg = $( this ).data('bg-mob-450');
                $(this).css('background-image', 'url(' + mobBg + ')');
            }
        }
    });


    // метрика
    $(".hero__slide").find('.smo-btn').on("click", function () {
        if (typeof ym != 'undefined') {
            ym('93813833', 'reachGoal', 'front_banner_click');
        }
    })

});

/* End */
;
; /* Start:"a:4:{s:4:"full";s:115:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js?168905152327";s:6:"source";s:102:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {


});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:106:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/special-offers/script.js?16956219582072";s:6:"source";s:91:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/special-offers/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
$(function () {
    $('.main-research__link').on('click', function () {
        let id = $(this).data('id');

        if (id == 2237) {
            // Категория "лицо" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_face_click');
            }
        }

        if (id == 2238) {
            // Категория "тело" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_body_click');
            }
        }

        if (id == 2239) {
            // Категория "уход за волосами" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_hair_click');
            }
        }

        if (id == 2240) {
            // Категория "твердые продукты" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_tverdye-produkty_click');
            }
        }

        if (id == 2241) {
            // Категория "комплексный уход" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_complex-care_click');
            }
        }

        if (id == 2242) {
            // Категория "депиляция" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_depilation_click');
            }
        }

        if (id == 2243) {
            // Категория "свечи и масла" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_aromatherapy_click');
            }
        }

        if (id == 2244) {
            // Категория "эко-аксессуары" на главной
            if (typeof ym != 'undefined') {
                ym('76511557', 'reachGoal', 'front_aksessuary_click');
            }
        }
    });
})
/* End */
;
; /* Start:"a:4:{s:4:"full";s:78:"/local/templates/smorodinacosmetic_f61/lib/lazyload/lazyload.js?16890515213721";s:6:"source";s:63:"/local/templates/smorodinacosmetic_f61/lib/lazyload/lazyload.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
//Медленная загрузка изображений
function lazyload() {
    $(".lazyload").each(function () {
        if ($(this).offset().top > 0) {
            var etop = $(this).offset().top;
            var stop = $(document).scrollTop();

            if (stop + window.innerHeight > etop - 100) {
                var bg = $(this).attr("data-bg");
                if (bg && bg != "") $(this).css("background-image", 'url(\'' + bg + '\')');
                $(this).removeAttr("data-bg").removeClass('lazyload');

                var src = $(this).attr("data-src");
                if (src && src != "") $(this).attr("src", src);
                $(this).removeAttr("data-src");
            }
        }
    });
}

$(document).scroll(function () {
    lazyload();
});
lazyload();




// Проверяем, можно ли использовать Webp формат
function canUseWebp() {
    // Создаем элемент canvas
    let elem = document.createElement('canvas');
    // Приводим элемент к булеву типу
    if (!!(elem.getContext && elem.getContext('2d'))) {
        // Создаем изображение в формате webp, возвращаем индекс искомого элемента и сразу же проверяем его
        return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
    }
    // Иначе Webp не используем
    return false;
}

var webp = canUseWebp();


window.onload = function () {
    // Проверяем, является ли браузер посетителя сайта Firefox и получаем его версию
    let isitFirefox = window.navigator.userAgent.match(/Firefox\/([0-9]+)\./);
    let firefoxVer = isitFirefox ? parseInt(isitFirefox[1]) : 0;

    // Если есть поддержка Webp или браузер Firefox версии больше или равно 65
    if (!webp && firefoxVer < 65) {
        $('[style*=webp]').each(function () {
            // Получаем значение каждого дата-атрибута
            let bg = $(this).css('background-image');
            // Каждому найденному элементу задаем свойство background-image с изображение формата jpg
            $(this).css('background-image', bg.replace(new RegExp("webp", 'g'), "jpg"));
        });
        $('[src*=webp]').each(function () {
            // Получаем значение каждого дата-атрибута
            let bg = $(this).attr('src');
            // Каждому найденному элементу задаем свойство background-image с изображение формата jpg
            $(this).attr('src', bg.replace(new RegExp("webp", 'g'), "jpg"));
        });
        $('[data-src*=webp]').each(function () {
            // Получаем значение каждого дата-атрибута
            let bg = $(this).attr('data-src');
            // Каждому найденному элементу задаем свойство background-image с изображение формата jpg
            $(this).attr('data-src', bg.replace(new RegExp("webp", 'g'), "jpg"));
        });
        $('[data-bg*=webp]').each(function () {
            // Получаем значение каждого дата-атрибута
            let bg = $(this).attr('data-bg');
            // Каждому найденному элементу задаем свойство background-image с изображение формата jpg
            $(this).attr('data-bg', bg.replace(new RegExp("webp", 'g'), "jpg"));
        });
    }
}
/* End */
;
; /* Start:"a:4:{s:4:"full";s:97:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/awards/script.js?1689051525576";s:6:"source";s:83:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/awards/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
$(function () {
    const productSwiper = new Swiper('.awards__container', {
        slidesPerView: 1,
        spaceBetween: 13,
        freeMode: false,
        loop: false,
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 18
            },
            680: {
                slidesPerView: 5,
                spaceBetween: 20
            },
        },
        navigation: {
            nextEl: ".awards .slider-button-next-svg_pink",
            prevEl: ".awards .slider-button-prev-svg_pink",
        },
    });
})


/* End */
;
; /* Start:"a:4:{s:4:"full";s:101:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/advantages/script.js?1691423809268";s:6:"source";s:87:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/advantages/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
$(function () {

    $( ".main-awards__slides-icons__icon" ).each(function( index ) {
        let titleColor = $( this ).data('color-mob');
        if(screen.width < 767) {
            $(this).find('.main-awards__name').css('color',titleColor);
        }
    });

})


/* End */
;
; /* Start:"a:4:{s:4:"full";s:110:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers-season/script.js?168905152327";s:6:"source";s:97:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers-season/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {


});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:110:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/blogposts_front_f61/script.js?1697459077795";s:6:"source";s:96:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/blogposts_front_f61/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {

    $(".metrica-link").on("click", function () {
        // if (typeof ym != 'undefined') {
        //     ym('76511557', 'reachGoal', 'blog_article_click_front');
        // }
    })

    new Swiper('.front-blog__slides', {
        breakpoints: {
            0: {
                slidesPerView: 2.1,
                spaceBetween: 10,
            },
            767: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    })

    $(".front-blog-item").on("mouseenter touchstart", function () {
        $(this).removeClass('leave');
        $(this).addClass('enter');
    });

    $(".front-blog-item").on("mouseleave touchend", function () {
        $(this).removeClass('enter');
        $(this).addClass('leave');
    });

});



/* End */
;; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/banner_gif_and_pics/script.js?17199092281820*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js?168905152327*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/special-offers/script.js?16956219582072*/
; /* /local/templates/smorodinacosmetic_f61/lib/lazyload/lazyload.js?16890515213721*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/awards/script.js?1689051525576*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/advantages/script.js?1691423809268*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers-season/script.js?168905152327*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/blogposts_front_f61/script.js?1697459077795*/
