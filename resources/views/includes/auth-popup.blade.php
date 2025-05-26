<div class="fly-popup_auth" style="display: none;">
    <div class="fly-popup fly-open" data-modal="login" style="display: flex;">
        <div class="fly-popup__item">
            <div class="fly-popup__close popupclose"></div>

            <div class="fly-popup__cont">
                <div class="fly-popup__content">
                    <div class="fly-popup__inner">
                        <div class="fly-popup__title">вход / регистрация</div>
                        <div class="fly-popup__text">Авторизуйся, чтобы ускорить покупку и сохранить детали заказа в личном кабинете.</div>

                        <form form id="cabinetLoginForm" class="fly-popup__form form">
                            @csrf
                            <div class="form__item">
                                <label class="form__label">Email для входа</label>
                                <input class="form__input form__input_email necessarily"
                                       required autocomplete="off" type="email"
                                       id="authEmail" name="email" maxlength="50" placeholder="Введи Email">
                            </div>

                            <div class="form__item" id="passwordField" style="display: none;">
                                <label class="form__label">Пароль</label>
                                <input class="form__input" type="password" id="authPassword" name="password" placeholder="Введи пароль">
                                
                                <div class="form__forget-note">
                                    Пользователь с данным e-mail уже зарегистрирован в системе. 
                                    В случае, если пароль забыт, можешь восстановить его здесь:
                                </div>
                                <div class="form__forget" id="forgotPassword"> Забыли пароль?</div>
                            </div>

                        </form>

                        <div class="form__error" id="authError"></div>
                    </div>

                    <div class="mob-mb-70 smo-btn form__btn js-next-step_login disable" id="authFormBtn">Вход</div>
                    <div class="smo-btn form__btn form__btn_register" style="display: none;" id="registerBtn">Регистрация</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fly-popup fly-popup_reg" id="register-popup" style="display: none;">
    <div class="fly-popup__item">
        <div class="fly-popup__close popupclose"></div>
        <div class="fly-popup__cont">
            <div class="fly-popup__content">
                <div class="fly-popup__inner">
                    <div class="fly-popup__title">регистрация</div>
                    <div class="fly-popup__text">Зарегистрируйся, чтобы ускорить покупку и сохранить детали заказа в личном кабинете.</div>

                    <form id="registerForm" class="fly-popup__form form">
                        @csrf
                        <!-- Имя и фамилия -->
                        <div class="form__item form__fio-combined">
                            <label class="form__label">Имя и фамилия</label>
                            <input class="form__input" type="text" name="name" placeholder="Имя и фамилия" required>
                        </div>

                        <!-- Город -->
                        <div class="form__item">
                            <label class="form__label">Город</label>
                            <input class="form__input" type="text" name="city" placeholder="Город" required>
                        </div>

                        <!-- Телефон -->
                        <div class="form__item">
                            <label class="form__label">Телефон</label>
                            <input class="form__input" type="text" name="phone" placeholder="+7" data-mask="+7 (999) 999-99-99" required>
                        </div>

                        <!-- Дата рождения -->
                        <div class="form__item">
                            <label class="form__label">Дата рождения</label>
                            <input class="form__input" type="date" name="birthday" max="2020-12-31" required>
                        </div>

                        <!-- Email (disabled) -->
                        <div class="form__item">
                            <label class="form__label">Email</label>
                            <input class="form__input" type="email" id="registerEmail" name="email" readonly required>
                        </div>

                        <!-- Пароль -->
                        <div class="form__item">
                            <label class="form__label">Пароль</label>
                            <input class="form__input" type="password" name="password" id="registerPassword" required placeholder="Введи пароль (не менее 6 символов)">
                        </div>

                        <!-- Подтверждение пароля -->
                        <div class="form__item">
                            <label class="form__label">Подтвердите пароль</label>
                            <input class="form__input" type="password" name="password_confirmation" id="registerPasswordConfirm" required placeholder="Пароль ещё раз">
                        </div>

                        <div class="form__item">
                            <button class="smo-btn form__btn js-next-step_reg" type="submit">Зарегистрироваться</button>
                        </div>
                    </form>

                    <div class="form__error" id="registerError"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const popup = document.querySelector('.fly-popup_auth');
    const popupClose = document.querySelector('.fly-popup__close');
    const headerCabinet = document.querySelector('.header__cabinet');
    const emailInput = document.getElementById('authEmail');
    const passwordField = document.getElementById('passwordField');
    const passwordInput = document.getElementById('authPassword');
    const errorBlock = document.getElementById('authError');
    const loginBtn = document.getElementById('authFormBtn');
    const registerBtn = document.getElementById('registerBtn');
    const form = document.getElementById('cabinetLoginForm');
    form?.addEventListener('submit', function (e) {
    e.preventDefault();
});
    // Показ попапа
    headerCabinet?.addEventListener('click', function () {
        fetch('/check-auth', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.authenticated) {
                window.location.href = '/cabinet';
            } else {
                // показать попап
                popup.style.display = 'block';
                form.reset();
                passwordField.style.display = 'none';
                errorBlock.textContent = '';
                emailInput.classList.remove('input-error', 'input-success');
                passwordInput.value = '';
                loginBtn.classList.add('disable');
                loginBtn.style.display = 'block';
                registerBtn.style.display = 'none';
                emailInput.focus();
            }
        });
    });

    // Закрытие попапа
    popupClose?.addEventListener('click', function () {
                emailInput.value = ''; // <--- обязательно
        popup.style.display = 'none';
        form.reset();


        passwordField.style.display = 'none';
        loginBtn.classList.add('disable');
        loginBtn.style.display = 'block';
        registerBtn.style.display = 'none';
        errorBlock.textContent = '';
        emailInput.classList.remove('input-error', 'input-success');
    });

    // Проверка email через checkEmail
    emailInput.addEventListener('input', function () {
        const email = emailInput.value.trim();
        emailInput.classList.remove('input-error', 'input-success');

        if (!email) {
            loginBtn.classList.add('disable');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailInput.classList.add('input-error');
            loginBtn.classList.add('disable');
            return;
        }

        fetch('/auth/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.exists) {
                emailInput.classList.add('input-success');
                passwordField.style.display = 'block';
                registerBtn.style.display = 'none';
                loginBtn.style.display = 'block';
                loginBtn.textContent = 'Вход';
                loginBtn.classList.add('disable');

                passwordInput.addEventListener('input', () => {
                    loginBtn.classList.toggle('disable', passwordInput.value.trim() === '');
                });
            } else {
                emailInput.classList.add('input-success');
                passwordField.style.display = 'none';
                registerBtn.style.display = 'block';
                loginBtn.style.display = 'none';
            }
        });
    });
    // Обработка формы входа
    loginBtn?.addEventListener('click', function () {
        if (loginBtn.classList.contains('disable')) return;

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        fetch('/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email, password })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/cabinet';
            } else {
                errorBlock.textContent = data.message || 'Неверный логин или пароль';
            }
        });
    });

    // Переход к регистрации
    registerBtn?.addEventListener('click', function () {
        const email = emailInput.value.trim();
        if (!email) return;

        // Закрыть auth-popup и открыть register-popup
        popup.style.display = 'none';
        const regPopup = document.getElementById('register-popup');
        regPopup.style.display = 'block';

        const registerEmailInput = document.getElementById('registerEmail');
        registerEmailInput.value = email;
        registerEmailInput.classList.add('input-success');
    });


    document.addEventListener('click', function (e) {
        if (popup.style.display === 'block' && !popup.contains(e.target) && !e.target.closest('.header__cabinet')) {
            popup.style.display = 'none';
            form.reset();
            emailInput.value = ''; // <--- обязательно

            passwordField.style.display = 'none';
            loginBtn.classList.add('disable');
            loginBtn.style.display = 'block';
            registerBtn.style.display = 'none';
            errorBlock.textContent = '';
            emailInput.classList.remove('input-error', 'input-success');
        }
    });

    document.getElementById('cabinetRegForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
});

    const regForm = document.getElementById('registerForm');
const regSubmitBtn = document.querySelector('.js-next-step_reg');

regSubmitBtn?.addEventListener('click', function () {
    if (regSubmitBtn.classList.contains('disable')) return;

    const fullName = regForm.querySelector('[name="name"]').value.trim();
    const city = regForm.querySelector('[name="city"]').value.trim();
    const phone = regForm.querySelector('[name="phone"]').value.trim();
    const birthday = regForm.querySelector('[name="birthday"]').value;
    const email = document.getElementById('registerEmail').value.trim(); // авто-заполнен
    const password = document.getElementById('registerPassword').value;
    const confirmPassword = document.getElementById('registerPasswordConfirm').value;

    // Валидация на клиенте (можно расширить)
    if (!fullName || !city || !phone || !birthday || !email || !password || !confirmPassword) {
        alert('Пожалуйста, заполните все поля.');
        return;
    }

    if (password !== confirmPassword) {
        alert('Пароли не совпадают!');
        return;
    }

    const formData = new FormData();
    formData.append('name', fullName);
    formData.append('city', city);
    formData.append('phone', phone);
    formData.append('birthday', birthday);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('password_confirmation', confirmPassword);

    fetch('/auth/register', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Регистрация прошла успешно. Подтверди email по ссылке в письме!');
            window.location.href = '/';
        } else if (data.errors) {
            const errors = Object.values(data.errors).flat().join('\n');
            alert(errors);
        } else {
            alert('Ошибка регистрации. Попробуй ещё раз.');
        }
    });

    document.getElementById('registerForm')?.addEventListener('submit', function (e) {
    e.preventDefault(); // всегда блокируем "нативную" отправку формы
});
});


});

</script>
