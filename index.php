<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Login Gudang</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
</head>

<body>
  <form class="form-signin" method="POST" action="cek_login.php">
    <div class="text-center mb-4">
      <h1 class="h1 mb-3 font-weight-normal">LOGIN</h1>
      <p>Masukkan Username dan Password anda dengan Benar!</p>
    </div>

    <div class="form-label-group">
      <input type="text" class="form-control" name="username" placeholder="Masukkan Username Anda!" required autofocus>
      <label>Masukkan Username Anda!</label>
    </div>

    <div class="form-label-group">
      <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda!" required>
      <label>Masukkan Password Anda!</label>
    </div>

    <div class="form-label-group">
      <select class="form-control" name="level">
        <option value="Pegawai">Pegawai</option>
        <option value="Administrator">Administrator</option>
      </select>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; Rihan-<?= date('Y') ?></p>
  </form>
</body>

</html>