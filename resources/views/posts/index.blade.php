@extends('layout')

@section('title', 'posts')


@section('content')

    <div class="container">
        <div class="flex justify-between items-center mb-6">
            <h1>📝 همه وبلاگ‌ها</h1>
           
            @auth
            <a href="{{ route('posts.create') }}" class="add-btn">➕ افزودن پست جدید</a>
            @endauth
        </div>
         @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
        @foreach ($posts as $post)
        <div class="post-card">
            <h2>  {{ $post->title }} </h2>
            <p>{{ $post->description }} </p>
            <a href="{{ route('posts.single', $post->slug) }}">بیشتر بخوانید →</a>
        </div>
        @endforeach
        
        
        
    </div>
@endsection
