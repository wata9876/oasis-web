<html>
<head>
  <title>管理者ログイン</title>
</head>
<body>

  <h1>管理者ログイン</h1>

  @error('login')
  <p>{{ $message }}</p>
  @enderror

  <form method="POST" action="/admin/login">
    @csrf
    <label>メールアドレス</label>
    <input type="email" name="email"><br>
    <label>パスワード</label>
    <input type="password" name="password"><br>
    <button type="submit">ログイン</button>
  </form>

</body>
</html>