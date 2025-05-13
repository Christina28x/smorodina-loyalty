
 /* Start:"a:4:{s:4:"full";s:126:"/local/templates/smorodinacosmetic_f61/components/bitrix/sale.basket.basket/sale-basket_main_gift_v2/script.js?173711780421102";s:6:"source";s:110:"/local/templates/smorodinacosmetic_f61/components/bitrix/sale.basket.basket/sale-basket_main_gift_v2/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {
    //let gifts = ['2636', '2637', '2638', '2639', '2640'];
    $.ajax({
        'url': '/local/templates/smorodinacosmetic_f61/components/bitrix/sale.basket.basket/ajax.php',
        method: 'POST',
        data: {
            //basket:  basket,
            basketAction: 'recalculateAjax',
            via_ajax: 'Y',
            site_id: 's1',
            site_template_id: 'smorodinacosmetic_f61'
        },
        dataType: 'json',
        success: function (data) {
            //refreshBascket(data);

            let giftQuantity = [];
            $.each( data.BASKET_DATA.GRID.ROWS, function( key, value ) {
                let id = value['PRODUCT_ID'];
                if (id == '2913') {
                    // только в 1-ом количестве
                     if (value['QUANTITY'] > 1) {
                         let basketQuantity = {};
                         basketQuantity['QUANTITY_' + parseInt(value['ID'])] = 1;
                         changeBascket(basketQuantity);
                     }

                    giftQuantity.push(value['ID']);
                }
            });

            // только 1 подарок
            if (giftQuantity.length > 1) {
                $.each( giftQuantity, function( key, value ) {
                    if (key !== 0) {
                        let basketId = parseInt(value),
                            basketDelete = {},
                            itemCartDelete = $(document).find('.item-cart__delete[data-product-id="' + value + '"]');

                        basketDelete['DELETE_' + basketId] = 'Y';
                        changeBascket(false, basketDelete, itemCartDelete);
                    }
                });
            }
            // если нет в корзине, то добавляем
            if ( !(Array.isArray(data.BASKET_DATA.GRID.ROWS) && data.BASKET_DATA.GRID.ROWS.length == 0) && giftQuantity.length == 0) {
                addProduct(2913);
            }


            // подарок только при покупке других товаров
            if (data.BASKET_DATA.allSum == 0) {
                $('.cart__total-btn').addClass('disabled');

                $('.cart__total-btn').on('click', function(e) {
                    e.preventDefault();
                });
            } else {
                $('.cart__total-btn').removeClass('disabled');
            }

            // подарок только при покупке других товаров от 1000 ₽
            // if ( (giftQuantity.length) && (data.BASKET_DATA.allSum < 1000) ) {
            //     $('.cart__total-btn').addClass('disabled');
            //     $('.cart__total-btn').on('click', function(e) {
            //         e.preventDefault();
            //     });
            //
            //     $('.cart-footer').find('.cart__gift-note').remove();
            //     $('.cart-footer').prepend('<div class="cart__gift-note">Подарок предоставляется при сумме заказа от&nbsp;1000&nbsp;₽</div>');
            // }


        }
    });
});



// удаление товара
$(document).on(
    'click',
    '.item-cart__delete',
    function () {
        var basketId = parseInt($(this).parents(".item-cart").data("id")),
            basketDelete = {},
            itemCartDelete = $(this);

        basketDelete['DELETE_' + basketId] = 'Y';

        changeBascket(false, basketDelete, itemCartDelete);
    }
);

// счетчик
$(document).on(
    'click',
    '.item-cart__operator',
    function () {
        var count = parseInt($(this).siblings("input").val()),
            quantity = "plus" === $(this).attr("data-operator") ? quantity = ++count : quantity = --count,
            basketQuantity = {};

        basketQuantity['QUANTITY_' + parseInt($(this).parents(".item-cart").attr("data-id"))] = quantity;

        changeBascket(basketQuantity);
    }
);

// автоматическое изменение ширины инпута при вводе количества товара
$(document).on(
    'input',
    '.amount__value',
    function () {
        $('.amount__input-buffer').text($input.val());
        $(this).width($('.amount__input-buffer').width());
    }
);

// ограничение на ввод кол-ва товара
$(document).on(
    'change',
    '.amount__value, .item-cart__number',
    function () {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }

        const count = parseInt($(this).val()),
            basketQuantity = {};

        basketQuantity['QUANTITY_' + parseInt($(this).parents(".item-cart").attr("data-id"))] = count;

        changeBascket(basketQuantity);
    }
);

// выбор количества товара из выпадающего списка
$(document).on(
    'click',
    '.amount-choises__arrow, .amount-choises__close',
    function () {
        $(this).parents('#amountChoises').find('.amount-choise__wrapper').fadeToggle();
        $(this).parents('#amountChoises').find('.amount-choise__select').slideToggle();
        $(this).parents('#amountChoises').find('.amount-choises__arrow').toggleClass('amount-choises__arrow_rotate');
    }
);

// закрыть при клике вне области выбора
$(document).mouseup(function (e) {
    let div = $('.amount-choise__select');
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        $(div).slideUp();

        $('.amount-choise__wrapper').fadeOut();
        $('.amount-choises__arrow').removeClass('amount-choises__arrow_rotate');
    }
})

$(document).on(
    'click',
    '.amount-choise__value',
    function () {
        $('.amount-choise__value').removeClass('amount-choise__selected');
        $(this).addClass('amount-choise__selected');
    }
);

// фиксированная кнопка покупки
// $(window).scroll(function() {
//     if ($(window).width() < 681) {
//         if ( $(document).height() - window.innerHeight < 1580 + $(window).scrollTop()) {
//             $('.cart__total-btn_mobile').fadeOut("fast");
//         } else {
//             $('.cart__total-btn_mobile').fadeIn("fast");
//         }
//     }
// });

$(document).on(
    'click',
    '.amount-choises__choose',
    function () {
        var count = parseInt($(this).parents('#amountChoises').find('.amount-choise__selected').text()),
            basketQuantity = {};

        basketQuantity['QUANTITY_' + parseInt($(this).parents(".item-cart").attr("data-id"))] = count;
        changeBascket(basketQuantity);
        $('.amount-choise__select').slideUp();
        $('.amount-choise__wrapper').fadeOut();
        $('.amount-choises__arrow').removeClass('amount-choises__arrow_rotate');
    }
);


// метрика
$(document).on(
    'click',
    '.cart__total-btn',
    function () {
        if (typeof ym != 'undefined') {
            ym('76511557', 'reachGoal', 'goto_checkout');
        }
        if (typeof fbq == 'function') {
            fbq('track', 'InitiateCheckout');
        }
    }
);

function addProduct(productId) {

    let id = productId, // /catalog/body/sugar-and-salt/skrab-chernaya-smorodina/
        quantity = 1;

    $.ajax(parent.location.pathname, {
        method: 'POST',
        dataType: 'json',
        data: {
            action: 'ADD2BASKET',
            id: id,
            ajax_basket: 'Y',
            quantity: quantity,
            prop: [],
        },
        success: function (data) {
            if (data.STATUS === 'OK') {
                headerCartUpdate();
                location.reload();
            }
        },
    });

    let basketQuantity = {};
    basketQuantity['QUANTITY_' + parseInt(id)] = 1;
    changeBascket(basketQuantity);
}

// промокод
$(document).on(
    'click',
    '.promocode__check',
    function () {
        if ( $('input[name="coupon"]').val() != '' ) {
            $('input[name="coupon"]').prop( "disabled", false );


            // if ( ($('input[name="coupon"]').val() == 'ZVEREVA') || ($('input[name="coupon"]').val() == 'zvereva') || ($('input[name="coupon"]').val() == 'ЗВЕРЕВА') || ($('input[name="coupon"]').val() == 'зверева')) {
            //     let couponProductId = 2429;
            //     let couponProductInCart = $(document).find('[data-product-id="' + couponProductId + '"]');
            //     if ( couponProductInCart.length == 0) {
            //         addProductAfterPromocodeEntered(couponProductId);
            //     }
            // }

            $.ajax({
                url: '/ajax/coupon.php',
                dataType: 'JSON',
                method: 'post',
                data: {
                    COUPON: $('input[name="coupon"]').val(),
                },
                success: function (data) {
                    if (data.success === true) {
                        $('input[name="coupon"]').val("Скидка действует").prop( "disabled", true );
                        $('.promocode__check').addClass('promocode__check_applied').html('Отменить');
                        showBasket(data.coupon.coupon);
                        // $('.fc-coupon-desc').hide();

                        let allSum = $(document).find('.cart__total-price').data('all-sum'),
                            titleContent = 'сертификат введен',
                            title = '<div class="fly-popup__title" style="margin-right: 30px;">' + titleContent + '</div>',
                            content = `<div class="fly-popup__text"><div class="success">
                                <div class="mb-6 success__text">Для активации сертификата, пожалуйста, убедись, что сумма заказа равна или превышает номинал сертификата.</div>
                            </div></div>`,
                            contentTotal = '<div class="fly-popup__content popup-btn-down"><div class="fly-popup__inner">' + title + content + '</div><div class="mob-mb-70 smo-btn success__btn popupclose">Понятно</div></div>';

                        if ( (data.coupon.discount_id == 6 && allSum < 1000) || (data.coupon.discount_id == 47 && allSum < 1500) || (data.coupon.discount_id == 10 && allSum < 2000) || (data.coupon.discount_id == 107 && allSum < 2500) || (data.coupon.discount_id == 11 && allSum < 3000) || (data.coupon.discount_id == 12 && allSum < 5000) || (data.coupon.discount_id == 13 && allSum < 10000) || (data.coupon.discount_id == 14 && allSum < 20000)) {
                            showPopupF61(contentTotal);
                        } else {
                            alertPopup("СКИДКА ДЕЙСТВУЕТ");
                        }
                    }
                    else {
                        $('input[name="coupon"]').val("").prop( "disabled", false );
                        $('.promocode__check').removeClass('promocode__check_applied').html('Применить');
                        //$('.fc-coupon-desc').show().removeClass('ok').html('Промокод недействителен');
                        return false;
                    }
                },
            });

        } else {
            alertPopup("Введите промокод или сертификат");
        }
    }
);

$(document).on(
    'click',
    '.promocode__check_applied',
    function () {
        showBasket('');
    }
);


// смена активности кнопки для применения промокода +
function changePromocodeBtnAccessibility(couponListLenght) {
    if (couponListLenght > 0) {
        $('input[name="coupon"]').val("Скидка действует").prop( "disabled", true );
        $('.promocode__check').addClass('promocode__check_applied').html('Отменить')
    } else {
        $('input[name="coupon"]').val("").prop( "disabled", false );
        $('.promocode__check').removeClass('promocode__check_applied').html('Применить');
    }
}

function showBasket(coupon = false) {
    $.ajax('/bitrix/components/bitrix/sale.basket.basket/ajax.php', {
        method: 'POST',
        data: $.merge($('#cart-form').serializeArray(), [
                {
                    "name": "template",
                    "value": 'sale-basket_main_gift_v2'
                },
                {
                    "name": "coupon",
                    "value": coupon
                }
            ],
        ),
        success: function (data) {
            $('.cart__inner').html($(data).find('.cart__inner'));
        }
    });
}

function refreshBascket(data) {


    // если гелей 3, то предлагается добавить в корзину еще 1 банку, чтобы получить ее в подарок
    // let gelsQuantity = [];
    // $.each( data.BASKET_DATA.GRID.ROWS, function( key, value ) {
    //     let id = value['PRODUCT_ID'];
    //
    //     if (id == '109' || id == '114' || id == '117' || id == '121' || id == '124' || id == '156' ) {
    //         gelsQuantity.push(value['QUANTITY']);
    //     }
    // });
    //
    // let gelsSum = gelsQuantity.reduce(function(sum, elem) {
    //     return sum + elem;
    // }, 0);
    //
    // if (gelsSum >= 2) {
    //     $('.gift-to-wrap').html('<div class="gift-to">Тебе в&nbsp;подарок массажная свеча, 50&nbsp;мл! Она будет отличаться ароматом от&nbsp;выбранных.</div>');
    // } else if (gelsSum > 0 && gelsSum < 2) {
    //     $('.gift-to-wrap').html('<div class="gift-to">Добавь к&nbsp;заказу еще одну массажную свечу объемом 200&nbsp;мл и получи в подарок свечу, 50&nbsp;мл</div>');
    // } else {
    //     $('.gift-to-wrap').html('');
    //}

    
    $.each(data.BASKET_DATA.GRID.ROWS, function (id, value) {
        $('.cart__inner').find('[data-id="' + id + '"]').find("input").val(value.QUANTITY);
        $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__price_current').html(value.SUM);
        $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__price_old').html(value.SUM_FULL_PRICE);
        $('.cart__inner').find('[data-id="' + id + '"]').find('.amount__value').html(value.QUANTITY);

        if (value.DISCOUNT_PRICE_PERCENT > 0) {
            $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__badge_discount').html('-' + value.DISCOUNT_PRICE_PERCENT_FORMATED).css('display','block');
            $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__price_old').css('display','block');
        } else {
            $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__badge_discount').html('').css('display','none');
            $('.cart__inner').find('[data-id="' + id + '"]').find('.item-cart__price_old').css('display','none');
        }
    });

    // $.each(data.BASKET_DATA.FULL_DISCOUNT_LIST, function (discountKey, discount) {
    //     $.each(discount.ACTIONS.CHILDREN, function (actionKey, action) {
    //         if (action.CLASS_ID == 'ActSaleDelivery' || action.DATA.Type == 'Discount' || action.DATA.Value == 100) {
    //             $('.free_delivery_complete').html('Вам доступна бесплатная доставка!');
    //         } else {
    //         }
    //     });
    // });


    // подарок только при покупке других товаров
    if (data.BASKET_DATA.allSum == 0) {
        $('.cart__total-btn').addClass('disabled');

        $('.cart__total-btn').on('click', function(e) {
            e.preventDefault();
        });

        $('.cart__free-delivery_complete').html("Добавь в корзину товары, чтобы получить подарок");
        $('.cart__free-delivery').addClass('helperTop160');

    } else {
        $('.cart__total-btn').removeClass('disabled');
    }



    // ПОДАРКИ
    let giftQuantity = [];
    $.each( data.BASKET_DATA.GRID.ROWS, function( key, value ) {
        let id = value['PRODUCT_ID'];
        if (id == '2636' || id == '2637' || id == '2638' || id == '2639' || id == '2640' || id == '2739' || id == '2740') {
            giftQuantity.push(value['ID']);
        }
    });
    // подарок только при покупке других товаров от 1000 ₽
    if ( (giftQuantity.length) && (data.BASKET_DATA.allSum < 1000) ) {
        $('.cart__total-btn').addClass('disabled');
        $('.cart__total-btn').on('click', function(e) {
            e.preventDefault();
        });

        $('.cart-footer').find('.cart__gift-note').remove();
        $('.cart-footer').prepend('<div class="cart__gift-note">Подарок предоставляется при сумме заказа от&nbsp;1000&nbsp;₽</div>');
    }

    if ((giftQuantity.length) && (data.BASKET_DATA.allSum >= 1000) ) {
        $('.cart__total-btn').removeClass('disabled');
        $('.cart__total-btn').on('click', function(e) {
            document.location.href = $(this).attr('href');
        });
    }

    if (!giftQuantity.length) {
        $('.cart__gift-note').remove();
        $('.cart__total-btn').on('click', function(e) {
            document.location.href = $(this).attr('href');
        });
    }
    // END ПОДАРКИ




    // Тебе доступна бесл доставка
    if(data.BASKET_DATA.allSum >= 3000) {
        $('.cart__free-delivery_complete').html(BX.message("FREE_SHIPPING_AVAILABLE_FOR_U"));
        $('.cart__free-delivery').addClass('helperTop160');
    } else if (data.BASKET_DATA.allSum > 0) {
        let sum = 3000 - data.BASKET_DATA.allSum;
        $('.cart__free-delivery_complete').html(BX.message("ADD_MORE_FOR_FREE_SHIPPING_1") + sum.toLocaleString()  + BX.message("ADD_MORE_FOR_FREE_SHIPPING_2"));
        $('.cart__free-delivery').removeClass('helperTop160');
    }

    $('.cart__total-price').html(data.BASKET_DATA.allSum_FORMATED);
    $(document).find('.cart__total-price').attr('data-all-sum', data.BASKET_DATA.allSum);

    // ПРОМОКОД смена активности кнопки для применения промокода
    changePromocodeBtnAccessibility(data.BASKET_DATA.COUPON_LIST.length);
}




function changeBascket(basketAdd = false, basketDelete = false, itemCartDelete = false) {
    let item = $(itemCartDelete).parents(".item-cart"),
        basket;

    basket = basketAdd ? basketAdd : basketDelete;

    $.ajax({
        'url': '/local/templates/smorodinacosmetic_f61/components/bitrix/sale.basket.basket/ajax.php',
        method: 'POST',
        data: {
            basket:  basket,
            basketAction: 'recalculateAjax',
            via_ajax: 'Y',
            site_id: 's1',
            site_template_id: 'smorodinacosmetic_f61'
        },
        dataType: 'json',
        success: function (data) {
            refreshBascket(data);
            headerCartUpdate();

            
            if (basket == basketDelete) {

                item.fadeIn().fadeOut(200, function () {
                    $(this).remove();
                });
                // метрика - удаление товара
                if (typeof ym != "undefined") {
                    ym('76511557', 'reachGoal', 'item-cart__delete');
    
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push(
                        {
                            "ecommerce": {
                                "remove": {
                                    "products": [
                                        {
                                            'id':  itemCartDelete.data('product-id'),
                                            'name':  itemCartDelete.data('product-name'),
                                            'category': itemCartDelete.data('product-category'),
                                            'price': itemCartDelete.data('product-price'),
                                            'brand': 'SmoRodina'
                                        }
                                    ]
                                }
                            }
                        }
                    );
    
                }

            }

        }
    });
}

/* End */
;
; /* Start:"a:4:{s:4:"full";s:115:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js?168905152327";s:6:"source";s:102:"/local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {


});
/* End */
;; /* /local/templates/smorodinacosmetic_f61/components/bitrix/sale.basket.basket/sale-basket_main_gift_v2/script.js?173711780421102*/
; /* /local/templates/smorodinacosmetic_f61/components/bitrix/catalog.top/bestsellers_no-lazyload/script.js?168905152327*/
