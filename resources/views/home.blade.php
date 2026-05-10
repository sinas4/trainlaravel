@extends('layout')

@section('content')
<div class="container">
    @auth
        <div style="background: #2a2a2a; padding: 20px; border-radius: 10px;">
            <h1 style="color: rgb(255, 255, 255);"> {{ Auth::user()->name }}  خوش آمدی </h1>
            <!-- <p> {{ Auth::user()->name }}</p> -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background: #f43; color: white; border: none; padding: 8px 16px; border-radius: 5px;">خروج</button>
            </form>
        </div>
    @else
    <container class="container2"></container>
        <div style="background: #1a1a1a; padding: 20px; border-radius: 10px; text-align: center;">
            <h1 style="color: #f43;">به تمرین من خوش آمدید</h1>
             <p>لطفاً <a href="{{ route('login') }}" style="color: #f43;">وارد شوید</a></p>
        </div>
    </container>    
    @endauth
</div>  
@endsection
