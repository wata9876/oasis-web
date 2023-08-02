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
        <p>参考記事：<a href="https://codelikes.com/laravel-seeder/" rel="nofollow noopener" target="_blank">LaravelでSeederを使う方法！(初期データを登録する)</a></P> 
    </div>

    <h2 class="title-bottom">手順１： seederファイルを作成する</h2>
    <div class="content-bottom">
        <p>まず、以下のコマンドでseederファイルを作成する。database/seedersに生成される。</p><br>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
                <li>php artisan db:seed --class ArticleSeeder</li>
            </ol>
        </code>
    </div>

    <h2 class="title-bottom">手順2： seederクラスに登録した内容を編集する</h2>
    <div class="content-bottom">
        <p>※DBファサードを使って登録をするので【use Illuminate\Support\Facades\DB;】 を記載するのを忘れずに。</p><br>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
                <li>&lt;?php</li>
                <li></li>
                <li>namespace Database\Seeders;</li>
                <li></li>
                <li>use Illuminate\Database\Console\Seeds\WithoutModelEvents;</li>
                <li>use Illuminate\Database\Seeder;</li>
                <li>use Illuminate\Support\Facades\DB;</li>
                <li></li>
                <li>class ArticleSeeder extends Seeder</li>
                <li>{</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Run the database seeds.</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return void</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;public function run()</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;{</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DB::table('articles')-&gt;insert([</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'title' =&gt; 'seederを使って初期データを登録する',</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'content' =&gt; 'seederを使ってDBにデータを登録する手順をまとめました。',</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;}</li>
                <li>}</li>
                <li></li>
            </ol>
        </code>
    </div>
    
    <h2 class="title-bottom">手順3： DatabaseSeederファイルに記載する</h2>
    <div class="content-bottom">
        <p>runメソッドに実行したいseederファイル名を記載する。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>&lt;?php</li>
<li></li>
<li>namespace Database\Seeders;</li>
<li></li>
<li>// use Illuminate\Database\Console\Seeds\WithoutModelEvents;</li>
<li>use Illuminate\Database\Seeder;</li>
<li></li>
<li>class DatabaseSeeder extends Seeder</li>
<li>{</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Seed the application's database.</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return void</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;public function run()</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// \App\Models\User::factory(10)-&gt;create();</li>
<li></li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// \App\Models\User::factory()-&gt;create([</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//     'name' =&gt; 'Test User',</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//     'email' =&gt; 'test@example.com',</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// ]);</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;call([</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AdminSeeder::class,</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UserSeeder::class,</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ArticleSeeder::class,</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li>}</li>
<li></li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順4： seederファイルを実行する</h2>
    <div class="content-bottom">
        <p>以下のartidsanコマンドでSeederを実行する。</p><br>
            <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ php artisan db:seed --class ArticleSeeder</li>
</ol></code>
        <p>DBに登録されているのを確認する。</p>
    </div>

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection