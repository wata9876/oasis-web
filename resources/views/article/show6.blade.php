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
        <p>今回は小説を投稿するためのAPIを作成してみました。APIの要件は以下のようになっています。</p><br>
        <p>■要件</p>
        
        <ul class="check_ul">
            <li class="check_li">・小説のタイトルと本文とジャンルを新規作成するCreate</li>
            <li class="check_li">・登録されている小説を一覧表示するRead</li>
            <li class="check_li">・選択した小説の内容を表示するShow</li>
            <li class="check_li">・投稿した小説を編集する Update</li>
            <li class="check_li">・投稿した内容を削除するDelete</li><br>
        </ul>
    
        <p>テーブルは以下のような構成になっています。</p><br>
        <p>■テーブル構成</p>
        <ul>
            <li>・タイトル</li>
            <li>・本文</li>
            <li>・カテゴリ</li>
            <li>・作成日</li>
            <li>・更新日</li>
        </ul>    
    </div>

    <h2 class="title-bottom">手順１： modelとControllerとmigrationファイルの作成</h2>
    <div class="content-bottom">
        <p>小説なのでnovelsという名前のテーブルにしました。</p><br>
        <p>Laravel8からはオプションに-mcrを付けることで一度にモデルとコントローラーとマイグレーションファイルを作成できます。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$  php artisan make:model Novel -mcr</li>
</ol></code>
<p>migrationファイル</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&nbsp;public function up()</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Schema::create('novels', function (Blueprint $table) {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;id();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;string('title');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;string('content');</li>
<li style="background-color:#EEF;">　　　　　　　　　　　　　　　　　　　　　　　　$table-&gt;string('category');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-&gt;timestamps();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>
<p>migration実行<p/>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ php artisan migrate</li>
</ol></code>
    </div>

    <h2 class="title-bottom">手順3：モデルクラスの編集</h2>
    <div class="content-bottom">
        <p>ポイント　$fillableの配列にカラムを指定することでモデルクラスから登録や更新が出来るようになります。追加するのは登録するのを許可するという意味になります。</p><br>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">class Novel extends Model</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;use HasFactory;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;// fillableに指定したプロパティは入力可能になる</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;protected  $fillable = [</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;'title',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;'content',</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;'category'</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;];</li>
<li style="background-color:#EEF;">}</li>
</ol></code></p><br>
<p>ちなみに登録させたくない場合はguardedに追加します。</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">例：</li>
<li style="background-color:#EFF;">protected $guarded = ['created_at', 'updated_at'];</li>
<li style="background-color:#EEF;">}</li>
</ol></code>
    </div>  
     
    <h2 class="title-bottom">手順4：ルーティングの設定</h2>
    <div class="content-bottom">
        <p>APIなのでroutes/api.phpに記載します。</p>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">Route::middleware(['middleware' =&gt; 'api'])-&gt;group(function () {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;Route::controller(NovelController::class)-&gt;group(function () {</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::post('/novels/create', 'create');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::get('novels', 'index');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::get('/novels/{novel}', 'show');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::patch('/novels/update/{novel}', 'update');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::delete('/novels/{novel}', 'destroy');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;});</li>
<li style="background-color:#EEF;">});</li>
</ol></code></p><br>
    </div> 

    <h2 class="title-bottom">手順5： コントローラーの編集</h2>
    <div class="content-bottom">
        <p>■ ポイント</p>
        <p>createやshowメソッドで引数にモデルクラスを指定しています。これはルーティングにIDを含めることで暗黙の結合をしています。このように書くことでfindでIDからデータを取得する手間を省くことが出来ます。</p><br>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&lt;?php</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">namespace App\Http\Controllers\Api;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">use App\Models\Novel;</li>
<li style="background-color:#EFF;">use Illuminate\Http\Request;</li>
<li style="background-color:#EEF;">use App\Http\Controllers\Controller;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">class NovelController extends Controller</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function index()</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novels = Novel::all();</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novels);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Show the form for creating a new resource.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function create(Request $request, Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;create($request-&gt;all());</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json(Novel::all());</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Store a newly created resource in storage.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \Illuminate\Http\Request  $request</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function store(Request $request)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Display the specified resource.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function show(Novel $novel)</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novel);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Show the form for editing the specified resource.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function edit(Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Update the specified resource in storage.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \Illuminate\Http\Request  $request</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function update(Request $request, Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;update($request-&gt;all());</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novel);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Remove the specified resource from storage.</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function destroy(Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;delete();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json(Novel::all());</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;">}</li>
<li style="background-color:#EFF;"></li>
</ol></code></p><br>
    </div>

    <h2 class="title-bottom">手順6： postmanで動作確認</h2>
    <div class="content-bottom">
        <p>一通り実装出来たのでpostmanを使って動作確認をしていきます。postmanはAPIをテストするのに便利なツールです。</p><br>
        <p>1 一覧表示の同作確認</p>
        <p>routes/api.php<p/>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">Route::middleware(['middleware' =&gt; 'api'])-&gt;group(function () {</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;Route::controller(NovelController::class)-&gt;group(function () {</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::post('/novels/create', 'create');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::get('novels', 'index');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::get('/novels/{novel}', 'show');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::patch('/novels/update/{novel}', 'update');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route::delete('/novels/{novel}', 'destroy');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;});</li>
<li style="background-color:#EEF;">});</li>
</ol></code><br>
<p>app/Http/Api/NovelController.php<p/>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function index()</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novels = Novel::all();</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novels);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>

<p>postmanでURLを叩いて実行。登録済のデータが返ってきたことを確認出来ました。</p>
<img src="./img/postman_novel_test.png" alt="postman">

<p>2 新規登録の同作確認</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Show the form for creating a new resource.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function create(Request $request, Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;create($request-&gt;all());</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json(Novel::all());</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EEF;"></li>
</ol></code><br>
<p>新規登録も問題なく動作確認が出来ました。</p>
<img src="./img/postman_novel_test2.png" alt="postman2">

<p>3 showメソッドの同作確認</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Display the specified resource.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function show(Novel $novel)</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novel);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>

<p>先ほど新規登録したid5を指定すると結果が問題なく返ってきています。</p>
<img src="./img/postman_novel_test3.png" alt="postman3">

<p>4 updateメソッドの同作確認</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Update the specified resource in storage.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \Illuminate\Http\Request  $request</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function update(Request $request, Novel $novel)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;update($request-&gt;all());</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json($novel);</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>

<p>先ほど新規登録したid5を更新処理テストにして実行した所、問題なく更新が実行されました。</p>
<img src="./img/postman_novel_test4.png" alt="postman4">

<p>5 destroyメソッドの同作確認</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Remove the specified resource from storage.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @param  \App\Models\Novel  $novel</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Http\Response</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;public function destroy(Novel $novel)</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$novel-&gt;delete();</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return response()-&gt;json(Novel::all());</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code><br>
<p>id5を削除するように指定したので、削除された結果が返ってきたことを確認出来ました。</p>
<img src="./img/postman_novel_test5.png" alt="postman5">

    </div>

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection