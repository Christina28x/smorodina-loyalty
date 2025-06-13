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
    <h3 class="account-data__block-title mb-4" style="font-size: 20px;">Редактирование уровней лояльности</h3>

    <form method="POST" action="{{ route('admin.loyalty.update') }}">
        @csrf
        @foreach ($levels as $level)
            <div class="mb-4 p-4" style="border: 2px solid var(--colorPink2); border-radius: 20px; background: #fff6fa;">
                <h5 class="mb-3" style="font-weight: 500; color: #1C1C1C;">{{ $level->level_name }} <span style="font-size: 13px; color: #A3A3A3;">(ID: {{ $level->id }})</span></h5>

                <div class="form__item">
                    <label class="form__label">Название</label>
                    <input type="text" name="levels[{{ $level->id }}][level_name]" class="form__input" value="{{ $level->level_name }}">
                </div>

                <div class="form__item">
                    <label class="form__label">Минимальные затраты</label>
                    <input type="number" name="levels[{{ $level->id }}][min_spending]" class="form__input" value="{{ $level->min_spending }}">
                </div>

                <div class="form__item">
                    <label class="form__label">Процент бонусов</label>
                    <input type="number" name="levels[{{ $level->id }}][bonus_percent]" class="form__input" value="{{ $level->bonus_percent }}">
                </div>
            </div>
        @endforeach

        <hr class="mb-4">

        <h4 class="account-data__block-title mb-3" style="font-size: 16px;">Глобальные функции</h4>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="recommendations_enabled" id="rec" {{ $settings->recommendations_enabled ? 'checked' : '' }}>
            <label class="form-check-label" for="rec">Показывать рекомендации</label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="discount_choice_enabled" id="discount" {{ $settings->discount_choice_enabled ? 'checked' : '' }}>
            <label class="form-check-label" for="discount">Разрешить выбор скидки</label>
        </div>

        <button class="btn form__btn" style="background-color: var(--colorPink2); color: white; border-radius: 30px; padding: 14px 24px; font-weight: 500;">
            Сохранить изменения
        </button>
    </form>
</div>
    <div class="chart-section">
        <h3 class="chart-title">Распределение скидок по категориям</h3>
        <div class="chart-wrapper">
            <canvas id="discountChart"></canvas>
            <div class="top-three">
                <h4>Топ-3 категорий по количеству скидок:</h4>
                <ul>
                    @foreach ($topThree as $item)
                        <li>{{ $item->target->rus_name }} — {{ $item->total }} выбока скидок</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="chart-section">
        <h3 class="chart-title">Распределение пользователей по уровням лояльности</h3>
        <div class="chart-wrapper">
            <canvas id="levelChart"></canvas>
        </div>
    </div>
    <div class="chart-section">
        <h3 class="chart-title">Использование бонусов при заказах</h3>
        <div class="chart-wrapper">
            <canvas id="bonusChart"></canvas>
        </div>
    </div>
    <div class="chart-section">
        <h3 class="chart-title">Прогноз спроса на товар «{{ $product->name }}»</h3>
        <div class="chart-wrapper">
            <canvas id="forecastChart"></canvas>
        </div>
    </div>







</div>
                </div>
            </div>
    </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    const ctx = document.getElementById('discountChart').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                data: @json($chartData),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0', '#FF9800'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        const label = context.chart.data.labels[context.dataIndex];
                        return label + '\n' + percentage + '%';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
<script>
    const levelCtx = document.getElementById('levelChart').getContext('2d');

    new Chart(levelCtx, {
        type: 'pie',
        data: {
            labels: @json($levelLabels),
            datasets: [{
                data: @json($levelData),
                backgroundColor: [
                    '#FFB6C1', '#90CAF9', '#A5D6A7', '#FFD54F'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        const label = context.chart.data.labels[context.dataIndex];
                        return label + '\n' + percentage + '%';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
<script>
    const bonusCtx = document.getElementById('bonusChart').getContext('2d');
    new Chart(bonusCtx, {
        type: 'pie',
        data: {
            labels: @json($bonusUsageLabels),
            datasets: [{
                data: @json($bonusUsageData),
                backgroundColor: ['#4CAF50', '#E0E0E0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        const label = context.chart.data.labels[context.dataIndex];
                        return `${label}\n${percentage}%`;
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
<script>
    const forecastCtx = document.getElementById('forecastChart').getContext('2d');
    new Chart(forecastCtx, {
        type: 'line',
        data: {
            labels: @json($monthLabels),
            datasets: [{
                label: 'Продажи',
                data: @json($monthData),
                fill: false,
                borderColor: '#36A2EB',
                backgroundColor: '#36A2EB',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



<style>
    .chart-section {
        margin-bottom: 48px;
    }

    .chart-title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 16px;
    }

    .chart-wrapper {
        max-width: 500px;
        margin: 0 auto;
        padding: 16px;
        position: relative;
    }

    .chart-wrapper canvas {
        width: 100% !important;
        height: auto !important;
        aspect-ratio: 1 / 1;
    }

    .top-three {
        margin-top: 24px;
        text-align: center;
        font-family: sans-serif;
    }

    .top-three h4 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .top-three ul {
        list-style: none;
        padding: 0;
        margin: 0 auto;
        display: inline-block;
        text-align: left;
    }

    .top-three li {
        margin-bottom: 6px;
    }
</style>

@endsection