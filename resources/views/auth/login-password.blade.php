@extends('layout')

@section('title', 'ورود ')
@push('styles')
    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        /* body {
            font-family: Tahoma, sans-serif;
            background: #0d0d0d;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        } */
         .container{
            display: flex;
    justify-content: center;
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
        .back-link {
            display: block;
            margin-top: 15px;
            color: #888;
            text-decoration: none;
        }
        .back-link:hover { color: #f43; }
    </style>
@endpush
@section('content')
    

    <div style="" class="box">
        <h1 style="font-size: 1.8rem ; color: white">🔐 ورود با رمز عبور</h1>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.password.submit') }}">
            @csrf
            <input type="tel" name="phone" placeholder="شماره موبایل" required>
            <input type="password" name="password" placeholder="رمز عبور" required>
            <button type="submit">ورود</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← بازگشت</a>
    </div>
@endsection