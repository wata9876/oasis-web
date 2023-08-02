<html>
<head>
  <title>ユーザーログイン</title>
</head>
<body>

  <h1>ユーザーログイン</h1>

  @error('login')
  <p>{{ $message }}</p>
  @enderror

  <form method="POST" action="{{ route('admin.login.login')}}">
    @csrf
    <label>メールアドレス</label>
    <input type="email" name="email"><br>
    <label>パスワード</label>
    <input type="password" name="password"><br>
    <button type="submit">ログイン</button>
  </form>

</body>
</html>