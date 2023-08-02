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
        <p>記事を登録するための管理画面を作成しました。マルチ認証についての内容もまとめてみました。</p><br>
        <p>参考記事：<a href="https://labo.kon-ruri.co.jp/laravel9-multi-authentication/" rel="nofollow noopener" target="_blank">Laravel9でマルチ認証（一般ユーザーと管理者で別々のログイン機能）を実装する</a></p>
    </div>

    <h2 class="title-bottom">マルチ認証とは</h2>
    <div class="content-bottom">
        <p>例えばECサイトでは商品や顧客情報などを管理する管理画面の他に、ユーザーの方でも会員登録をする際に認証機能が必要な場合がほとんどだと思います。<br><br>この場合は管理画面のログインとユーザーのログインで二つの認証機能が必要になります。<br><br>このように、ログイン機能を複数設けることがマルチ認証です。管理者を登録するためのAdminモデルと、一般ユーザーを登録するためのuserモデルでそれぞれテーブルを用意し、認証を持たせて管理することが出来ます。</p><br>
        <p></p>
    </div>

    <h2 class="title-bottom">手順１：　管理画面を作るのに必要なファイルを作成</h2>
    <div class="content-bottom">
        <p>このコマンドだけでModelとControllerとmigrationファイルを一度に作成出来ます。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>php artisan make:model Admin -mcr</li>
</ol></code>
        <p></p>
    </div>

    <h2 class="title-bottom">手順2：　マイグレーションファイルを編集する</h2>
    <div class="content-bottom">
        <p>管理者を登録するAdminテーブルを作成するためにマイグレーションファイルを以下のように編集します。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&lt;?php</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">use Illuminate\Database\Migrations\Migration;</li>
<li style="background-color:#EFF;">use Illuminate\Database\Schema\Blueprint;</li>
<li style="background-color:#EEF;">use Illuminate\Support\Facades\Schema;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">return new class extends Migration</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Run the migrations.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function up(): void</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Schema::create('admins', function (Blueprint $table) {</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;id();</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;string('email')-&gt;unique();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;string('password');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;rememberToken();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;timestamps();</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Reverse the migrations.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function down(): void</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Schema::dropIfExists('admins');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;">};</li>
<li style="background-color:#EEF;"></li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順２　モデルクラスの作成</h2>
    <div class="content-bottom">
        <p>マイグレーションを実行し、Adminモデルクラスを作成する</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ php artisan migrate</li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順３　モデルクラスを認証用に編集する</h2>
    <div class="content-bottom">
        <p>認証するためにAuthenticatableクラスを継承する。デフォルトではクラス名のextendsの箇所がModelとなっているので、ModelをAuthenticatableに変える。useすることも忘れずに。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&lt;?php</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">namespace App\Models;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">use Illuminate\Database\Eloquent\Factories\HasFactory;</li>
<li style="background-color:#EFF;">use Illuminate\Database\Eloquent\Model;</li>
<li style="background-color:#EEF;">use Illuminate\Foundation\Auth\User as Authenticatable;</li>
<li style="background-color:#EFF;">use Laravel\Sanctum\HasApiTokens;</li>
<li style="background-color:#EEF;">use Illuminate\Notifications\Notifiable;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">class Admin extends Authenticatable</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;use HasApiTokens, HasFactory, Notifiable;</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;protected $fillable = [</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'url'</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;];</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;protected $hidden = [</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;'password',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;'remember_token',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;];</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;protected $casts = [</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'email_verified_at' =&gt; 'datetime',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;];</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
<li style="background-color:#EFF;">}</li>
<li style="background-color:#EEF;"></li>
</ol></code>
<p>この一文を追加する。
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>use Illuminate\Foundation\Auth\User as Authenticatable;</li>
</ol></code>

<p>編集前：　デフォルトの状態</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>class Admin extends Model</li>
<li>{</li>
</ol></code>

<p>編集後　ModelをAuthenticatableに変更</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>class Admin extends Authenticatable</li>
<li>{</li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順3　ログインページの作成</h2>
    <div class="content-bottom">
        <p>マルチ認証を実装するために管理ユーザー用とユーザー用の二つのログインページを用意します。簡素なので、後でAdminLTEやBreezeなどでデザインも工夫しようと思います。<p/>
        <div>
            <img src="./img/admin_login.png" alt="管理画面ログイン">
            <img src="./img/user_login.png" alt="ユーザーログイン">
        </div>
    </div>
    
    <p>ルーティングはこのように管理者はadmin、ユーザーはauthで分けています。</p>
    <p>route/admin.php</p>
    <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>Route::prefix('admin')-&gt;group(function () {</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;Route::get('login', [LoginController::class, 'index'])-&gt;name('admin.login.index');</li>
</ol></code><br>

<p>route/auth.php</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>Route::middleware('guest')-&gt;group(function () {</li>
<li></li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;Route::get('login', [AuthenticatedSessionController::class, 'create'])</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt;name('login');</li>
</ol></code><br>

    <h2 class="title-bottom">手順４　コンフィグファイルの「ガード」と「プロバイダ」の設定</h2>
    <div class="content-bottom">
        <p>マルチ認証するために、コンフィグでガードを設定します。ここがマルチ認証で重要な部分になります。</p><br>
        <p>config/auth.php</p>

        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
                <li style="background-color:#EEF;">'providers' =&gt; [</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'users' =&gt; [</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'eloquent',</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'model' =&gt; App\Models\User::class,</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'admins' =&gt; [</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'eloquent',</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'model' =&gt; App\Models\Admin::class,</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;"></li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'members' =&gt; [</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'eloquent',</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'model' =&gt; App\Models\User::class,</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;"></li>
            </ol>
        </code>
        <p>adminsのkeyの場合は、Adminモデルを使って認証し、membersの場合はUserモデルを使って認証させるようにしています。</p>
        <code>
            <ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
                <li style="background-color:#EEF;">'guards' =&gt; [</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'web' =&gt; [</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'session',</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'provider' =&gt; 'users',</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'members' =&gt; [</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'session',</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'provider' =&gt; 'users',</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'admins' =&gt; [</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'driver' =&gt; 'session',</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'provider' =&gt; 'admins',</li>
                <li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;],</li>
                <li style="background-color:#EEF;"></li>
            </ol>
        </code>
        <p>guardsは後述しますが、認証するために使うkeyとなります。ここでproviderがadminの場合は上述したadminモデルを使って認証するという意味です。</p>
    </div>

    <h2 class="title-bottom">手順５　コントローラー側で認証を制御する</h2>
    <div class="content-bottom">
        <p>コントローラー側で管理者とユーザーでそれぞれ認証をチェックする処理を記述します。</p><br>
        <p>Controllers/Admin/LoginController.php</p>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">//ログイン処理</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;public function login(Request $request)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;$credentials = $request-&gt;only(['email', 'password']);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;//ユーザー情報が見つかったらログイン</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;if (Auth::guard('admins')-&gt;attempt($credentials)) {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//ログイン後に表示するページにリダイレクト</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return redirect()-&gt;route('admin.dashboard')-&gt;with([</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'login_msg' =&gt; 'ログインしました。',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;//ログインできなかったときに元のページに戻る</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;return back()-&gt;withErrors([</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'login' =&gt; ['ログインに失敗しました'],</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;]);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;}</li>
</ol></code>

    <p>7行目のguardの記述でログインページで入力したメールアドレスとパスワードがAdminモデルを介してテーブルに登録されているかどうかをチェックしています。</p>
    <p>ユーザーの場合も先ほどconfigに定義したmembersをユーザー用のコントローラーにguardで指定すれば、Userモデルに対して認証のチェックを行えます。<p/>
    <p>ユーザーの場合はmembers、管理者の認証の場合はadminsを指定するだけですね。このやり方を応用すれば他のモデルクラスでも認証チェックが出来るようになります。そういった使い方がマルチ認証です。<p/>
    <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>if (Auth::guard('members')-&gt;attempt($credentials)) {</li>
</ol></code>
    <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>if (Auth::guard('admins')-&gt;attempt($credentials)) {</li>
</ol></code>
    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection