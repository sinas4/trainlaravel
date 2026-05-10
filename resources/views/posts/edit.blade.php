@extends('layout')

@section('title', 'ایجاد پست جدید')

@section('content')
<div class="container">
    <h1>✏️ تغییر پست {{ $post->title }}</h1>

    <form action="{{ route('posts.update', $post->slug) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>عنوان پست</label>
            <input type="text" name="title" placeholder="عنوان پست" value="{{ old('title' , $post->title) }}" required>
            @error('title')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>متن کامل پست</label>
            <textarea name="description" placeholder="متن اصلی پست را بنویسید..."  required>{{ old('title' , $post->description) }}</textarea>
            @error('description')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit">ویرایش پست</button>
        <button type="button" class="cancel-btn"><a href="{{ route('posts.index') }}">انصراف</a></button>
    </form>
</div>
@endsection
