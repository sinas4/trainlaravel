@extends('layout')

@section('title', 'ورود')

@push('styles')
<style>
    /* حذف استایل body از اینجا - فقط استایل باکس رو نگه دار */
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }
    .box {
        background: #1a1a1a;
        padding: 40px;
        border-radius: 10px;
        width: 350px;
        text-align: center;
    }
    h1 { color: #f43; margin-bottom: 20px; }
    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        background: #0d0d0d;
        border: 1px solid #333;
        color: #fff;
        border-radius: 5px;
        text-align: center;
    }
    button {
        background: #f43;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }
    button:hover { background: #d32; }
    .error { color: #f43; margin-bottom: 15px; }
    .success { color: #0f0; margin-bottom: 15px; }
    .divider {
        margin: 20px 0;
        border-top: 1px solid #333;
    }
    .password-link {
        display: block;
        margin-top: 15px;
        color: #888;
        text-decoration: none;
    }
    .password-link:hover { color: #f43; }
</style>
@endpush

@section('content')
<div class="login-wrapper">
    <div class="box">
        <h1 style="font-size: 1.8rem ; color: white">📱 ورود به حساب</h1>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('phone.check') }}">
            @csrf
            <input type="tel" name="phone" placeholder="شماره موبایل" required>
            <button type="submit">ارسال کد تایید</button>
        </form>

        <div class="divider"></div>

        <a href="{{ route('login.password') }}" class="password-link">🔐 ورود با رمز عبور</a>
    </div>
</div>
@endsection