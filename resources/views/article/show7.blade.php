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
    <p>　今回はlarval breezeを使用して会員登録とログイン機能を実装してみました。larval breezeとはログイン機能やメール認証、パスワードを忘れた場合などの認証周りに必要な機能が用意されたパッケージです。デフォルトの状態でそれらの機能が備わっているので必要に応じてカスタマイズするだけで実装出来ます。</p>
    </div>

    <h2 class="title-bottom">手順１： モデルクラスの編集</h2>
    <div class="content-bottom">
        <p>デフォルトの状態では以下のコードがコメントアウトされてメール認証が無効になっているため、コメントアウトを外して有効にします。</p><br>
        <p>App/Models/User.php</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>use Illuminate\Contracts\Auth\MustVerifyEmail;</li>
</ol></code><br>

     <p>さらに implements 　MustVerifyEmailを追加します。</p>
     <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>class User extends Authenticatable implements MustVerifyEmail</li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順2：バリデーションの確認</h2>
    <div class="content-bottom">
        <p>デフォルトの状態からバリデーションも実装されています。</p><br>
        <p>Bladeファイルにhtmlの必須チェックが入っているので、それを削除してバリデーションメッセージが表示されることを確認します</p><br>
<img src="./img/register.png" alt="postman5">
<p>確認用パスワードのチェックがなかったので追加しました。</p>
<p>RegisteredUserController.php</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Handle an incoming registration request.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @throws \Illuminate\Validation\ValidationException</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function store(Request $request): RedirectResponse</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request-&gt;validate([</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; ['required', 'string', 'max:255'],</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; ['required', 'string', 'email', 'max:255', 'unique:'.User::class],</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password' =&gt; ['required', 'confirmed', Rules\Password::defaults()],</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password_confirmation' =&gt; ['required', Rules\Password::defaults()],</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EFF;"></li>
</ol></code><br>

<p>エラーメッセージも日本語で表示するようにします。</p>
<p>Resources/lang/ja/validation.php</P>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;'attributes' =&gt; [</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; '氏名',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; 'メールアドレス',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'title' =&gt; '件名',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'message' =&gt; '本文',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password' =&gt; 'パスワード',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password_confirmation' =&gt; '確認用パスワード'</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;],</li>
<li style="background-color:#EFF;"></li>
</ol></code>

    </div>  
    <h2 class="title-bottom">手順3： ユーザー登録</h2>
    <div class="content-bottom">
        <p>ユーザー登録も初めからusersテーブルとUserモデルクラスが用意され、バリデーションが通ると登録されるロジックが実装されています。</p><br>
        <p>RegisteredUserController.php</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">&nbsp;public function store(Request $request): RedirectResponse</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request-&gt;validate([</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; ['required', 'string', 'max:255'],</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; ['required', 'string', 'email', 'max:255', 'unique:'.User::class],</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password' =&gt; ['required', 'confirmed', Rules\Password::defaults()],</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password_confirmation' =&gt; ['required', Rules\Password::defaults()],</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$user = User::create([</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'name' =&gt; $request-&gt;name,</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; $request-&gt;email,</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password' =&gt; Hash::make($request-&gt;password),</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;event(new Registered($user));</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Auth::login($user);</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return redirect(RouteServiceProvider::HOME);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>

<p>バリデーションが通った後にusersテーブルに登録されているのが確認出来ました。</p>
<img src="./img/users.png" alt="users"><br><br>
<p>メール認証の文章は適宜日本語に訳しました。テンプレートも最初から用意されています。</p>
<img src="./img/mail_send.png" alt="mail_send">
<p>メールからURLをクリックすると認証され、ログイン状態になってマイページに遷移する所まで確認出来ました。</p>
<img src="./img/mypage.png" alt="mypage">
    </div>

    <h2 class="title-bottom">その他１： ログイン認証のセキュリティ対策</h2>
    <div class="content-bottom">
        <p>Breezeではセキュリティ対策として認証で何度も失敗した場合は一定時間ロックされ、すぐにログイン出来なくなるように設定されています。これはブルートフォースアタックなどを防ぐためです。</p><br>
        <img src="./img/login2.png" alt="mypage">
<p>デフォルトでは5回失敗した場合はすぐにログイン出来なくなるように設定されています。回数を変更したい場合は、【tooManyAttempts】に指定されている引数の5を変更します。</p>
<p>HTTP/Requests/Auth/LoginRequest.php</P>        
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Ensure the login request is not rate limited.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @throws \Illuminate\Validation\ValidationException</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function ensureIsNotRateLimited(): void</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (! RateLimiter::tooManyAttempts($this-&gt;throttleKey(), 5)) {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return;</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code>
        <p>デフォルトでは1分間ロックされるように設定されています。</p><br>
        <p>例えば5分間ロックされるようにしたい場合は、RateLimiter::hitの第二引数に秒単位で指定します。5分は300秒なので300を追加しました。</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EFF;">/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Attempt to authenticate the request's credentials.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @throws \Illuminate\Validation\ValidationException</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function authenticate(): void</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;ensureIsNotRateLimited();</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (! Auth::attempt($this-&gt;only('email', 'password'), $this-&gt;boolean('remember'))) {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RateLimiter::hit($this-&gt;throttleKey(),300);</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;throw ValidationException::withMessages([</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email' =&gt; trans('auth.failed'),</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RateLimiter::clear($this-&gt;throttleKey());</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>
<p>300秒後に設定が変更出来ました。</P>
<img src="./img/login3.png" alt="login3">

<p>あとは登録されていないアカウントでログインをした場合のバリデーションも最初から実装された状態になっています。</p>
<img src="./img/login.png" alt="login">
    </div>    
    <h2 class="title-bottom">まとめ</h2>
    <div class="content-bottom">
        <p>このようにlaravelのbreezeではほとんどこちらで実装することなく、ログイン、会員登録、メール認証の機能が動くことを確認出来ました。</p><br>
        <p>デフォルトの状態でこれだけの機能が揃っているので非常に便利です。あとは必要に応じて会員登録の項目やバリデーションの追加など適宜カスタマイズして行こうと思います。</p><br>
    </div>
    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection