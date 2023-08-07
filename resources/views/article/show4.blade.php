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
        <p>参考記事：<a href="https://utubou-tech.com/laravel_validation_ja/" rel="nofollow noopener" target="_blank">ウツボウTECH</a></p>
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
     
    <h2 class="title-bottom">手順3： バリデーションの実装</h2>
    <div class="content-bottom">
        <p>artisanコマンドでリクエストクラスを作成する。</p><br>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>php artisan make:request MailRequest</li>
</ol></code></p><br>
    </div>

    <p>authorizeメソッドは認証しているかどうかチェックしたい時に使用する。デフォルトではfalseになっているので403エラーになってしまう。trueを返すか、使用しないのであれば削除する。</p>
    <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">&lt;?php</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">namespace App\Http\Requests;</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">use Illuminate\Foundation\Http\FormRequest;</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">class MailRequest extends FormRequest</li>
<li style="background-color:#EEF;">{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Determine if the user is authorized to make this request.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return bool</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function authorize()</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return true;</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the validation rules that apply to the request.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return array&lt;string, mixed&gt;</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function rules()</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return [</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; 'required|max:20',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; 'required|email|max:100',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'message' =&gt; 'required|max:500',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;];</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;">}</li>
<li style="background-color:#EFF;"></li>
</ol></code>
<p>バリデーションにnameとemailとmessageに対してrequire(必須)とmax(上限)のチェックを指定した。</p>

<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Display the login view.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function confirm(MailRequest $request): View</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return view('mail.confirm', ['contents' =&gt; $request-&gt;validated()]);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code>
<p>第一引数にMailRequestを指定することで、MailController.phpが呼ばれる前にMailRequest.phpでチェックを行なっている。</p>
<p>パラメーターを受け取る場合は以下のようにする。</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$params = $request-&gt;validated();</li>
</ol></code>

<h2 class="title-bottom">手順4： バリデーションメッセージを日本語で表示させる</h2>
    <div class="content-bottom">
        <p>configファイルをjaに変更する。</p><br>
        <p>config/app.php</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>'locale' =&gt; 'ja',</li>
</ol></code>
    <p>デフォルトではenとなっているのでjaに変更</p>
    <p>resources/lang/en/validation.phpファイルをresources/lang/ja/にコピーする。</p>
    <p>日本語の訳を以下の公式サイトからコピーして日本語用のvalidation.phpファイルを作成する。</p>
    <p><a href="https://readouble.com/laravel/9.x/ja/validation-php.html">Laravel 9.x validation.php言語ファイル</a>
    </div>
    <p>resources/lang/ja/validation.php</P>
    <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">attributes' =&gt; [</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; '氏名',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; 'メールアドレス',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'message' =&gt; '本文',</li>
<li style="background-color:#EEF;">],</li>
<li style="background-color:#EFF;"></li>
</ol></code>
<p>そのままだとバリデーション表示時にnameやemailと表示されるので、keyに対してそれぞれ日本語を指定する。<p/>
<img src="./img/form_check.png" alt="管理画面ログイン">
    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection