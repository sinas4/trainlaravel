@extends('layout')

@section('title', 'داشبورد')

@push('styles')
<style>
    .dashboard-box {
        background: #1a1a1a;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        margin: 0 auto;
    }
    h1 {
        color: #f43;
        margin-bottom: 30px;
        text-align: center;
    }
    h2 {
        color: #f43;
        font-size: 18px;
        margin-bottom: 15px;
        border-bottom: 1px solid #333;
        padding-bottom: 5px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        color: #ddd;
        margin-bottom: 8px;
    }
    input {
        width: 100%;
        padding: 10px;
        background: #0d0d0d;
        border: 1px solid #333;
        color: white;
        border-radius: 5px;
    }
    input:focus {
        outline: none;
        border-color: #f43;
    }
    button {
        background: #f43;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #d32;
    }
    .logout-btn {
        background: #333;
        margin-top: 20px;
        width: 100%;
    }
    .logout-btn:hover {
        background: #444;
    }
    .success {
        background: #0d0d0d;
        border-right: 3px solid #0f0;
        padding: 10px;
        margin-bottom: 20px;
        color: #0f0;
    }
    .error {
        background: #0d0d0d;
        border-right: 3px solid #f43;
        padding: 10px;
        margin-bottom: 20px;
        color: #f43;
    }
    .user-info {
        background: #0d0d0d;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 30px;
        text-align: center;
    }
    .user-info p {
        margin: 5px 0;
        color: #ddd;
    }
    .user-info strong {
        color: #f43;
    }
</style>
@endpush

@section('content')
<div class="dashboard-box">
    <h1>📊 داشبورد</h1>
    
    <div class="user-info">
        <p>👋 خوش آمدی، <strong>{{ Auth::user()->name }}</strong></p>
        <p>📱 شماره تماس: <strong>{{ Auth::user()->phone }}</strong></p>
    </div>
    
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    
    <!-- تغییر نام -->
    <h2>✏️ تغییر نام</h2>
    <form method="POST" action="{{ route('dashboard.update.profile') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>نام و نام خانوادگی</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            @error('name')
                <small style="color: #f43;">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit">به‌روزرسانی نام</button>
    </form>
    
    <br><br>
    
    <!-- تغییر رمز -->
    <h2>🔐 تغییر رمز عبور</h2>
    <form method="POST" action="{{ route('dashboard.update.password') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>رمز فعلی</label>
            <input type="password" name="current_password" >
            @error('current_password')
                <small style="color: #f43;">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>رمز جدید</label>
            <input type="password" name="new_password" >
            @error('new_password')
                <small  style="color: #f43;">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>تکرار رمز جدید</label>
            <input type="password" name="new_password_confirmation" >
        </div>
        <button type="submit">تغییر رمز عبور</button>
    </form>
    
    <!-- خروج -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">🚪 خروج از حساب</button>
    </form>
</div>
@endsection