@extends('layouts.app')
@section('title', 'Управление программой лояльности')
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
                <h1 class="text-lowercase">Управление программой лояльности</h1>
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
                            <div class="cabinet__menu-item">
                                <a class="cabinet__menu-link" href="/cabinet/?view=loyalty"><span class="cabinet__menu-title">Программа лояльности</span></a>
                            </div>
                            @if(Auth::user()?->is_admin)
                            <div class="cabinet__menu-item cabinet__menu-item_active">
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
    <h3 class="account-data__block-title mb-3">Редактирование уровней лояльности</h3>

    <form method="POST" action="{{ route('admin.loyalty.update') }}">
        @csrf
        @foreach ($levels as $level)
            <div class="mb-4 p-3" style="border: 1px solid #eee; border-radius: 8px;">
                <h5 class="mb-3">{{ $level->level_name }} (ID: {{ $level->id }})</h5>
                
                <div class="form__item mb-2">
                    <label class="form__label">Название</label>
                    <input type="text" name="levels[{{ $level->id }}][level_name]" class="form__input" value="{{ $level->level_name }}">
                </div>

                <div class="form__item mb-2">
                    <label class="form__label">Минимальные затраты</label>
                    <input type="number" name="levels[{{ $level->id }}][min_spending]" class="form__input" value="{{ $level->min_spending }}">
                </div>

                <div class="form__item mb-2">
                    <label class="form__label">Процент бонусов</label>
                    <input type="number" name="levels[{{ $level->id }}][bonus_percent]" class="form__input" value="{{ $level->bonus_percent }}">
                </div>
            </div>
        @endforeach
        <hr>
                <h4>Глобальные функции</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="recommendations_enabled" id="rec" {{ $settings->recommendations_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="rec">Показывать рекомендации</label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="discount_choice_enabled" id="discount" {{ $settings->discount_choice_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="discount">Разрешить выбор скидки</label>
                </div>

        <button class="btn" style="background-color: #FFEBF0; color: #D70060;">Сохранить изменения</button>
    </form>
</div>



                </div>
            </div>
        </div>

    </section>

</main>

@endsection