<div class="fly-popup_profile" style="display: none;">
    <div class="fly-popup fly-open" id= "fly-open-profile" data-modal="profile" style="display: flex;">
        <div class="fly-popup__item">
            <div class="fly-popup__close popupclose"></div>
            <div class="fly-popup__cont">
                <div class="fly-popup_content">
                    <div class="fly-popup__inner">
                        <div class="fly-popup__title">личные данные</div>
                        <form id="profileChangeForm" class="fly-popup__form form">
                            @csrf
                            <div class="form__item form__fio-combined">
                                <label class="form__label">Имя и фамилия</label>
                                <input class="form__input necessarily" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>

                            <div class="block__grid-3">
                                <div class="form__item">
                                    <label class="form__label">Телефон</label>
                                    <input class="form__input" type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                                </div>

                                <div class="form__item">
                                    <label class="form__label">Город</label>
                                    <input class="form__input" type="text" name="city" value="{{ old('city', Auth::user()->city) }}" required>
                                </div>

                                <div class="form__item">
                                    <label class="form__label">Дата рождения</label>
                                    <input class="form__input" type="date" name="birthday" value="{{ old('birthday', Auth::user()->birthday) }}" required>
                                </div>
                            </div>

                            <div class="form__item">
                                <button class="smo-btn form__btn js-next-step" type="submit">Сохранить изменения</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

