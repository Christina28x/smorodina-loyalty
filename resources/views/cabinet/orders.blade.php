@extends('layouts.app')
@section('title', 'Мои заказы')
@section('content')

<main class="">

    <section class="cabinet">
        <div class="cabinet__head mb-4 mb-lg-6">
            <figure class="cabinet__cover desktop">
                <img class="cabinet__cover-img" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/cabinet/banner/WebWide2.png" />
            </figure>
            <figure class="cabinet__cover mob">
                <img class="cabinet__cover-img" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/cabinet/banner/Web1.png" />
            </figure>
            <div class="container-xxl h-100 d-flex flex-column justify-content-end align-items-center">
                <h1 class="text-lowercase">мои заказы</h1>
            </div>
        </div>

        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-3">
                    <div class="cabinet__menu">
                        <div class="cabinet__menu-list">
                            <div class="cabinet__menu-item cabinet__menu-item_active">
                                <a class="cabinet__menu-link" href="/cabinet/"><span class="cabinet__menu-title">Мои заказы ({{ $orderCount ?? 0}})</span></a>
                            </div>
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=favorites"><span class="cabinet__menu-title">Избранное</span></a>
                            </div>
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=account"><span class="cabinet__menu-title">Данные аккаунта</span></a>
                            </div>
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=loyalty"><span class="cabinet__menu-title">Программа лояльности</span></a>
                            </div>
                            @if(Auth::user()?->is_admin)
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="{{ route('admin.loyalty') }}">
                                    <span class="cabinet__menu-title">Управление программой лояльности</span>
                                </a>
                            </div>
                            @endif
                            <div class="cabinet__menu-item cabinet__menu-logout">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="cabinet__menu-title" style="background:none;border:none; color: var(--colorBlack_o30);">Выход</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<div class="col-lg-9">
    <div class="cabinet__orders js-load-more-container">
        @forelse ($orders as $order)
            <div class="cabinet__order p-4 mb-4 js-load-more-item">
                <div class="cabinet-order__inner">
                    <div class="cabinet__order-base align-items-center">
                        <div class="cabinet-order__item cabinet__order-number">№{{ $order->id }}</div>

                        <div class="cabinet-order__item cabinet__order-products desktop d-flex align-items-center">
                            @foreach ($order->items as $item)
                                <div class="cabinet__order-product me-1"
                                     style="background-image: url('{{ asset($item->product->image) }}')">
                                </div>
                            @endforeach
                        </div>

                        <div class="cabinet-order__item cabinet__order-date">От {{ $order->created_at->format('d.m.Y') }}</div>

                        <div class="cabinet-order__item cabinet__order-status">
                            <span class="status status_finished">Оплачено</span>
                        </div>

                        <div class="cabinet-order__item cabinet__order-price">
                            {{ number_format($order->final_price, 0, ',', ' ') }} ₽
                        </div>

                        <div class="cabinet-order__item cabinet__order-more"></div>
                    </div>

                    <div class="cabinet-order__item cabinet__order-products mobile d-flex align-items-center">
                        @foreach ($order->items as $item)
                            <div class="cabinet__order-product me-1"
                                 style="background-image: url('{{ asset($item->product->image) }}')"
                                 data-product-id="{{ $item->product_id }}" data-quantity="{{ $item->quantity }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="cabinet__order-detail" style="display: none;">
                    <div class="cabinet__order-detail-cols d-flex">
                        <div class="cabinet__order-detail-col">
                            <div class="cabinet__order-detail-title-block mb-4">
                                <div class="cabinet__order-detail-title">Начисление бонусов:</div>
                                <div class="cabinet__order-detail-desc">
                                    {{ $order->bonus_earned ?? 0 }} баллов
                                </div>
                            </div>
                            <div class="cabinet__order-detail-title-block mb-4">
                                <div class="cabinet__order-detail-title">Списание бонусов:</div>
                                <div class="cabinet__order-detail-desc">
                                    {{ $order->bonus_used ?? 0 }} баллов
                                </div>
                            </div>
                        </div>

                        <div class="cabinet__order-detail-col">
                            <div class="cabinet__order-detail-title-block mb-4">
                                <div class="cabinet__order-detail-title">Адрес доставки:</div>
                                <div class="cabinet__order-detail-desc">{{ $order->address }}</div>
                            </div>

                            <div class="cabinet__order-detail-title-block mb-4">
                                <div class="cabinet__order-detail-title">Способ доставки:</div>
                                <div class="cabinet__order-detail-desc">
                                    {{ $order->delivery_method === 'pickup' ? 'До ПВЗ СДЭК / Яндекс' : 'Курьером до квартиры' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cabinet__order-detail-title mb-2">Товары:</div>
                    <div class="row">
                        @foreach ($order->items as $item)
                            <div class="col-lg-4">
                                <div class="cabinet__order-detail-product mb-4 d-flex">
                                    <a class="cabinet__order-detail-product-photo"
                                       href="{{ route('products.show', [$item->product->category, $item->product->subcategory, $item->product->slug]) }}"
                                       style="background-image: url('{{ asset($item->product->image) }}')">
                                    </a>

                                    <div class="cabinet__order-detail-product-text">
                                        <a class="cabinet__order-detail-product-name"
                                           href="{{ route('products.show', [$item->product->category, $item->product->subcategory, $item->product->slug]) }}">
                                            {{ $item->product->name }}
                                        </a>
                                        <div class="cabinet__order-detail-product-price">
                                            <span class="current">
                                                {{ number_format($item->price_at_purchase, 0, ',', ' ') }} ₽
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="calculations">
                        <div class="calculations__item">
                            <div class="calculations__item-block">
                                <div class="cabinet__order-detail-desc">Промежуточный итог:</div>
                                <div class="calculations__item-note">{{ $order->total_quantity }} товара</div>
                            </div>
                            <div class="calculations__val">{{ number_format($order->price, 0, ',', ' ') }} ₽</div>
                        </div>
                        <div class="calculations__item">
                            <div class="cabinet__order-detail-desc">Общая скидка:</div>
                            <div class="calculations__val">{{ number_format($order->price - $order->final_price, 0, ',', ' ') }} ₽</div>
                        </div>
                        <div class="calculations__item">
                            <div class="cabinet__order-detail-desc">Итого:</div>
                            <div class="calculations__val">{{ number_format($order->final_price, 0, ',', ' ') }} ₽</div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>У вас пока нет заказов.</p>
        @endforelse
    </div>
</div>

            </div>
        </div>

    </section>

</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cabinet__order-more').forEach(btn => {
        btn.addEventListener('click', function () {
            const order = this.closest('.cabinet__order');
            const detail = order.querySelector('.cabinet__order-detail');
            const isActive = this.classList.contains('cabinet__order-more_active');

            this.classList.toggle('cabinet__order-more_active', !isActive);
            detail.style.display = isActive ? 'none' : 'block';
        });
    });
});
</script>
