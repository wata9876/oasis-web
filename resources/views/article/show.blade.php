@extends('layouts.blog_app')

@section('title')
    <title>記事詳細 | {{config('app.name')}}</title>
@endsection

@section('header')
    <h1 class="title">記事詳細</h1>
@endsection

@section('content')
<h1 class="h1-bottom">laravel9 sailを使って環境構築を行った際の備忘録</h1>
    <h2 class="title-bottom">概要</h2>
    <div class="content-bottom">
        <p>laravel9を学習してスキルアップをしたかったので、今回はsailを使った環境構築を行いました。その際の手順を備忘録として記載しています。</p><br>
        <p>参考記事：<a href="https://qiita.com/hinako_n/items/45a7232b0b0ed16bffc8" rel="nofollow noopener" target="_blank">Laravelsailを使ってLaravel9の環境構築を行う</a></p>
    </div>

    <h2 class="title-bottom">手順１： dockerインストール</h2>
    <div class="content-bottom">
        <p>macを使っていますが、事前準備としてdockerをインストールしておきます。ちなみにMac M1を使用していたので、「Mac with Apple chip」をクリックしてインストーラーをダウンロードしました。</p><br>
        <p>ちなみにM1の場合は「Mac with Apple chip」の方でないと動きませんでした。</p><br>
        <p>参考記事：<a href="https://chigusa-web.com/blog/docker-desktop-mac/" rel="nofollow noopener" target="_blank">【Docker Desktop】Macにインストール【Monterey/M1】</a></P> 
    </div>

    <h2 class="title-bottom">手順2：laravelのインストール</h2>
    <div class="content-bottom">
        <p>以下のコマンドを実行し、プロジェクトを作成する。</P>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
                <li>curl -s https:<font style="color:lightgreen;font-style:italic;">//laravel.build/プロジェクト名 | bash</font></li>
            </ol>
        </code><br>
    
        <p>作成したプロジェクト配下に移動し、sailを実行する。(docker-compose upと同じでコンテナを実行している。）</p>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>./vendor/bin/sail up</li>
            </ol>
        </code><br>
        <p>http://localhost/でlaravelの初期ページが表示されればOK！</p><br>
        <p>laravelをインストールすると、docker-compose.ymlもプロジェクト配下に置かれている。</P>
        <p>つまり、sailを実行したことにより、dockerがビルドされてコンテナを起動している。</p><br>
        <p>ちなみに毎回【./vendor/bin/sail up】のコマンドを実行するのも面倒なのでエイリアスを設定出来る。</p>
        <p>vim ~/.zshrcでファイルを開き、以下の内容を保存する。</p>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
                <li>&nbsp;&nbsp;---</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;# Laravel Sail Command Alias</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;alias sail="./vendor/bin/sail"</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;---</li>
                </ol>
        </code><br>
        <p>設定した内容を再読み込みする。</p>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>$ source ~/.zshrc</li>
            </ol>
        </code><br>
        <p>そうすると以下のコマンドで実行ができる。</p>
        <p>コンテナの起動：sail up</p>
        <p>コンテナの停止：sail down</p><br>
        <p>参考記事：<a href="https://www.ritolab.com/posts/217" rel="nofollow noopener" target="_blank">【Docker Desktop】Macにインストール【Monterey/M1】</a></P> 
    </div>

    <h2 class="title-bottom">手順3： 設定ファイルの編集</h2>
    <div class="content-bottom">
        <p>config/app.phpのファイルの中身を日本語に更新する。</P>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>&nbsp;'timezone' =&gt; 'Asia/Tokyo',</li>
            <li>&nbsp;'locale' =&gt; 'ja',</li>
            <li>&nbsp;'faker_locale' =&gt; 'ja_JP',</li>
            </ol>
        </code><br>
        <p>以上で環境構築の手順は完了です。</P>
    </div>

    <h2 class="title-bottom">その他１：PHPMyadminを使用したい場合</h2>
    <div class="content-bottom">
        <p>docker-compose.ymlファイルに以下を記述し、ビルドする。</P>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>phpmyadmin:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image: phpmyadmin/phpmyadmin</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;links:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- mysql:mysql</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ports:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- 8080:80</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;environment:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MYSQL_USERNAME: '${DB_USERNAME}'</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PMA_HOST: mysql</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;networks:</li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- sail</li>
            </ol>
        </code> <br>
        <p>参考記事：<a href="https://qiita.com/kai_kou/items/0e773aaf50698dd5a93f" rel="nofollow noopener" target="_blank">Laravelの開発環境をDockerで構築しようとしたら公式さんがLaravel Sailって素敵ツールを提供してくれていました</a><p>
    </div>
    <h2 class="title-bottom">その他２：laravel Breezeを使用したい場合</h2>
    <div class="content-bottom">
        <p>Laravel Breezeをダウンロードする。</P>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>$ composer require laravel/breeze --dev</li>
            </ol>
        </code><br>
        <p>artisanコマンドでbreezeをインストールする。</P>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
            <li>$ php artisan breeze:install</li>
            </ol>
        </code><br>
        <p>laravelのトップページの右上にloginとregisterが表示されていてばインストール完了！</P>
    </div><br>

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection