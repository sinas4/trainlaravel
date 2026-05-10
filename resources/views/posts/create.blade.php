@extends('layout')

@section('title', 'ایجاد پست جدید')

@section('content')
<div class="container">
    <h1>✏️ ایجاد پست جدید</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf        
        <div class="form-group">
            <label>عنوان پست</label>
            <input type="text" name="title" placeholder="عنوان پست" required>
            @error('title')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>متن کامل پست</label>
            <textarea name="description" placeholder="متن اصلی پست را بنویسید..." required></textarea>
            @error('description')
                <span class="error-msg">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit">انتشار پست</button>
        <button type="button" class="cancel-btn"><a href="{{ route('posts.index') }}">انصراف</a></button>
    </form>
</div>
@endsection