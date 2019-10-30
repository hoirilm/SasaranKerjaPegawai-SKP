<?php
require 'pages/conn/koneksi.php';
require 'pages/admin/notif.php';
require 'pages/admin/reseterror.php';

if ( !isset($_SESSION["admin"]) ) {
  header("Location: pages/proses/login.php");
  die;
}

if (isset($_POST["aktif"])){
  $statement = $koneksi -> prepare("UPDATE MASA_SKP SET ID_STATUS = :ID_STATUS WHERE ID = 1");
  $statement -> bindValue(':ID_STATUS', 5);
  $statement -> execute();
}

if (isset($_POST["nonaktif"])){
  $statement = $koneksi -> prepare("UPDATE MASA_SKP SET ID_STATUS = :ID_STATUS WHERE ID = 1");
  $statement -> bindValue(':ID_STATUS', 6);
  $statement -> execute();
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Admin - Home</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="googleicon.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Custom Css -->
  <link href="css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-indigo">

  <!-- MODAL DETAIL ADMIN-->
  <div class="modal fade" id="modal_profile_admin" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_lihat">Profile</h4>
        </div>
        <div class="modal-body">

          <?php

          $user = $_SESSION['useradmin'];
          $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$user'");
          while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $admin[] = $row;
          }

          ?>

          <!-- Striped Rows -->
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

              <div class="body table-responsive">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td style="font-weight: bold">Nama</td>
                      <td><?= $admin[0]["NAMA_ADMIN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Username</td>
                      <td><?= $admin[0]["USERNAME_ADMIN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Email</td>
                      <td><?= $admin[0]["EMAIL_ADMIN"] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- #END# Striped Rows -->


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>

  </div>
  <!-- #END# MODAL -->

  <!-- MODAL UBAH PASS -->
  <div class="modal fade" id="modal_ubah_password" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_ubah_password">Ganti Password</h4>
        </div>
        <div class="modal-body">

          <form class="" action="pages/admin/proses-ubah.php" method="post">

            <div class="form-group">
              <div class="form-line">
                <input type="password" class="form-control" name="passLama" placeholder="Password saat ini" required>
              </div>
            </div>

            <div class="form-group">
              <div class="form-line">
                <input type="password" class="form-control" name="passBaru" placeholder="Password baru" required>
              </div>
            </div>

            <div class="form-group">
              <div class="form-line">
                <input type="password" class="form-control" name="confirmPassBaru" placeholder="Konfirmasi password baru" required>
              </div>
            </div>

            <button class="btn btn-primary waves-effect" name="gantiPass">Simpan Perubahan</button>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
  <!-- #END# MODAL -->


  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->
  <!-- Search Bar -->
  <div class="search-bar">
    <div class="search-icon">
      <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
      <i class="material-icons">close</i>
    </div>
  </div>
  <!-- #END# Search Bar -->
  <!-- Top Bar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="javascript:void(0);">Dispenduk Bangkalan</a>
      </div>
    </div>
  </nav>
  <!-- #Top Bar -->
  <section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
        <div class="image">
          <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">

          <?php
          $user = $_SESSION['useradmin'];
          $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$user'");
          while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $admin[] = $row;
          }
          ?>

          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $admin[0]["NAMA_ADMIN"] ?></div>
          <div class="email"><?= $admin[0]["EMAIL_ADMIN"] ?></div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="#" data-toggle="modal" data-target="#modal_profile_admin"><i class="material-icons">person</i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li><a href="#" data-toggle="modal" data-target="#modal_ubah_password"><i class="material-icons">lock</i>Ganti Password</a></li>
              <li role="seperator" class="divider"></li>
              <li><a href="pages/proses/logout.php"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">
        <ul class="list">
          <li class="header">MENU UTAMA</li>
          <li class="active">
            <a href="index.php">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="pages/admin/pengguna.php">
              <i class="material-icons">people</i>
              <span>Pengguna</span>
            </a>
          </li>
          <li>
            <a href="pages/admin/struktur.php">
              <i class="material-icons">layers</i>
              <span>Struktur</span>
            </a>
          </li>
          <li>
            <a href="pages/admin/riwayat.php">
              <i class="material-icons">history</i>
              <span>Riwayat</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
        <div class="copyright">
          <a href="javascript:void(0);">Dispenduk Bangkalan</a>.
        </div>
      </div>
      <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
  </section>

  <section class="content">
    <div class="container-fluid">

      <?php
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      }
      // jika alert = 1
      // tampilkan pesan Sukses "Mahasiswa baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert bg-green alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data pengguna berhasil disimpan.
        </div>";
      }


      // jika alert = 2
      // tampilkan pesan Sukses "Mahasiswa berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert bg-green alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data pengguna berhasil diubah.
        </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert bg-green alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data pengguna berhasil dihapus.
        </div>";
      }
      // jika alert = 4
      // tampilkan pesan Gagal "Data Gagal Disimpan"
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert bg-red alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data gagal disimpan.<br><br>

        <p style='font-size: 12px; padding:0;'>$errorEditPass</p>
        <p style='font-size: 12px; padding:0;'>$errorEditPassLen</p>
        <p style='font-size: 12px; padding:0;'>$errorEditPassLama</p>
        </div>";
      }
      ?>

      <!-- Colorful Panel Items With Icon -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Selamat Datang Di Halaman Admin, <strong><?= $admin[0]["NAMA_ADMIN"] ?></strong>
            </h2>
          </div>
          <div class="body">
            <div class="row clearfix">
              <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">


                  <div class="panel panel-col-blue-grey">
                    <div class="panel-heading" role="tab" id="headingOne_17">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17">
                          <i class="material-icons">lock_outline</i> Masa SKP
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne_17" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
                      <div class="panel-body">

                        <!-- TOMBOL AKTIF/NONAKTIF PERIODE SKP -->
                        <?php
                        $statement = $koneksi -> query("SELECT * FROM MASA_SKP");
                        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                          $mulaiskp[] = $row;
                        }
                        ?>

                        <form class="" action="index.php" method="post" style="display: inline">
                          <?php if ($mulaiskp[0]["ID_STATUS"] == 5){ ?>
                            <button type="submit" class="btn btn-info waves-effect" name="nonaktif">
                              <i class="material-icons">lock_open</i>
                              <span>TUTUP PERIODE SKP</span>
                            </button>
                            <p style="float:right; margin-top: 8px; font-size: 13px; color:#4CAF50">Status masa SKP : Aktif</p>

                          <?php }else if ($mulaiskp[0]["ID_STATUS"] == 6){ ?>
                            <button type="submit" class="btn btn-grey waves-effect" name="aktif">
                              <i class="material-icons">lock</i>
                              <span>BUKA PERIODE SKP</span>
                            </button>
                            <p style="float:right; margin-top: 8px; font-size: 13px; color:#EF5350">Status masa SKP : Tidak Aktif</p>
                          <?php } ?>
                        </form>

                      </div>
                    </div>
                  </div>


                  <div class="panel panel-col-blue-grey">
                    <div class="panel-heading" role="tab" id="headingTwo_17">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false"
                        aria-controls="collapseTwo_17">
                        <i class="material-icons">public</i> Visi dan Misi
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_17">
                    <div class="panel-body" style="padding:3% 20% 3% 20%">
                      <img src="images/logo2.png" alt="" style="Width:150px; display:block; margin:-5% auto 5% auto">
                      <p style="font-weight:bold; font-size:20px; text-align:center">Visi</p>
                      <p style="text-align:center; font-size:13px">Terwujudnya Tertib Administrasi Kependudukan Dalam Rangka Meningkatkan Kualitas Pelayanan Publik Untuk Mendukung Kinerja Pemerintah Yang Akuntable.</p><br>

                      <p style="font-weight:bold; font-size:20px; text-align:center">Misi</p>
                      <p style="text-align:center; font-size:13px">Melaksanakan Tertib Administrasi Kependudukan dan Meningkatkan Kualitas Pelayanan Publik</p>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Colorful Panel Items With Icon -->


  </div>
</section>

<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="js/demo.js"></script>
</body>

</html>
