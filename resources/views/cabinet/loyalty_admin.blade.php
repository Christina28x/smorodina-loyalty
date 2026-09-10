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
                    <h3 class="account-data__block-title mb-4" style="font-size: 22px;">Прогноз спроса по товару</h3>
    <div class="mb-3">
        <label>Выберите категорию:</label>
        <select id="categorySelect" class="form-control">
            <option value="">-- Выберите --</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->rus_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Выберите товар:</label>
        <select id="productSelect" class="form-control" disabled>
            <option value="">-- Сначала выберите категорию --</option>
        </select>
    </div>

    <div class="chart-section line-section" id="forecastWrapper" style="display:none;">
        <h3 class="account-data__block-title mb-4" id="productTitle" style="font-size: 18px;">Прогноз спроса по товару</h3>
        <div class="line-wrapper">
        <canvas id="forecastChart"></canvas>
        </div>
    </div>
                        <div class="chart-section pie-section">
        <h3 class="chart-title">Распределение скидок по категориям</h3>
        <div class="pie-wrapper">
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

    <div class="chart-section pie-section">
        <h3 class="chart-title">Распределение пользователей по уровням лояльности</h3>
        <div class="pie-wrapper">
            <canvas id="levelChart"></canvas>
        </div>
    </div>
    <div class="chart-section pie-section">
        <h3 class="chart-title">Использование бонусов при заказах</h3>
        <div class="pie-wrapper">
            <canvas id="bonusChart"></canvas>
        </div>
    </div>




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
                    color: '#000',
                    font: {
                        weight: 'bold',
                        size: 13
                    },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        const label = context.chart.data.labels[context.dataIndex];
                        return percentage >= 15 ? `${label}\n${percentage}%` : percentage + '%';
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
                    color: '#000',
                    font: {
                        weight: 'bold',
                        size: 13
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
                    color: '#000',
                    font: {
                        weight: 'bold',
                        size: 13
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
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('categorySelect');
        const productSelect = document.getElementById('productSelect');
        const wrapper = document.getElementById('forecastWrapper');
        const productTitle = document.getElementById('productTitle');
        let chartInstance;

        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;
            productSelect.innerHTML = '<option value="">Загрузка...</option>';
            productSelect.disabled = true;

            fetch(`/cabinet/loyalty-admin/products?category_id=${categoryId}`)
                .then(res => res.json())
                .then(products => {
                    productSelect.innerHTML = '<option value="">-- Выберите --</option>';
                    products.forEach(p => {
                        productSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                    });
                    productSelect.disabled = false;
                });
        });

        productSelect.addEventListener('change', function () {
            const productId = this.value;
            if (!productId) return;

            fetch(`/cabinet/loyalty-admin/data?product_id=${productId}`)
                .then(res => res.json())
                .then(data => {
                    productTitle.textContent = `Прогноз спроса: ${data.product_name}`;
                    wrapper.style.display = 'block';

                    const ctx = document.getElementById('forecastChart').getContext('2d');

                    if (chartInstance) chartInstance.destroy();

                                        chartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Фактический спрос',
                                    data: data.real_data,
                                    borderColor: '#4CAF50',
                                    backgroundColor: '#4CAF50',
                                    fill: false,
                                    tension: 0.3
                                },
                                {
                                    label: 'Прогноз спроса',
                                    data: [null, ...data.data],
                                    borderColor: '#36A2EB',
                                    backgroundColor: '#36A2EB',
                                    borderDash: [5, 5],
                                    fill: false,
                                    tension: 0.3
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
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
                });
        });
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

    /* 🎯 Pie chart стили */
    .pie-wrapper {
        max-width: 520px;
        margin: 0 auto;
        position: relative;
    }

    .pie-wrapper canvas {
        width: 100% !important;
        height: auto !important;
        aspect-ratio: 1 / 1;
    }

    /* 📈 Line chart стили */
    .line-wrapper {
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        background-color: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .line-wrapper canvas {
        width: 100% !important;
        height: 400px !important;
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