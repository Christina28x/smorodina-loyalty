@extends('layouts.app')
@section('title', 'Избранное')
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
                <h1 class="text-lowercase">избранное</h1>
            </div>
        </div>

        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-3">
                    <div class="cabinet__menu">
                        <div class="cabinet__menu-list">
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/"><span class="cabinet__menu-title">Мои заказы ({{ $orderCount ?? 0}})</span></a>
                            </div>
                            <div class="cabinet__menu-item cabinet__menu-item_active">
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
                    <div class="row gx-4 gy-7 mb-7 mb-lg-9">
                        @if ($favorites->isEmpty())
        <p id="no-favorites-msg" style="display: none;">У вас пока нет избранных товаров.</p>
    @else
                    @foreach ($favorites as $product)
                        <div class="col-6 col-md-4 col-lg-3" id="product-wrap-{{ $product->id }}">
                            <article class="product-card ssss_{{ $loop->index }} item" id="product-{{ $product->id }}" data-id="{{ $product->id }}">
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
                    @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.product-card__favorite').forEach(favIcon => {
        favIcon.addEventListener('click', function () {
            const icon = this;
            const productId = icon.dataset.productId;

            fetch('/favorite/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'removed') {
                    // Удаляем визуально
                    icon.classList.remove('product-card__favorite_active');

                    const wrapper = document.getElementById(`product-wrap-${productId}`);
                    if (wrapper) {
                        wrapper.style.transition = 'opacity 0.3s ease';
                        wrapper.style.opacity = '0';

                        setTimeout(() => {
                            wrapper.remove();

                            // Проверка на пустой список
                            const remaining = document.querySelectorAll('.product-card__favorite_active').length;
                            if (remaining === 0) {
                                const emptyMsg = document.getElementById('no-favorites-msg');
                                if (emptyMsg) emptyMsg.style.display = 'block';
                            }
                        }, 300);
                    }
                } else if (data.status === 'added') {
                    icon.classList.add('product-card__favorite_active');
                }
            })
            .catch(() => alert('Ошибка при обновлении избранного'));
        });
    });
});

</script>





@endsection
