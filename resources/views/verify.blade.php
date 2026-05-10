@extends('layout')

@section('title', 'login')
 
 
@section('content')

    <div class="box">
        <h1> کد تایید</h1>
        <p style="color:#888; margin-bottom:15px;">کد به شماره {{ session('login_phone') }} ارسال شد</p>
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <input type="text" name="code" placeholder="کد 6 رقمی" maxlength="6" required>
            <button type="submit">ورود</button>
        </form>
    </div>

@endsection