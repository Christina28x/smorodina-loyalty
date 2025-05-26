@extends('layouts.app')
@section('title', 'Данные аккаунта')
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
                <h1 class="text-lowercase">Данные аккаунта</h1>
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
                            <div class="cabinet__menu-item cabinet__menu-item_active">
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
                    {{-- Личные данные --}}
                    <div class="account-data mb-4">
                        <div class="account-data__block p-4">
                            <div class="account-data__block-top d-flex justify-content-between align-items-center">
                                <div class="account-data__block-title">Личные данные</div>
                                <div class="account-data__block-edit-link" id="editUserInfo">Изменить</div>
                            </div>
                            <div class="account-data__block-fields mt-4">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="account-data__block-field-name">Имя и фамилия</div>
                                        <div class="account-data__block-field-desc px-4" id="cabinetIndexName">{{ auth()->user()->name }}</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="account-data__block-field-name">Телефон</div>
                                        <div class="account-data__block-field-desc px-4" id="cabinetIndexPersonalPhone">{{ auth()->user()->phone }}</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="account-data__block-field-name">Почта</div>
                                        <div class="account-data__block-field-desc px-4" id="cabinetIndexEmail">{{ auth()->user()->email }}</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="account-data__block-field-name">Дата рождения</div>
                                        <div class="account-data__block-field-desc px-4" id="cabinetIndexBday">{{ \Carbon\Carbon::parse(auth()->user()->birthday)->format('d.m.Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Пароль --}}
                    <div class="account-data mb-4">
                        <div class="account-data__block p-4">
                            <div class="account-data__block-top d-flex justify-content-between align-items-center">
                                <div class="account-data__block-title">Пароль</div>
                                <div class="account-data__block-edit-link" id="editUserPassword">Изменить</div>
                            </div>
                            <div class="account-data__block-fields mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="account-data__block-field-desc px-4">• • • • • • • •</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fly-popup_cabinet">
                    @include('cabinet.account-data')
                    @include('cabinet.password-data')
                    </div>
                </div>
            </div>
        </div>

    </section>

</main>
<script>
    
document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('editUserInfo');
    const flyOpenProfile = document.getElementById('fly-open-profile');
    const popupWrapper = document.querySelector('.fly-popup_cabinet');
    const popup = popupWrapper.querySelector('.fly-popup_profile'); // сам попап
    const closeBtn = popup.querySelector('.popupclose');
    

    openBtn?.addEventListener('click', function () {
        popup.style.display = 'block';
        flyOpenProfile.className = 'fly-popup fly-open'; // <-- убираем fly-popup2 и другие
        flyOpenProfile.style.display = 'flex';
    });

    closeBtn?.addEventListener('click', function () {
        flyOpenProfile.className = "fly-popup fly-open";
        popup.style.display = 'none';
    });

    document.addEventListener('click', function (e) {
        if (popup.style.display === 'flex'
            && !popup.contains(e.target)
            && !e.target.closest('#editUserInfo')) {
            popup.style.display = 'none';
        }
    });

    const openPasswordBtn = document.getElementById('editUserPassword');
    const flyOpenPassword = document.getElementById('fly-open-password');
    const passwordPopup = document.querySelector('.fly-popup_password');
    const closePasswordBtn = passwordPopup?.querySelector('.popupclose');

    openPasswordBtn?.addEventListener('click', function () {
        flyOpenPassword.className = 'fly-popup fly-open'; // <-- убираем fly-popup2 и другие
        flyOpenPassword.style.display = 'flex';
        passwordPopup.style.display = 'block';
    });

    closePasswordBtn?.addEventListener('click', function () {
        flyOpenPassword.className = "fly-popup fly-open";
        passwordPopup.style.display = 'none';
    });

    document.addEventListener('click', function (e) {
        if (passwordPopup.style.display === 'block'
            && !passwordPopup.querySelector('.fly-popup__item').contains(e.target)
            && !e.target.closest('#editUserPassword')) {
            passwordPopup.style.display = 'none';
        }
    });

    // Инициализация кнопки при загрузке

    const profileForm = document.getElementById('profileChangeForm');

    profileForm?.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(profileForm);

    fetch('/cabinet/update', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Данные успешно обновлены!');
            document.querySelector('[id="cabinetIndexName"]').textContent = formData.get('name');
            document.querySelector('[id="cabinetIndexPersonalPhone"]').textContent = formData.get('phone');
            document.querySelector('[id="cabinetIndexEmail"]').textContent = '{{ auth()->user()->email }}'; // или formData.get('email')
            document.querySelector('[id="cabinetIndexBday"]').textContent = new Date(formData.get('birthday')).toLocaleDateString('ru-RU');
            popup.style.display = 'none';
        } else if (data.errors) {
            const errors = Object.values(data.errors).flat().join('\n');
            alert(errors);
        } else {
            alert('Ошибка обновления. Попробуйте ещё раз.');
        }
    });
        
    });

});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const openPasswordBtn = document.getElementById('editUserPassword');
    const flyOpenPassword = document.getElementById('fly-open-password');
    const passwordPopup = document.querySelector('.fly-popup_password');
    const closePasswordBtn = passwordPopup?.querySelector('.popupclose');

    openPasswordBtn?.addEventListener('click', function () {
        flyOpenPassword.className = 'fly-popup fly-open';
        flyOpenPassword.style.display = 'flex';
        passwordPopup.style.display = 'block';
    });

    closePasswordBtn?.addEventListener('click', function () {
        flyOpenPassword.className = "fly-popup fly-open";
        passwordPopup.style.display = 'none';
    });

    document.addEventListener('click', function (e) {
        if (passwordPopup.style.display === 'block'
            && !passwordPopup.querySelector('.fly-popup__item').contains(e.target)
            && !e.target.closest('#editUserPassword')) {
            passwordPopup.style.display = 'none';
        }
    });

    const passwordInput = document.getElementById('editPassword');
    const passwordConfirmInput = document.getElementById('editPasswordConfirm');
    const saveBtn = document.querySelector('#profileChangeFormPassword .js-next-step');
    const passwordIcon = document.querySelectorAll('.password-icon');
    const passwordForm = document.getElementById('profileChangeFormPassword');

    function validatePasswordForm() {
        const password = passwordInput.value;
        const confirm = passwordConfirmInput.value;
        const isValid = password.length >= 6 && password === confirm;

        saveBtn.disabled = !isValid;
        saveBtn.classList.toggle('disable', !isValid);
    }

    passwordInput.addEventListener('input', validatePasswordForm);
    passwordConfirmInput.addEventListener('input', validatePasswordForm);

    passwordIcon.forEach(icon => {
        icon.addEventListener('click', function () {
            const input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.add('shown');
            } else {
                input.type = 'password';
                this.classList.remove('shown');
            }
        });
    });

    // ✅ AJAX-отправка формы смены пароля
    passwordForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(passwordForm);

        fetch('/cabinet/update-password', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('error-password').textContent = '';
            document.getElementById('error-confirm').textContent = '';
            if (data.success) {
                const toast = document.getElementById('password-success-message');
                toast.style.display = 'block';
                setTimeout(() => toast.style.display = 'none', 3000);
                passwordForm.reset();
                validatePasswordForm();
                passwordPopup.style.display = 'none';
            } else if (data.errors) {
                if (data.errors.new_password) {
                    document.getElementById('error-password').textContent = data.errors.new_password[0];
                }
                if (data.errors.new_password_confirmation) {
                    document.getElementById('error-confirm').textContent = data.errors.new_password_confirmation[0];
                }
            } else {
                alert('Ошибка смены пароля. Попробуйте ещё раз.');
            }
        });
    });

    validatePasswordForm(); // Инициализация состояния кнопки
});
</script>


@endsection

