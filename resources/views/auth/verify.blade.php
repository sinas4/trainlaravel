@extends('layout')

@section('title', 'تایید کد')

@section('content')
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
            text-align: center;
            font-size: 20px;
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
        .info { color: #888; margin-bottom: 15px; }
    </style>
    <div class="box">
        <h1 style="font-size: 1.8rem ; color: white">🔐 کد تایید</h1>
        
        <div class="info">
            کد به شماره {{ session('login_phone') }} ارسال شد
        </div>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <input type="text" name="code" placeholder="کد 6 رقمی" maxlength="6" required>
            <button type="submit">تایید و ورود</button>
        </form>
    </div>
@endsection