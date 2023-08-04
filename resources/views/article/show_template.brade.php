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
        <p></p><br>
        <p></p>
    </div>

    <h2 class="title-bottom">手順１： dockerインストール</h2>
    <div class="content-bottom">
        <p></p><br>
        <p></p><br>
    </div>

    <h2 class="title-bottom">手順2：laravelのインストール</h2>
    <div class="content-bottom">
        <p></p><br>
        <p></p><br>
    </div>  
     

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection