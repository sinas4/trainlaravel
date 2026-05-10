@extends('layout')

@section('title', $post->title ?? 'مشاهده پست')

@section('content')
 @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    <div class="container">
        @if ($post)
            <div class="post-header">
                <h1>{{ $post->title }}</h1>
                <div class="post-meta">
                    <span>📅 {{ $post->created_at }}</span>
                    <span>🏷️ {{ $post->category ?? 'دسته‌بندی نشده' }}</span>
                </div>
            </div>

            <div class="post-content">
                <p>{{ $post->description }}</p>
            </div>

            <div class="post-footer">
                <a href="{{ route('posts.index') }}" class="back-btn">← بازگشت به لیست پست‌ها</a>

                @auth

                <a href="{{ route('posts.edit', $post->slug) }}" class="back-btn">✏️ ویرایش پست</a>
                <form action="{{ route('posts.delete', $post->slug) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="back-btn" onclick="return confirm('آیا مطمئنی؟')">🗑️ حذف</button>
                </form>
                @endauth
            </div>
        @else
            <h1>پست مورد نظر یافت نشد</h1>
            <a href="{{ route('posts.index') }}">بازگشت به لیست پست‌ها</a>
        @endif
    </div>
@endsection
