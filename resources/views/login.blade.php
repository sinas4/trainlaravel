
@extends('layout')

@section('title', 'login')


@section('content')

 <div class="login-box">
        <h1 class="login-title"> ورود</h1>
        
        @if(session('error'))
            <div class="error-msg">{{ session('error') }}</div>
        @endif
        @error('phone')
             <span class="error-msg">{{$message }}</span>
        @enderror
                

        <form method="POST" action="{{ route('send.code') }}">
            @csrf
            <input type="tel" name="phone" class="login-input" placeholder="09123456789" >
            <button type="submit" class="login-btn">ارسال کد</button>
        </form>
    </div>
</body>
</html>
@endsection