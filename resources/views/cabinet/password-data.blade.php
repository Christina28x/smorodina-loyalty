
<div id="password-success-message" style="display: none;" class="success-toast">
    ✅ Пароль успешно обновлён!
</div>
<div class="fly-popup_password" style="display: none;">
    <div class="fly-popup fly-open" id= "fly-open-password" data-modal="password" style="display: flex;">
        <div class="fly-popup__item">
            <div class="fly-popup__close popupclose"></div>
            <div class="fly-popup__cont">
                <div class="fly-popup_content">
                    <div class="fly-popup__inner">
                        <div class="fly-popup__title">пароль</div>
                        <form id="profileChangeFormPassword" class="fly-popup__form form">
                            @csrf
                            <div class="form__item">
                                <label class="form__label">Пароль</label>
                                <input class="form__input" id="editPassword" type="password" name="new_password" required placeholder="Новый пароль" />
                                <div class="password-icon"></div>
                                <div class="form__note form__error-text" id="error-password" style="color: red; font-size: 14px;"></div>
                            </div>

                            <div class="form__item">
                                <label class="form__label">Повторите пароль</label>
                                <input class="form__input" id="editPasswordConfirm" type="password" name="new_password_confirmation" required placeholder="Новый пароль ещё раз" />
                                <div class="password-icon"></div>
                                <div class="form__note form__error-text" id="error-confirm" style="color: red; font-size: 14px;"></div>
                            </div>

                            <div class="form__item">
                                <button class="smo-btn form__btn js-next-step disable" type="submit" disabled >Сохранить изменения</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .success-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4caf50;
    color: white;
    padding: 12px 18px;
    border-radius: 6px;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    font-weight: 500;
    transition: all 0.3s ease;
}

</style>