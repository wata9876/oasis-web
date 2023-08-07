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
        <p>laravelではメールファサードを使用してメールを送信出来ますが、Mailableクラスを使用して送信元やテンプレートなどをkeyごとにわかりやすく設定することが出来ます。</p><br>
        <p></p>
    </div>

    <h2 class="title-bottom">手順１： Mailableクラスの作成</h2>
    <div class="content-bottom">
        <p>まずは以下のコマンドでMailableクラスを作成します。</p><br>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>$ php artisan make:mail FormAdminSendmail</li>
</ol></code></p><br>
    </div>

    <h2 class="title-bottom">手順2：Mailableクラスの編集</h2>
    <div class="content-bottom">
        <p>まず、onstructの引数に【public array $form_data】を追加します。ここに書くことで入力フォームから受け取ったパラメータを次に遷移させるブレードに渡すことが出来ます。</p><br>
        <p>envelopeメソッドでは送信元の情報を設定します。【config('mail.email_admin');】の記述でenvファイルに設定した管理者のメールアドレスをconfigファイルを介して取得しています。</p>
        <p>subjectのkeyには送信元から送信する際のメールタイトルを追加します。わかりやすいように自動送信メールとしました。</P>
        <p><code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&lt;?php</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">namespace App\Mail;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">use Illuminate\Bus\Queueable;</li>
<li style="background-color:#EFF;">use Illuminate\Contracts\Queue\ShouldQueue;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailable;</li>
<li style="background-color:#EFF;">use Illuminate\Mail\Mailables\Content;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailables\Envelope;</li>
<li style="background-color:#EFF;">use Illuminate\Queue\SerializesModels;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailables\Address;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">class FormAdminMail extends Mailable</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;use Queueable, SerializesModels;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Create a new message instance.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return void</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function __construct(public array $form_data)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the message envelope.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Mail\Mailables\Envelope</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function envelope()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$email_admin = config('mail.email_admin');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return new Envelope(</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;from: new Address($email_admin, 'k.watanabe'),</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subject: '自動送信メール',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the message content definition.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Mail\Mailables\Content</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function content()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return new Content(</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;view: 'mail.admin',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the attachments for the message.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return array</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function attachments()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return [];</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;">}</li>
<li style="background-color:#EEF;"></li>
</ol></code></p><br>
<p>contentメソッドのviewのkeyはテンプレートとして使用したい管理者用のbladeファイルを追加します。お問い合わせがあった場合に管理者に送信する際のメールのテンプレートを記述することになります。</p>
<br>
<p>管理者用に送る際のメールテンプレート</p>
<p>views/mail/admin.blade.php</p>

<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;"> 様より下記の内容のお問い合わせがありました</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">==============================</li>
<li style="background-color:#EFF;">お問い合わせ内容</li>
<li style="background-color:#EEF;">==============================</li>
<li style="background-color:#EFF;">■お名前:</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">■メールアドレス:</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">■お問い合わせ内容:</li>
<li style="background-color:#EEF;"></li>
</ol></code>

<p>ユーザーと管理者でメールのテンプレートを分けたい場合はユーザー用のMailableクラスを作成します。(テンプレートを共通で使いたい場合は不要。)
</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#000;color:#FFF;">
<li>php artisan make:mail FormUserSendmail</li>
</ol></code>
<p>app/Mail/FormUserMail.php</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&lt;?php</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">namespace App\Mail;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">use Illuminate\Bus\Queueable;</li>
<li style="background-color:#EFF;">use Illuminate\Contracts\Queue\ShouldQueue;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailable;</li>
<li style="background-color:#EFF;">use Illuminate\Mail\Mailables\Content;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailables\Envelope;</li>
<li style="background-color:#EFF;">use Illuminate\Queue\SerializesModels;</li>
<li style="background-color:#EEF;">use Illuminate\Mail\Mailables\Address;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">class FormUserMail extends Mailable</li>
<li style="background-color:#EFF;">{</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;use Queueable, SerializesModels;</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Create a new message instance.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return void</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function __construct(public array $form_data)</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the message envelope.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Mail\Mailables\Envelope</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function envelope()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$email_admin = config('mail.email_admin');</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$from    = new Address($email_admin, 'フォームAPP');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$subject = '【フォームAPP】お問合せ有難うございます';</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return new Envelope(</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;from: $from,</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subject: $subject,</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the message content definition.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return \Illuminate\Mail\Mailables\Content</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function content()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return new Content(</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;view: 'mail.user',</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Get the attachments for the message.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* @return array</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function attachments()</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return [];</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
<li style="background-color:#EFF;">}</li>
<li style="background-color:#EEF;"></li>
</ol></code>

<p>Views/mail/user.blade.php</p>
<code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">こちらの内容で受け付けました。</li>
<li style="background-color:#EFF;"></li>
<li style="background-color:#EEF;">==============================&lt;br&gt;</li>
<li style="background-color:#EFF;">お問い合わせ内容&lt;br&gt;</li>
<li style="background-color:#EEF;">==============================&lt;br&gt;</li>
<li style="background-color:#EFF;">■お名前:</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">■メールアドレス:</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">■お問い合わせ内容:</li>
<li style="background-color:#EEF;"></li>
</ol></code>
    </div>  
     
    <h2 class="title-bottom">手順3： コントローラー側でメール送信するロジックを追加
    </h2>
    <div class="content-bottom">
        <p>メール送信する流れとしては、入力ページで入力した後、確認ページへ遷移し、確認ページから送信ボタンを押すと、MailController.phpのsendメソッドが呼び出されます。</p>
        <p>MailRequestでバリデーションが通れば、envファイルに定義している管理者用のメールアドレスをconfigから取得し、管理者宛メールの送り先にセットします。</p>
        <p>メールファサードのsendメソッドを使用してメール送信しています。</p>
        <p>第1引数に、テンプレートファイルのパスを指定し、第二引数に送信したい中身（フォームから受け取ったパラメータ）をセットしてメール送信しています。<p/>
        <p>Controllers/MailController.php</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">&nbsp;/**</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Display the login view.</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;public function send(MailRequest $request): View</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;{</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$form_data = $request-&gt;validated();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$email_admin = config('mail.email_admin');</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$email_user  = $form_data['email'];</li>
<li style="background-color:#EEF;"></li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// 管理者宛メール</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mail::to($email_admin)-&gt;send( new FormAdminMail($form_data) );</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// ユーザー宛メール</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mail::to($email_user)-&gt;send( new FormUserMail($form_data) );</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// 二重送信対策のためトークンを再発行</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$request-&gt;session()-&gt;regenerateToken();</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
<li style="background-color:#EFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return view('mail.conmplete', ['contents' =&gt; $form_data]);</li>
<li style="background-color:#EEF;">&nbsp;&nbsp;&nbsp;&nbsp;}</li>
</ol></code>
        <p>あとは二重送信されないための処理を追加し、完了ページへ遷移させます。</p><br>
    </div>
    <h2 class="title-bottom">その他１： サクラサーバーで設定したメールと連携する。</h2>
    <div class="content-bottom">
        <p>サクラサーバーの管理画面にログインし、メール一覧から作成ボタンを押してメールアカウントを作成する。</p><br>
        <p>envファイルに以下のように設定する。</p><br>
        <code>
<ol style="list-style:decimal-leading-zero outside;in-left:0;padding-left:36px;margin:0;background-color:#EEF;color:#000;">
<li style="background-color:#EEF;">MAIL_MAILER=smtp</li>
<li style="background-color:#EFF;">MAIL_HOST=サクラサーバーのホスト名</li>
<li style="background-color:#EEF;">MAIL_PORT=587</li>
<li style="background-color:#EFF;">MAIL_USERNAME=サクラサーバーの管理画面から作成したメールアドレス</li>
<li style="background-color:#EEF;">MAIL_PASSWORD="サクラサーバーで設定した”パスワード</li>
<li style="background-color:#EFF;">MAIL_ENCRYPTION=tls</li>
<li style="background-color:#EEF;">MAIL_FROM_ADDRESS=サクラサーバーの管理画面から作成したメールアドレス</li>
<li style="background-color:#EFF;">MAIL_FROM_NAME="${APP_NAME}"</li>
<li style="background-color:#EEF;"></li>
</ol></code>
<p>これでお問い合わせフォームから入力した内容がサクラサーバーで設定したメールアドレス宛に送信出来るようになります。</p>
    </div>
    

    <p>参考記事：<a href="https://tech.amefure.com/php-laravel-contactform" rel="nofollow noopener" target="_blank">【超解説】Laravelでお問い合わせフォーム作成！Gmailで連携するには？</a></p>

    <a href="{{ route('article') }}">記事一覧に戻る</a><br><br>
    <a href="{{ route('profile') }}">プロフィールに戻る</a> 
    @endsection