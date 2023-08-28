<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="site-title">ミニブログ</div>
    </header>
    <main class="container">
        @foreach ($novels as $novel)
       <?php
       var_dump($novel->title);
       ?>
        </article>
        @endforeach
    </main>
    <footer>
        &copy; Laravel8 入門〜開発実践まで
    </footer>
</body>
</html>