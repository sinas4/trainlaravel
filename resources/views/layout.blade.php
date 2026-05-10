<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'وبلاگ من')</title>
    <link rel="stylesheet" href="/css/style.css">

    @stack('styles')
</head>

<body>

    <nav>
        @auth
            <a href="{{ route('dashboard') }}">داشبورد</a>  
        @else
            <a href="{{ route('login') }}">ورود</a>
        @endauth
        <a href="{{ route('home') }}">خانه</a>
        <a href="{{ route('users.index') }}">کاربران</a>
        <a href="{{ route('todos.index') }}">todo</a>
        <a href="{{ route('notes.index') }}">یادداشت ها</a>
        <a href="{{ route('posts.index') }}">وبلاگ ها</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>تمرین من &copy; 2025</p>
    </footer>

</body>

</html>
