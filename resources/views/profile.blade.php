@extends('layouts.my_app')

@section('title')
    <title>{{config('app.name')}}</title>
@endsection

@section('content')
    <img src="./img/top-image.jpg" alt="top-image.jpg" class="about_img">

    <main id="about">
        <h1>プロフィール</h1>
        <p>　エンジニア歴8年になります。watanabeと申します。<br>当サイトは、PHPのLaravelを中心に勉強するためにポートフォリオとして作成しました。<br>随時アップデートしていきますのでよろしくお願いします。</p>
       
        <article id="profile">
            <img src="./img/sheep.jpg" alt="sheep.jpg" class="about_img">

            <h2 class="name">k.watanabe</h2>
            <ul>
                <li>開発言語：PHP HTML CSS Javascript</li>
                <li>フレームワーク：laravel  cakePHP  zend  スクラッチでの開発経験もあり</li>
                <li>ツール：vscode git TeraTerm WinScp</li><br>
                <li>gitHubはこちらになります。<a class="a_link" href="https://github.com/wata9876" target="_blank">https://github.com/wata9876</a><li>
            </ul>
           
        </article>
    </main>
    @endsection    