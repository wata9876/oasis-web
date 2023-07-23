<html>
<head>
  <title>管理画面トップ</title>
</head>
<body>
  <h1>管理画面トップ</h1>

  @if (session('login_msg'))
  <p>{{ session('login_msg') }}</p>
  @endif

  @if (Auth::guard('admins')->check())
  <div>ユーザーID {{ Auth::guard('admins')->user()->userid }}でログイン中</div>
  @endif

  <ul id="blog-menu">

       <li><a href="{{ route('admin.create') }}" class="btn">新規投稿</a></li>
   </ul>

  <ul>
    <li>管理者（Administrator）ログインユーザーID: {{ Auth::guard('admins')->check() }}</li>
  </ul>

  <div>
    <a href="/admin/logout">ログアウト</a>
  </div>
</body>
</html>