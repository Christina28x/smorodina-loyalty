@extends('layouts.app')
@section('title', 'Серии')
@section('content')
<main class="">


<section class="catalog-section">
    <div class="catalog-section__head" style="background-image: url('{{ asset('img/bg.png') }}')">
        <div class="container-xxl h-100 d-flex flex-column justify-content-end justify-content-lg-between">
            <div class="head-breadcrumbs d-none d-lg-flex flex-wrap">
                <a href="/">Главная страница</a>
                <span>/</span>
                <a href="/catalog/">Каталог</a>
            </div>
            <h1>уход для лица</h1>
        </div>
    </div>
            <div class="container-xxl">
            <div class="series-list mt-6">
                <div class="row g-4">
                                            <div class="col-6">
                            <a href="/sets/microbiome/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Microbiome.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #7A74CA"></div>
                                <div class="series-list__item__title stretched-link_">microbiome</div>
                                <div class="series-list__item__desc mt-2">Действие серии microbiome направлено на восстановление микробного баланса кожи, благодаря которому лицо приобретает здоровый внешний вид и сияние.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/smart-lifting/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Smart-lifting.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #FF79BA"></div>
                                <div class="series-list__item__title stretched-link_">smart-lifting</div>
                                <div class="series-list__item__desc mt-2">В основе формул серии smart-lifting активы, которые доказано влияют на уменьшение глубины мимических морщин и обеспечивают выраженное подтягивающее действие.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/smart%20anti-acne/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Smart-anti-acne.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #909A1F"></div>
                                <div class="series-list__item__title stretched-link_">smart anti-acne</div>
                                <div class="series-list__item__desc mt-2">Серия smart anti-acne создана для всех, кого затронули подростковые высыпания и не покинули во взрослом возрасте. Активы серии направлены на уменьшение воспалений, сужение пор, выравнивание тона кожи и уменьшения жирного блеска. </div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/smart-age/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Smart-age.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #FF935B"></div>
                                <div class="series-list__item__title stretched-link_">smart-age</div>
                                <div class="series-list__item__desc mt-2">Серия smart-age разработана для эффективного омоложения, свежести&nbsp;и&nbsp;сияния&nbsp;кожи.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/hydration/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Hydration.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #5BA8EF"></div>
                                <div class="series-list__item__title stretched-link_">hydration</div>
                                <div class="series-list__item__desc mt-2">Увлажняющая серия устраняет последствия нарушения гидролипидного баланса: сухость, шелушение, обезвоженность, раздражительность и ощущение стянутости.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/sensitive/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/Sensitive-skin.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #C685D2"></div>
                                <div class="series-list__item__title stretched-link_">sensitive </div>
                                <div class="series-list__item__desc mt-2">Серия защищает и смягчает чувствительную кожу, уменьшая раздражения, покраснения и сухость, укрепляя барьер и возвращая коже комфорт и здоровое сияние.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                            <div class="col-6">
                            <a href="/sets/spf/" class="series-list__item series-list__item_type-1 d-flex flex-column align-items-center
                            justify-content-end justify-content-md-center p-4 p-md-6" style="background-image: url('{{ asset('img/SPF.jpg') }}')">
                                <div class="series-list__item-bg" style="background-color: #2E98AF"></div>
                                <div class="series-list__item__title stretched-link_">spf</div>
                                <div class="series-list__item__desc mt-2">Линейка прозрачных солнцезащитных средств с физическими УФ-фильтрами для защиты кожи от неблагоприятного UVA/UVB-излучении и предотвращения ее преждевременного старения.</div>
                                <div class="series-list__item__more mt-6 smo-btn smo-btn_white">Подробнее</div>
                            </a>
                        </div>
                                    </div>
            </div>
        </div>
    </section>






</main>
@endsection