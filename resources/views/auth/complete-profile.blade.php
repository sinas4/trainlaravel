@extends('layout')

@section('title', 'ورود')

@push('styles')
<style>
    /* حذف استایل body از اینجا - فقط استایل باکس رو نگه دار */
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
        .error { color: #f43; margin-bottom: 15px; text-align: center; }
        .info {
            background: #0d0d0d;
            padding: 10px;
            border-radius: 5px;
            color: #888;
            margin-bottom: 20px;
        }
</style>
@endpush

@section('content')
    <div class="box">
        <h1 style="font-size: 1.8rem ; color: white">📝 تکمیل اطلاعات</h1>
        
        <div class="info">
            📱 {{ session('temp_phone') }}
        </div>
        
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('complete.profile.submit') }}">
            @csrf
            <input type="text" name="name" placeholder="نام و نام خانوادگی" required>
            <input type="password" name="password" placeholder="رمز عبور" >
            <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" >
            <button type="submit">ثبت نام و ورود</button>
        </form>
    </div>
@endsection