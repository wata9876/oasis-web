@extends('layouts.main')
@section('title')
    <title>{{config('app.name')}}</title>
@endsection
@section('content')
<div class="container">
<article>
    <h1 class="new_article">新着記事</h2>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
        @foreach ($articles as $article)
            <div class="flex flex-wrap -m-12">
                <div class="p-12 md:w-1/2 flex flex-col items-start">
                    <span class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">作成日：{{$article->created_at}}</span>
                    <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">{{$article->title}}</h2>
                    <p class="leading-relaxed mb-8">{{$article->content}}</p>
                    <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
                        <a href="{{ route('article.show', $article->id) }}" class="text-indigo-500 inline-flex items-center">続きを読む
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            
            </div>
            @endforeach
        </div>
    </section>
</article>
<aside>
    <h2 class="name">著者：　k.watanabe</h2>
    <img src="./img/top-image.jpg" alt="top-image.jpg" class="about_img">
    <p>　エンジニア歴8年になります。watanabeと申します。<br>当サイトは、PHPのLaravelを中心に勉強するためにポートフォリオとして作成しました。<br>随時アップデートしていきますのでよろしくお願いします。</p>
   
    <ul>
        <li>開発言語：PHP HTML CSS Javascript</li>
        <li>フレームワーク：laravel  cakePHP  zend  スクラッチでの開発経験もあり</li>
        <li>ツール：vscode git TeraTerm WinScp</li><br>
        <li>gitHub <a class="a_link" href="https://github.com/wata9876" target="_blank">https://github.com/wata9876</a><li>
    </ul>
</aside>
</div>
@endsection    
