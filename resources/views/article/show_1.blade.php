@extends('layouts.blog_app')

@section('title')
    <title>記事詳細 | {{config('app.name')}}</title>
@endsection

@section('header')
    <h1 class="title">記事詳細</h1>
@endsection

@section('content')
<h1 class="h1-bottom">laravel9 sailを使って環境構築を行った際の備忘録</h1>
    <h2 class="title-bottom">はじめに</h2>
    <div class="content-bottom">
        <p>記事を登録するための管理画面を作成しました。将来的にはフロントとマイページと管理画面でマルチ認証を実装していく想定です。今回は管理画面の部分のみ内容をまとめてみました。</p><br>
        <p>参考記事：<a href="https://qiita.com/hinako_n/items/45a7232b0b0ed16bffc8" rel="nofollow noopener" target="_blank">Laravelsailを使ってLaravel9の環境構築を行う</a></p>
    </div>

    

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection