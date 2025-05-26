@extends('layouts.app')
@section('title', 'Программа лояльности')
@section('content')

<main class="">
@php
    $settings = \App\Models\LoyaltySetting::first();
@endphp

    <section class="cabinet">
        <div class="cabinet__head mb-4 mb-lg-6">
            <figure class="cabinet__cover desktop">
                <img class="cabinet__cover-img" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/cabinet/banner/WebWide2.png" />
            </figure>
            <figure class="cabinet__cover mob">
                <img class="cabinet__cover-img" src="https://smorodinacosmetic.com/local/templates/smorodinacosmetic_f61/images/cabinet/banner/Web1.png" />
            </figure>
            <div class="container-xxl h-100 d-flex flex-column justify-content-end align-items-center">
                <h1 class="text-lowercase">программа лояльности</h1>
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
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=favorites"><span class="cabinet__menu-title">Избранное</span></a>
                            </div>
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=account"><span class="cabinet__menu-title">Данные аккаунта</span></a>
                            </div>
                            <div class="cabinet__menu-item cabinet__menu-item_active">
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
                    <div class="account-data__block p-4 mb-5">
                        <h2 class="account-data__block-title mb-4">Программа лояльности</h2>

                        {{-- Текущий уровень --}}
                        <div class="mb-4">
                            <div class="account-data__block-field-name">Текущий уровень:</div>
                            <div class="account-data__block-field-desc">
                                <span class="fw-bold" style="color: var(--colorPink);">
                                    {{ $currentLevel->level_name ?? '—' }}
                                </span>
                                — {{ $currentLevel->bonus_percent ?? 0 }}% от суммы заказа начисляется бонусами
                            </div>
                        </div>

                        {{-- Общая сумма заказов и бонусы --}}
                        <div class="mb-4">
                            <div class="account-data__block-field-name">Общая сумма заказов:</div>
                            <div class="account-data__block-field-desc">
                                {{ number_format($user->total_spent ?? 0, 0, ',', ' ') }} ₽
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="account-data__block-field-name">Текущий бонусный баланс:</div>
                            <div class="account-data__block-field-desc">
                                {{ $user->bonus_balance ?? 0 }} баллов
                            </div>
                        </div>

                        {{-- Уровни программы --}}
                        <h3 class="account-data__block-title mb-3">Уровни программы</h3>

                        <div class="loyalty-levels">
                            @foreach ($loyaltyLevels as $level)
                                <div class="loyalty-level-box mb-3 p-3" style="
                                    border: 2px solid {{ $level->id === $user->loyalty_level_id ? '#F9C9E1' : '#F3F3F3' }};
                                    background-color: {{ $level->id === $user->loyalty_level_id ? '#FFF5F9' : '#FFF' }};
                                    border-radius: 12px;">
                                    <div class="fw-bold mb-1" style="font-size: 1.1rem;">{{ $level->level_name }} — {{ $level->bonus_percent }}%</div>
                                    <div class="text-muted">{!! $level->description !!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Рекомендации по истории покупок --}}
                    @if($settings->recommendations_enabled)
                    <div class="account-data__block p-4 mb-5">
                        <h3 class="account-data__block-title mb-3">Вам может понравиться</h3>
                        <p class="text-muted mb-0">На основе ваших заказов мы подберем интересные товары.</p>
                        @if($recommended->isNotEmpty())
    <div id="cardRecommend" class="wrapper main-recommends__slides my-4 my-sm-6 swiper">
        <div class="swiper-wrapper">
            @foreach($recommended as $product)
                <div class="swiper-slide" data-filter="">
                    <article class="product-card item" data-id="{{ $product->id }}">
                        <div class="product-card__desc">
                            <a href="{{ route('products.show', [$product->category, $product->subcategory, $product->slug]) }}"
                               class="product-card__photo metrika_good_click"
                               style="background-image: url('{{ asset($product->image) }}')"></a>

                            <div class="product-card__text">
                                <div class="product-card__text__prev">{{ $product->name }}</div>
                                <div class="product-card__text__price" data-currency-symbol="₽">
                                    <span class="product-card__text__price-current"
                                          data-current-price="{{ $product->price }}">
                                          {{ number_format($product->price, 0, ',', ' ') }} &#8381;
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
                                     data-product-category="{{ $product->subcategory->rus_name ?? '' }}"
                                     data-product-price="{{ $product->price }}">
                                    <div class="product-card__btn smo-btn">
                                        <svg><use href="/local/templates/smorodinacosmetic_f61/images/sprite.svg#bag"></use></svg>
                                        <span class="product-card__btn-text">В корзину</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('products.show', [$product->category, $product->subcategory, $product->slug]) }}"
                           class="product-card__name metrika_good_click">
                           {{ $product->name }}
                           @if($product->volume)
                               <span>{{ $product->volume }}</span>
                           @endif
                        </a>

                        <div class="facial-item__price">
                            <div class="product-card__price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endif
                    </div>
                    @endif

                    {{-- Форма выбора скидки --}}
                    @if($settings->discount_choice_enabled && now()->startOfMonth()->eq(now()))
                    @if(!$hasChosenDiscounts)
                    <div id="discount-choice-form" class="account-data__block p-4 mb-5">
                        <h3 class="account-data__block-title mb-3">Персональная скидка на следующий месяц</h3>
                        <form id="discountSelectForm">
                            <div class="form__item mb-3">
                                <label class="form__label mb-3">Выберите категорию для скидки:</label>
                                <div class="row">
                                    @foreach($availableCategories as $category)
                                        <div class="col-md-4">
                                            <label class="custom-radio">
                                                <input type="radio" name="category_id" value="{{ $category->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                <span class="custom-radio__circle"></span>
                                                {{ mb_ucfirst($category->rus_name) }}

                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button class="smo-btn mt-3" type="submit">Выбрать</button>
                        </form>
                    </div>
                @endif
                @endif

                @if($currentDiscount)
    <div id="discountResult" class="account-data__block p-4 mb-5">
        <h3 class="account-data__block-title mb-3">Вы выбрали скидку!</h3>
        <p><strong>Ваш персональный промокод:</strong> {{ $currentDiscount->code }}</p>
        @php
            $category = \App\Models\Category::find($currentDiscount->target_id);
        @endphp
        @if($category)
            <p>Категория: {{ mb_ucfirst($category->rus_name) }}
</p>
        @endif
        
    </div>
    <div id="discountResult" style="display: none;" class="account-data__block p-4 mb-5"></div>
@endif
                




                    
                </div>
            </div>
        </div>

    </section>

</main>
<script>
document.getElementById('discountSelectForm')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('{{ route('loyalty.selectDiscount') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('discount-choice-form').style.display = 'none';

    const result = document.getElementById('discountResult');
    result.style.display = 'block';
    result.innerHTML = `
        <h3 class="account-data__block-title mb-3">Вы выбрали скидку!</h3>
        <p><strong>Ваш персональный промокод:</strong> ${data.code}</p>
        <p>Категория: ${data.category.rus_name}</p>
    `;
        } else {
            alert(data.error || 'Ошибка выбора');
        }
    });
});
</script>
<style>
        .custom-radio {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
        gap: 8px;
        font-size: 16px;
        padding: 20px;
    }


    .custom-radio input[type="radio"] {
        display: none;
    }

    .custom-radio__circle {
        position: relative;
        width: 18px;
        height: 18px;
        border: 2px solid #ff79ba;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
        vertical-align: middle;
        background: #fff;
    }

    input[type="radio"]:checked + .custom-radio__circle::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 8px;
        height: 8px;
        background: #ff79ba;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

</style>
@endsection