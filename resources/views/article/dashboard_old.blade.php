@extends('layouts.blog_app')

@section('title')
    <title>記事一覧 | {{config('app.name')}}</title>
@endsection

@section('header')
    <h1 class="title">記事一覧</h1>
@endsection

@section('content')
    @foreach ($articles as $article)
        <ul class="dateList">
            <li class="dateList__item">{{$article->created_at}}</li>
        </ul>
        <h2 class="heading heading-secondary ellipsis">{{ $article->title }}</h2>
        <p class="phrase phrase-secondary ellipsis">
        {{$article->content}}    
        </p>
        <div class="btn btn-right">
            <a class="btn__link btn__link-normal" href="{{ route('article.show', $article->id) }}">続きを読む</a>
        </div><br>
    @endforeach
    <a href="{{ route('profile') }}">プロフィールに戻る</a>    
@endsection