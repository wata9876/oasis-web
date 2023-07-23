<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Site Info -->
    @yield('title')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Klee+One:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container">
    <header id="header">
        <h1>{{config('app.name')}}</h1>
        <ul id="global-menu">
            <li><a href="{{ route('profile') }}">プロフィール</a></li>
            <li><a href="{{ route('article') }}">ポートフォリオ</a></li>
            <li><a href="#">お問い合わせ</a></li>
        </ul>
    </header>

    @yield('content')

    <footer id="footer">
        <small>&copy; 2023 k.watanabe</small>
    </footer>
</body>
</html>