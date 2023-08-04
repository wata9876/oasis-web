@extends('layouts.blog_app')

@section('title')
    <title>記事詳細 | {{config('app.name')}}</title>
@endsection

@section('header')
    <h1 class="title">記事詳細</h1>
@endsection

@section('content')
<h1 class="h1-bottom">{{ $article->title }}</h1>
    <h2 class="title-bottom">はじめに</h2>
    <div class="content-bottom">
        <p>{{ $article->content }}</p><br>
    </div>

    <h2 class="title-bottom">手順１： 入力ページの作成</h2>
    <div class="content-bottom">
        <p>まずは入力ページを作成し、テンプレートを表示させます。デザインはtailblocksを使用します。</p>
        <p>ルーティングの設定</p>
        <p>routes/web.php</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>Route::get('contact', [MailController::class, 'create'])-&gt;name('mail.index');</li>
</ol></code><br>
<p>MailControllerを新規で作成しました。</p>
<p>Controllers/MailController.php</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">class MailController extends Controller</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Display the login view.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function create(): View</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return view('mail.index');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
</ol></code><br>

    <div>
        <p>テンプレートのデザインについては後述します。</p>
        <p>resources/View/Mail/index.blade.php<p/>
        <img src="./img/mail_form.png" alt="管理画面ログイン">
    </div>

    <h2 class="title-bottom">手順2：　tailblocksの使い方</h2>
    <div class="content-bottom">
        <p>tailblocksはCSS/JavaScript製のオープンソース・ソフトウェアです。ブロックデザインパターンとして用意された中からコピーして貼り付けるだけで使用出来ます。まず、前提としてlaravel breezeをインストールしておく必要があります。</p><br>
        <p>composerを使ってlaravel/breezeパッケージを追加する</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ composer require laravel/breeze --dev</li>
</ol></code><br>
<p>artisanコマンドでインストールする</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ php artisan breeze:install</li>
</ol></code><br>
<p>headタグの中にviteを使い、app.cssを読み込ませる。</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>vite(['resources/css/app.css', 'resources/css/blog_style.css', 'resources/js/app.js'])</li>
</ol></code>

<a href = "https://tailwindcss.com/">こちらがtailwindの公式サイトです。</a>
<p>サイトからおと言い合わせフォームのデザインを選択して、コードをコピーします。あとはbuildするだけでデザインが反映されます</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ npm run build</li>
</ol></code>
    </div>  
     

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection