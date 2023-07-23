@extends('layouts.my_app')

@section('title')
    <title>{{config('app.name')}}</title>
@endsection
@section('content')
    <img src="./img/top-image.jpg" alt="top-image.jpg">

    <main id="top">
        <h2>ようこそ、ポートフォリオへ</h2>
        <p>
            当サイトでは私の作品を掲載しています。<br>
            仕事のご依頼や当サイトに関するお問い合わせは<a href="#" class="contact-btn">contact</a>よりご連絡ください。
        </p>
    </main>
@endsection