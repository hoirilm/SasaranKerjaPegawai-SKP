<?php

require '../conn/koneksi.php';

if ( isset($_SESSION["admin"]) ) {
  header("Location: ../../index.php");
  die;
}

if ( isset($_SESSION["kabid"]) ) {
  header("Location: ../../index2.php");
  die;
}

if ( isset($_SESSION["kasi"]) ) {
  header("Location: ../../index3.php");
  die;
}

if ( isset($_SESSION["staf"]) ) {
  header("Location: ../../index4.php");
  die;
}

if ( isset($_SESSION["kadis"]) ) {
  header("Location: ../../index5.php");
  die;
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Sign In | Dispenduk Bangkalan</title>
  <!-- Favicon-->
  <link rel="icon" href="../../favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="../../googleicon.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="../../css/style.css" rel="stylesheet">
</head>

<body class="login-page">
  <div class="login-box">
    <div class="logo">
      <a href="javascript:void(0);"><img src="../../images/logo2.png" alt="" style="Width:130px"></a>
      <a href="javascript:void(0);">Dispenduk <b>Bangkalan</b></a>
      <small>Dinas Kependudukan & Pencatatan Sipil Daerah Bangkalan</small>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" method="POST">
          <div class="msg">Sign in untuk memulai sesi</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control" name="nip" placeholder="Nip" required autofocus>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button class="btn btn-block bg-cyan waves-effect" type="submit" name="masuk">MASUK</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Jquery Core Js -->
  <script src="../../plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="../../plugins/node-waves/waves.js"></script>

  <!-- Validation Plugin Js -->
  <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

  <!-- Custom Js -->
  <script src="../../js/admin.js"></script>
  <script src="../../js/pages/examples/sign-in.js"></script>
</body>

</html>
