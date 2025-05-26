@extends('layouts.app') {{-- если используешь макет, иначе убери --}}
@section('content')
<div class="container text-center" style="padding: 60px 20px;">
    <h1>Почта успешно подтверждена</h1>
    <p>Спасибо за подтверждение. Теперь ты можешь пользоваться всеми возможностями личного кабинета.</p>
    <a href="{{ route('cabinet') }}" class="smo-btn" style="margin-top: 20px;">Перейти в кабинет</a>
</div>
@endsection
