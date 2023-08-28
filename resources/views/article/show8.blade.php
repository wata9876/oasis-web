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
        <p>Python3で前回Laravelで作成した小説登録APIをPythonから呼び出してみるやり方を実装しました。</p><br>
        <p></p>
    </div>

    <h2 class="title-bottom">手順１： ライブラリを使ってGETリクエスする</h2>
    <div class="content-bottom">
        <p>PythonファイルからGETリクエストを行なってWeb APIのデータを取得する方法はシンプルにこれだけのコードで実装できます。</p><br>
        <p>novel.py<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">import requests</li>
<li style="background-color:#EFF;">import json</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;"># エンドポイント</li>
<li style="background-color:#EEF;">url = 'http://localhost:4450/api/novels'</li>
<li style="background-color:#EFF;"># リクエスト</li>
<li style="background-color:#EEF;">res = requests.get(url)</li>
<li style="background-color:#EFF;">print(res)</li>
<li style="background-color:#EEF;"># 取得したjsonをlists変数に格納</li>
<li style="background-color:#EFF;">lists = json.loads(res.text)</li>
<li style="background-color:#EEF;">for list in lists:</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;print(list)</li>
<li style="background-color:#EEF;"></li>
</ol></code></p><br>
<p>１行目の【import requests】の記述がGETリクエストをするのに必要なライブラリを読み込んでいます。</p>
<p>requestsのライブラリは事前にインストールして準備します。</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>pip install requests</li>
</ol></code><br>
<p>あとは下記の記述でrequestsのライブラリを使ってURLに対してGETリクエストを行い、JSONに変換します。</p>
<p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;"># エンドポイント</li>
<li style="background-color:#EFF;">url = 'http://localhost:4450/api/novels'</li>
<li style="background-color:#EEF;"># リクエスト</li>
<li style="background-color:#EFF;">res = requests.get(url)</li>
<li style="background-color:#EEF;">print(res)</li>
<li style="background-color:#EFF;"># 取得したjsonをlists変数に格納</li>
<li style="background-color:#EEF;">lists = json.loads(res.text)</li>
<li style="background-color:#EFF;">for list in lists:</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;print(list)</li>
</ol></code></p>
<p>参考記事：<a href="https://blog.pyq.jp/entry/python_kaiketsu_220803" rel="nofollow noopener" target="_blank">Python学習チャンネル by PyQ</a></P> 

    </div>
    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection