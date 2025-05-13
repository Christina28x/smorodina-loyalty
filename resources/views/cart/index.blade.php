@extends('layouts.app')

@section('content')
<main class="">
    <section class="cart pink f61-temp-page">
        <div class="wrapper">
            <h1 class="h1_pink">Моя корзина</h1>

            @if (count($products) > 0)
                <div class="cart__inner">
                    <h2 class="cart__block-title">
                        Заказ на сумму 
                        <span class="cart__total-price" data-all-sum="{{ $products->sum(fn($p) => $p->price * $p->quantity) }}">
                            {{ number_format($products->sum(fn($p) => $p->price * $p->quantity), 0, ',', ' ') }} ₽
                        </span>
                    </h2>

                    <p class="cart__block-desc">
                        Срок сборки заказов до 2-х рабочих дней! Доставка до ПВЗ и Постамата СДЭК и Яндекс бесплатная от 3500 ₽, кроме дальних городов*
                    </p>

                    <div class="cart__free-delivery_mobile">
                        <div class="cart__free-delivery_general">Бесплатная доставка от 3000 ₽</div>
                    </div>

                    <div class="cart__content">
                        <div class="cart__items">
                            @foreach ($products as $product)
                                <article class="cart__article item-cart" data-id="{{ $product->id }}" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}">
                                    <div class="item-cart__inner">
                                        <div class="item-cart__pic">
                                            <a class="item-cart__photo-link" href="{{ route('products.show', [$product->category, $product->subcategory, $product->slug]) }}"></a>
                                            <img class="item-cart__photo" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                        </div>

                                        <div class="item-cart__content">
                                            <div class="item-cart__header">
                                                <div class="item-cart__sum">
                                                    <div class="item-cart__price" data-sum-discount-price="0">
                                                        <span class="item-cart__price_old" style="display: none"></span>
                                                        <span class="item-cart__price_current">
                                                            {{ number_format($product->price * $product->quantity, 0, ',', ' ') }} ₽
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="item-cart__title-link-wrap">
                                                    <a class="item-cart__title-link" href="{{ route('products.show', [$product->category, $product->subcategory, $product->slug]) }}">
                                                        <span class="item-cart__title">{{ $product->name }}</span>
                                                    </a>
                                                </div>

                                                <div class="item-cart__values">
                                                    <div class="amount">
                                                        <span class="amount__title">Кол-во: </span>
                                                        <div class="amount__input-wrapper">
                                                            <div class="amount__input-buffer"></div>
                                                            <input class="amount__value" type="number" value="{{ $product->quantity }}" readonly min="1" max="999"></input>
                                                        </div>
                                                    </div>

                                                    @if($product->volume)
                                                        <div class="value">
                                                            <span class="value__title">Объем: </span>
                                                            <span class="value__weigh">{{ $product->volume }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="item-cart__count-operators">
                                                <div class="item-cart__operator" data-operator="minus">-</div>
                                                <input class="item-cart__number" type="text" value="{{ $product->quantity }}" readonly>
                                                <div class="item-cart__operator" data-operator="plus">+</div>
                                            </div>
                                        </div>

                                        <div class="item-cart__delete"
                                             data-product-id="{{ $product->id }}"
                                             data-product-price="{{ $product->price }}"
                                             data-product-name="{{ $product->name }}"
                                             data-product-category="{{ $product->category }}">
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                                                    <div class="promocode">
                            <div class="promocode__wrap">
                                <input type="text" name="coupon" class="promocode__input" placeholder="Введите промокод или сертификат">
                                <div class="promocode__check">Применить</div>
                            </div>
                        </div>


                        </div>

                    <div class="cart__footer cart-footer">
                        <a class="cart__total-btn cart__total-btn_desctop btn" href="/purchase/">Перейти к оформлению заказа</a>
                        <a class="cart__total-btn cart__total-btn_mobile" href="/purchase/">Перейти к оформлению заказа</a>
                    </div>
                    </div>

                </div>
            @else
                <section class="cart__empty-inner">
                    <div class="cart__empty empty-cart">
                        <div class="empty-cart__content">
                            <img class="empty-cart__img lazyload" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/svg/empty-cart.svg" alt="empty">
                            <h2 class="cart__block-title">В корзине ничего нет</h2>
                            <p class="cart__block-desc">Добавьте в нее товары<br> из каталога и рекомендаций</p>
                            <a class="empty-cart__btn btn" href="/catalog/">Перейти в каталог</a>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </section>
</main>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateCartSummary() {
        let total = 0;
        let totalCount = 0;

        document.querySelectorAll('.item-cart').forEach(item => {
            const price = parseInt(item.dataset.price || '0');
            const quantity = parseInt(item.querySelector('.item-cart__number').value);

            total += price * quantity;
            totalCount += quantity;

            // Обновить цену
            const priceEl = item.querySelector('.item-cart__price_current');
            if (priceEl) {
                priceEl.textContent = (price * quantity).toLocaleString('ru-RU') + ' ₽';
            }

            // Обновить input с количеством
            const amountVal = item.querySelector('.amount__value');
            if (amountVal) amountVal.value = quantity;
        });

        const totalBlock = document.querySelector('.cart__total-price');
        if (totalBlock) {
            totalBlock.textContent = total.toLocaleString('ru-RU') + ' ₽';
            totalBlock.setAttribute('data-all-sum', total);
        }

        const iconCount = document.querySelector('.count_cart');
        if (iconCount) {
            if (totalCount > 0) {
                iconCount.textContent = totalCount;
                iconCount.style.display = 'inline';
            } else {
                iconCount.style.display = 'none';
            }
        }
    }

    // Удаление товара
    document.querySelectorAll('.item-cart__delete').forEach(delBtn => {
        delBtn.addEventListener('click', () => {
            const productId = delBtn.dataset.productId;
            const item = delBtn.closest('.item-cart');

            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: productId })
            }).then(res => res.json())
              .then(data => {
                  item.remove();
                  updateCartSummary();

                  // если пусто
                  if (document.querySelectorAll('.item-cart').length === 0) {
                      document.querySelector('.cart__inner').remove();
                      document.querySelector('.cart').insertAdjacentHTML('beforeend', `
                          <section class="cart__empty-inner">
                              <div class="cart__empty empty-cart">
                                  <div class="empty-cart__content">
                                      <img class="empty-cart__img" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/svg/empty-cart.svg" alt="empty">
                                      <h2 class="cart__block-title">В корзине ничего нет</h2>
                                      <p class="cart__block-desc">Добавьте в нее товары<br> из каталога и рекомендаций</p>
                                      <a class="empty-cart__btn btn" href="/catalog/">Перейти в каталог</a>
                                  </div>
                              </div>
                          </section>
                      `);
                  }
              });
        });
    });

    // +/- кнопки
    document.querySelectorAll('.item-cart__operator').forEach(opBtn => {
        opBtn.addEventListener('click', () => {
            const item = opBtn.closest('.item-cart');
            const input = item.querySelector('.item-cart__number');
            const productId = item.dataset.productId;
            let quantity = parseInt(input.value);

            if (opBtn.dataset.operator === 'plus') quantity++;
            if (opBtn.dataset.operator === 'minus' && quantity > 1) quantity--;

            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: productId, quantity })
            }).then(res => res.json())
              .then(data => {
                  input.value = quantity;
                  updateCartSummary();
              });
        });
    });

    updateCartSummary();
});
</script>


