@extends('layout')

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
        .box {
            background: #1a1a1a;
            padding: 40px;
            border-radius: 10px;
            width: 350px;
        }
        h1 { color: #f43; margin-bottom: 20px; text-align: center; }
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
        .error { color: #f43; margin-bottom: 15px; text-align: center; }
        .info {
            background: #0d0d0d;
            padding: 10px;
            border-radius: 5px;
            color: #888;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>

    <div class="box">
        <h1>📝 ثبت نام</h1>
        
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="info">
            شماره: {{ session('register_phone') }}
        </div>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <input type="text" name="name" placeholder="نام و نام خانوادگی" required>
            <input type="tel" name="phone" value="{{ session('register_phone') }}" readonly>
            <input type="password" name="password" placeholder="رمز عبور" required>
            <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required>
            <button type="submit">ثبت نام و ورود</button>
        </form>
    </div>
@endsection
