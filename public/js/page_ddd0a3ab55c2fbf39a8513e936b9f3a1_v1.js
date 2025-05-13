
; /* Start:"a:4:{s:4:"full";s:148:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog/catalog_flash_spf_1/bitrix/catalog.element/element_review/script.js?172966704819976";s:6:"source";s:132:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog/catalog_flash_spf_1/bitrix/catalog.element/element_review/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
function loadSlider() {
    /* product page gallery */

    const productThumbsSlides = new Swiper('.product-page__gallery-thumbs', {
        spaceBetween: 8,
        slidesPerView: 9,
        freeMode: true,
        watchSlidesProgress: true,
    });

    new Swiper('.product-page__gallery-slides', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        thumbs: {
            swiper: productThumbsSlides,
        },
        navigation: false,
        breakpoints: {
            0: {
                pagination: {
                    el: '.product-page__top__gallery .swiper-pagination',
                    clickable: true,
                }
            },
            992: {
                pagination: false,
                spaceBetween: 20
            }
        }
    });

}

jQuery(function ($) {
    // Первый отмеченный элемент в зависимости от сортировки
    let firstInput = $('#volumeFormSKU').find('.volume__input').first();
    $(firstInput).addClass('input-active');
    $(firstInput).parent('.volume-input__wrap').addClass('volume-input__wrap_active');
    let firstIdCheckedSKU = $(firstInput).attr('id');
    $('.inactive_title[data-tab="'+ firstIdCheckedSKU +'"]').addClass('active');
    $('.inactive_price[data-tab="'+ firstIdCheckedSKU +'"]').addClass('active');
    $('.inactive_img[data-tab="'+ firstIdCheckedSKU +'"]').addClass('active');
    $('.inactive_img[data-tab="'+ firstIdCheckedSKU +'"]').parent('.swiper-slide').removeClass('not-active_sl');
    $('.inactive_btn[data-tab="'+ firstIdCheckedSKU +'"]').addClass('active');

    // Подгрузка ID для первого торгового предложения
    let firstInputId = firstInput.data('tab');
    $('.product__btn').attr('data-id', firstInputId);


    // для отображения названия продукта, цены
    $('#volumeFormSKU input:radio:checked').each(function(){
        let idCheckedSKU = $(this).attr('id'),
            title = $('.inactive_title[data-tab="'+ idCheckedSKU +'"]'),
            price = $('.inactive_price[data-tab="'+ idCheckedSKU +'"]'),
            img = $('.inactive_img[data-tab="'+ idCheckedSKU +'"]');
            btn = $('.inactive_btn[data-tab="'+ idCheckedSKU +'"]');
        title.addClass('active');
        price.addClass('active');
        img.addClass('active');
        $(img).parent('.swiper-slide').removeClass('not-active_sl');
        btn.addClass('active');

    });




    loadSlider();

    const recastSwiper = new Swiper('.recast__slider-container', {
        slidesPerView: 1,
        //autoHeight: true,
        freeMode: false,
        loop: false,
        navigation: {
            nextEl: ".slider-button-next_pink",
            prevEl: ".slider-button-prev_pink",
        },
    });
    
    // смена названия продукта в зависимости от выбранного объема/граммов (для торгового предложения)
    $('.volume__input').click(function() {

        let id = $(this).attr('data-tab'),
            title = $('.inactive_title[data-tab="'+ id +'"]'),
            price = $('.inactive_price[data-tab="'+ id +'"]'),
            img = $('.inactive_img[data-tab="'+ id +'"]');
            btn = $('.inactive_btn[data-tab="'+ id +'"]');

        $('#volumeFormSKU .volume__input').removeClass('input-active');
        // $('.product-page__top__value').removeClass('product-page__top__value_active');
        $('.volume-input__wrap').removeClass('volume-input__wrap_active');

        $('.volume__input.active').removeClass('active');
        $(this).addClass('active');

        $('.inactive_title.active').removeClass('active');
        title.addClass('active');

        $('.inactive_price.active').removeClass('active');
        price.addClass('active');

        $('.inactive_img.active').parent('.swiper-slide').addClass('not-active_sl');
        $(img).parent('.swiper-slide').removeClass('not-active_sl');
        $('.inactive_img.active').removeClass('active');
        img.addClass('active');


        $('.inactive_btn.active').removeClass('active');
        btn.addClass('active');

        loadSlider();
    });


    // Добавление в корзину с учетом метрики
    $(document).on(
        'click',
        '.product__btn',
        function (event) {
            event.preventDefault();
            $(this).text('В корзине');

            let productItemSKU;
            const productQuantity = Number( $('.product-page__top__count').find('.product-page__top__count__value').html() );

            // проверка на отмеченную радиокнопку
            $('#volumeFormSKU input:radio:checked').each(function(index, value){

                productItemSKU = $(this);
                return productItemSKU;
            });

            // занесение в корзину id товара в зависимости от выбранного объема(мл./g) если это торговое предложение
            if (productItemSKU !== undefined) {
                addToCart(productItemSKU.attr('id'), productQuantity, productItemSKU);

            } else {
                let productItem = $('.product__btn');
                let productId = $('.product__btn').attr('data-id');
                addToCart(productId, productQuantity, productItem);
            }
        }
    );


    // Табы внутри описания
    $('.tabs__caption li').click(function() {
        $('.tabs__caption li').removeClass('active');
        $(this).addClass('active');

        let tabTitle = $(this).data('tab');

        $('.tabs__content').each(function (index, value) {
            let tabContent = $(value);

            if( $(tabContent).data('content') ==  tabTitle ) {
                $('.tabs__content').removeClass('active');
                $(this).addClass('active');
            }
        })

        if (tabTitle == 'box') {
            loadSlider();
        }
    });


    // Смена фона у табов в способе применения
    $('.usage-way__title').click(function() {
        $(this).toggleClass( 'usage-way__title_active');
    });


    // Табы отзывов и вопросов
    $('.product-reviews__menu__item').click(function() {
        $('.product-reviews__menu__item').removeClass('product-reviews__menu__item_active');
        $(this).addClass('product-reviews__menu__item_active');

        let tabTitle = $(this).data('tab');

        $('.tabs__content-interaction').each(function (index, value) {
            let tabContent = $(value);

            if( $(tabContent).data('content-interaction') ==  tabTitle ) {
                $('.tabs__content-interaction').removeClass('active');
                $(this).addClass('active');
            }
        })
    });


    // Количество отзывов
    let reviewsQuantity = $('.reviews__quantity').val();
    $('.reviews__quantity_show').text('(' + reviewsQuantity + ')');

    // Количество вопросов
    let questionsQuantity = $('.questions__quantity').val();
    $('.questions__quantity_show').text('(' + questionsQuantity + ')');


    // START Попап "Написать отзыв"
    $(document).on("click", ".review-new__btn", function (e) {
        e.preventDefault();
        let titleContent = $('#addReviewF61').find('.modal-review__title').html(),
            title = '<div class="fly-popup__title" style="margin-right: 30px;">' + titleContent + '</div>',
            modalId = $(this).data('modal-id'),
            content = '<div class="fly-popup__text">' + $(document).find('#modalReviewWrap_' + modalId).html() + '</div>';

        showPopupF61( title + content);
    });

    // stars
    $(document).on('click', '.starcont', function () {
        $(this).parent().find('.star').removeClass('staract');

        var ind = $(this).index() + 1;
        for (var i = ind; i >= 1; i--) {
            $(this).parent().find('.starcont:nth-child(' + i + ') .star').addClass('staract');
        }

        $('.reverror').hide().text()
        var revstar = 0
        $(this).closest('.startcolcont').find('.star').each(function() {
            if ($(this).hasClass('staract')) revstar++
        })

        var datastar = $(this).closest('.startcolcont').attr('data-star');
        $('input[data-star=' + datastar + ']').val(revstar).trigger('change');

        if ($(this).closest('.stargrid').length) {
            $(this).closest('.stargrid').find('.stargrid__text .stargrid__param').hide();
            $(this)
                .closest('.stargrid')
                .find('.stargrid__text .stargrid__param:nth-child(' + revstar + ')')
                .show();
        }
    })

    // photo add
    $(document).on("click",".photo-add",function() {
        $(this).fadeToggle(100);
        $(this).next('.form__item_photo-add').fadeToggle(200);
    });

    $(document).on("click",".photo-add__fake",function() {
        $(this).parent('.photo-add__item').find('.form__input input_type-file').trigger('click');
    });

    $(document).on("change",".photo-add__item input[type=file]",function() {
        let file = this.files[0];
        $(this).parent('.photo-add__item').find('.photo-add__fake').toggleClass('photo-add__fake_added').html(file.name);
        $(this).parent('.photo-add__item').find('.photo-add__inscription').toggleClass('photo-add__inscription_added').html('Загружен');
    });

    // click on checkboxes
    $(document).on("click",".form__label_recommend",function() {
        $('.form__label_recommend').removeClass('form__label_recommend_added');
        $(this).addClass('form__label_recommend_added');
    });

    $(document).on("click",".age__item",function() {
        $('.age__item').removeClass('age__item_added');
        $(this).addClass('age__item_added');
    });

    $(document).on("click",".phone-add__string",function() {
        $('.phone-add__checkbox').toggleClass('phone-add__checkbox_checked');
        $('.phone-add__field').fadeToggle(200);
    });

    $(document).find('#phone').inputmask({"mask": "+7(999) 999-9999"});

    // validation
    $(document).on('change keyup paste', '.fly-popup input, .fly-popup textarea', function () {
        if ( $(this).parents('.fly-popup').css('display') == 'flex' ) {

            let flyPopup = $(this).parents('.fly-popup'),
                requiredFields = [];

            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[NAME][0]"]').val() ) // Your name
            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[89][0]"]').val() ) // Review title
            requiredFields.push( $(flyPopup).find('textarea[name="PROPERTY[DETAIL_TEXT][0]"]').val() ) // Your review
            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[51][0]"]').val() ) // Rate a product
            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[53]"]:checked').prop('value') ) // Recommend to a friend
            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[55][age]"]:checked').val() ) // Your age
            requiredFields.push( $(flyPopup).find('input[id="check1"]:checked').prop('value') ) // Processing agreement


            let emptyFields = false;
            $(requiredFields).each(function (index, value) {
                if (!value || value == 'undefined') {
                    emptyFields = true;
                }
            });

            if (!emptyFields) {
                $('.modal-review__btn').removeClass('disable').prop("disabled", false);
            } else {
                $('.modal-review__btn').addClass('disable').prop("disabled", true);
            }

        }
    });
    // END Попап "Написать отзыв"


    // Попап "Задать вопрос"
    $(document).on("click", ".question-new__btn", function (e) {
        e.preventDefault();
        let titleContent = $('#askQuestionF61').find('.modal-question__title').html(),
            title = '<div class="fly-popup__title" style="margin-right: 30px;">' + titleContent + '</div>',
            text = '<div class="fly-popup__text">' + $('#modalQuestionWrap').find('.modal-question__desc').html() + '</div>',
            content = $(document).find('#modalQuestionWrap').html(),
            contentTotal = '<div class="fly-popup__content popup-btn-down"><div class="fly-popup__inner">' + title + text + content + '</div><div class="mob-mb-70 smo-btn form__btn js-ask-question disable">Отправить вопрос</div></div>';

        showPopupF61( contentTotal);
    });

    // validation
    $(document).on('change keyup paste', '.fly-popup input, .fly-popup textarea', function () {
        if ( $(this).parents('.fly-popup').css('display') == 'flex' ) {

            let flyPopup = $(this).parents('.fly-popup'),
                requiredFields = [];

            requiredFields.push( $(flyPopup).find('input[name="PROPERTY[NAME][0]"]').val() ) // Your name
            requiredFields.push( $(flyPopup).find('textarea[name="PROPERTY[PREVIEW_TEXT][0]"]').val() ) // Your question
            requiredFields.push( $(flyPopup).find('input[id="check2"]:checked').prop('value') ) // Processing agreement


            let emptyFields = false;
            $(requiredFields).each(function (index, value) {
                if (!value || value == 'undefined') {
                    emptyFields = true;
                }
            });

            if (!emptyFields) {
                $('.js-ask-question').removeClass('disable').prop("disabled", false);
            } else {
                $('.js-ask-question').addClass('disable').prop("disabled", true);
            }

        }
    });
    // отправка формы с вопросом
    $(document).on('click', '.js-ask-question', function () {
        $(document).find('.btn_question').trigger('click');
    });

    // Закрыть попап
    $('.el-popup__wrapper').mouseup(function (e) {
        var div = $('.el-popup_question, .el-popup_review');
        var isFocus = false

        $('.modal__input').each(function () {
            if ($(this).is(':focus')) isFocus = true
        })
        if (!isFocus && !div.is(e.target) && div.has(e.target).length === 0) {

            $('.el-popup__wrapper').stop().fadeOut(200);

            $('.el-popup').removeClass('el-popup_show').removeAttr('style');

            setTimeout(function () {
                $('.el-popup').addClass('el-popup_hide')
            }, 10)
            setTimeout(function () {
                $('.el-popup__wrapper').hide()
                $('.modal__cont').removeClass('modalscroll')
                $('body').removeAttr('style')
            }, 200)
        }
    })

    // Слайдер - Рекомендуемые продукты RICH
    function loadRichSlider() {
        const productSwiper = new Swiper('.rich-products__swiper', {
            breakpoints: {
                320: {
                    slidesPerView: 2.1,
                    spaceBetween: 7
                },
                374: {
                    slidesPerView: 2.1,
                    spaceBetween: 9
                },
                720: {
                    slidesPerView: 3.4,
                    spaceBetween: 10
                },
                960: {
                    slidesPerView: 4,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 20
                }
            }
        });
    }


    loadRichSlider();

    $('.rich .open').on('click', function (e) {
        e.preventDefault();
        $('.rich__full').css('display','flex');
        loadRichSlider();
        if (typeof ym != 'undefined') {
            ym('76511557', 'reachGoal', 'rich_show');
        }
    });

    $('.rich__full .close').on('click', function () {
        setTimeout(function(){
            $('.rich__full').css('display','none');
        }, 2000);
        if (typeof ym != 'undefined') {
            ym('76511557', 'reachGoal', 'rich_close');
        }
    });

    // попапы с полным описанием
    $(".js-detail-text").on("click", function (e) {
        e.preventDefault();
        let title = '<div class="fly-popup__title">описание продукта</div>',
            content = '<div class="fly-popup__text">' + $(this).parent().find('.html-detail-text').html() + '</div>';
        if(typeof $(this).parent().find('.html-detail-text').html() == "undefined") {
            content = '';
        }
        showPopupF61( title + content);
    });

    $(".js-usage-detail").on("click", function (e) {
        e.preventDefault();
        let title = '<div class="fly-popup__title">применение</div>',
            content = '<div class="fly-popup__text">' + $(this).parent().find('.html-detail-text').html() + '</div>';
        showPopupF61( title + content);
    });

    $(".js-ingredients-detail").on("click", function (e) {
        e.preventDefault();
        let title = '<div class="fly-popup__title">активные ингредиенты</div>',
            content = '<div class="fly-popup__text">' + $(this).parent().find('.html-detail-text').html() + '</div>';
        showPopupF61( title + content);
    });

    $(".js-box-detail").on("click", function (e) {
        e.preventDefault();
        let title = '<div class="fly-popup__title">упаковка</div>',
            content = '<div class="fly-popup__text">' + $(this).parent().find('.html-detail-text').html() + '</div>';
        showPopupF61( title + content);
    });

    // фиксация блока добавления в корзину

    const btnCartBlock = $('.product-page__top__add-block');
    let heightToBtnCartBlock = btnCartBlock.offset().top;
    let innerHeightBtnCartBlock = btnCartBlock.innerHeight();

    // $(window).scroll(function () {
    //     if ($(this).scrollTop() + $(window).height() > heightToBtnCartBlock + innerHeightBtnCartBlock + 30) {
    //         btnCartBlock.addClass('product-page__top__add-block_active');
    //     } else {
    //         btnCartBlock.removeClass('product-page__top__add-block_active');
    //     }
    // });

    // Метрика: добавление продукта в корзину
    $(".product__btn").on("click", function () {
        if (typeof ym != 'undefined') {
            ym('76511557', 'reachGoal', 'addtocart_inside');
        }
    })

    // Метрика: просмотр КТ
    if (typeof ym != 'undefined') {
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            "ecommerce": {
                "detail": {
                    "products": [
                        {
                            "id": $('.productItem-js').attr('data-product-id'),
                            "name" : $('.productItem-js').attr('data-product-name'),
                            "brand": 'SMORODINA',
                            "category": $('.productItem-js').attr('data-product-category'),
                            "price": $('.productItem-js').find('.product__price').attr('data-product-price'),
                        }
                    ]
                }
            }
        });
    }

    if (typeof ym !== "undefined") {
        ym('76511557', 'reachGoal', 'productViewed');
    }

});






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
; /* Start:"a:4:{s:4:"full";s:114:"/local/templates/smorodinacosmetic_f61/components/bitrix/system.pagenavigation/round_pink/script.js?16896075741164";s:6:"source";s:99:"/local/templates/smorodinacosmetic_f61/components/bitrix/system.pagenavigation/round_pink/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/

    $(document).on('click', '.load_more', function(){

        var targetContainer = $('.interaction__list'),         //  Контейнер, в котором хранятся элементы
            url =  $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){

                    //  Удаляем старую навигацию
                    $(this).remove();
                    $('.load_more').remove();

                    var elements = $(data).find('.interaction__list-item'),  //  Ищем элементы
                        pagination = $(data).find('.load_more:first');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом

                }
            })
        }
    });




/* End */
;
; /* Start:"a:4:{s:4:"full";s:110:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/show-reviews_flash/script.js?16893397521784";s:6:"source";s:95:"/local/templates/smorodinacosmetic_f61/components/bitrix/news.list/show-reviews_flash/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {

    // слайдер
    const productMain2 = new Swiper('.interaction__list .interaction__photos', {
        slidesPerView: 4,
        spaceBetween: 12,
        breakpoints: {
            680: {
                slidesPerView: 5,
                spaceBetween: 14
            },
        }
    });

    // слайдер
    function loadSlider() {
        const interactionPopup = new Swiper('.interaction-popup', {
            slidesPerView: 1,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },

            navigation: {
                nextEl: ".interaction-popup .slider-button-next_pink",
                prevEl: ".interaction-popup .slider-button-prev_pink",
            },

            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
        });
    }


    $('.interaction__recommend-like').on('click', function () {
        let currentSum = $(this).children('.like__sum').text();
        newSum = Number(currentSum) + 1;
        $(this).children('.like__sum').text(newSum);

       // $(this).append('<img style="margin-right:5px;" src="/local/templates/smorodinacosmetic/svg/icons/icon-like.svg" />');
    })


    $('.interaction__photos').on('click', function () {
        $(this).next('.interaction-popup__wrapper').fadeIn();
        loadSlider();
    })

    // Закрытие
    $('.interaction-popup__close').on('click', function () {
        $('.interaction-popup__wrapper').fadeOut();
    })

    $(document).on('mouseup', function(e){
        const popup = $('.interaction-popup');
        if (!popup.is(e.target) && popup.has(e.target).length === 0) {
            $('.interaction-popup__wrapper').fadeOut();
        }
    });

});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:107:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/f61_buy-with-it/script.js?168929311927";s:6:"source";s:94:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/f61_buy-with-it/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {


});
/* End */
;; /* /local/templates/smorodinacosmetic_f61/components/bitrix/catalog/catalog_flash_spf_1/bitrix/catalog.element/element_review/script.js?172966704819976*/
; /* /local/templates/smorodinacosmetic_f61/lib/lazyload/lazyload.js?16890515213721*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/system.pagenavigation/round_pink/script.js?16896075741164*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/news.list/show-reviews_flash/script.js?16893397521784*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/f61_buy-with-it/script.js?168929311927*/
