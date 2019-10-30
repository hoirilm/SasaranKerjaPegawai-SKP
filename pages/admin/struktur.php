<?php
require '../conn/koneksi.php';
require 'notif.php';
require 'reseterror.php';

if ( !isset($_SESSION["admin"]) ) {
   header("Location: ../proses/login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>Admin Struktur</title>
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

   <!-- Sweetalert Css -->
   <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

   <!-- Custom Css -->
   <link href="../../css/style.css" rel="stylesheet">

   <!-- Bootstrap Select Css -->
   <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

   <!-- JQuery DataTable Css -->
   <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

   <!-- Custom Css -->
   <link href="../../css/style.css" rel="stylesheet">

   <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
   <link href="../../css/themes/all-themes.css" rel="stylesheet" />
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

                  <form class="" action="proses-ubah.php" method="post">

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

   <!-- MODAL HAPUS JABATAN-->
   <div class="modal fade" id="modal_hapusJabatan" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content modal-col-red">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_hapusJabatan">Hapus Data</h4>
            </div>
            <div class="modal-body">
               Anda akan menghapus data jabatan. Lanjutkan menghapus?
            </div>
            <div class="modal-footer">
               <a href="#" type="button" class="btn btn-link waves-effect" id="link_hapusJabatan">Ya, Hapus</a>
               <a href="#" type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</a>
            </div>
         </div>
      </div>
   </div>
   <!-- #END# MODAL JABATAN-->

   <!-- MODAL HAPUS SEKSI-->
   <div class="modal fade" id="modal_hapusPosisijabatan" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content modal-col-red">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_hapusPosisijabatan">Hapus Data</h4>
            </div>
            <div class="modal-body">
               Anda akan menghapus data posisi jabatan. Lanjutkan menghapus?
            </div>
            <div class="modal-footer">
               <a href="#" type="button" class="btn btn-link waves-effect" id="link_hapusPosisijabatan">Ya, Hapus</a>
               <a href="#" type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</a>
            </div>
         </div>
      </div>
   </div>
   <!-- #END# MODAL HAPUS SEKSI -->

   <!-- MODAL TAMBAH JABATAN-->
   <div class="modal fade" id="modal_tambahJabatan" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_tambahJabatan">Tambah Jabatan</h4>
            </div>
            <div class="modal-body">

               <form id="form_validation" action="proses-simpan.php" method="POST">

                  <label for="jabatan">Jabatan</label>
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" id="jabatan" class="form-control" name="jabatan" placeholder="Masukkan Nama Jabatan" required>
                     </div>
                  </div>
                  <button class="btn btn-primary waves-effect" data-type="success" name="simpan_jabatan">SUBMIT</button>
               </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
         </div>
      </div>
   </div>
   <!-- #END# MODAL TAMBAH JABATAN -->

   <!-- MODAL TAMBAH POSISI JABATAN-->
   <div class="modal fade" id="modal_tambahPosisijabatan" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_tambahPosisijabatan">Tambah Posisi Jabatan</h4>
            </div>
            <div class="modal-body">

               <form id="form_validation" action="proses-simpan.php" method="POST">

                  <label for="posisijabatan">Posisi Jabatan</label>
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" id="posisijabatan" class="form-control" name="posisijabatan" placeholder="Masukkan Posisi Jabatan" required>
                     </div>
                  </div>
                  <button class="btn btn-primary waves-effect" data-type="success" name="simpan_posisijabatan">SUBMIT</button>
               </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
         </div>
      </div>
   </div>
   <!-- #END# MODAL TAMBAH SEKSI -->

   <!-- MODAL TAMBAH PANGKAT-->
   <div class="modal fade" id="modal_tambahPangkat" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_tambahPangkat">Tambah Pangkat</h4>
            </div>
            <div class="modal-body">

               <form id="form_validation" action="proses-simpan.php" method="POST">

                  <label for="pangkat">Pangkat</label>
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" id="pangkat" class="form-control" name="pangkat" placeholder="Masukkan Pangkat" required>
                     </div>
                  </div>

                  <label for="golongan">Golongan</label>
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" id="golongan" class="form-control" name="golongan" placeholder="Masukkan Golongan" required>
                     </div>
                  </div>

                  <label for="ruang">Ruang</label>
                  <div class="form-group">
                     <div class="form-line">
                        <input type="text" id="ruang" class="form-control" name="ruang" placeholder="Masukkan Ruang" required>
                     </div>
                  </div>
                  <button class="btn btn-primary waves-effect" data-type="success" name="simpan_pangkat">SUBMIT</button>
               </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
         </div>
      </div>
   </div>
   <!-- #END# MODAL TAMBAH SEKSI -->

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
               <img src="../../images/user.png" width="48" height="48" alt="User" />
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
                     <li><a href="../proses/logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- #User Info -->
         <!-- Menu -->
         <div class="menu">
            <ul class="list">
               <li class="header">MENU UTAMA</li>
               <li>
                  <a href="../../index.php">
                     <i class="material-icons">home</i>
                     <span>Home</span>
                  </a>
               </li>
               <li>
                  <a href="pengguna.php">
                     <i class="material-icons">people</i>
                     <span>Pengguna</span>
                  </a>
               </li>
               <li class="active">
                  <a href="struktur.php">
                     <i class="material-icons">layers</i>
                     <span>Struktur</span>
                  </a>
               </li>
               <li>
                  <a href="riwayat.php">
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
               &copy; 2018 <a href="javascript:void(0);">Dispenduk Bangkalan</a>.
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
            echo "<div class='alert bg-green alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data berhasil disimpan.
            </div>";
         }
         // jika alert = 2
         // tampilkan pesan Sukses "Mahasiswa berhasil diubah"
         elseif ($_GET['alert'] == 2) {
            echo "<div class='alert bg-green alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data berhasil diubah.
            </div>";
         }
         // jika alert = 3
         // tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
         elseif ($_GET['alert'] == 3) {
            echo "<div class='alert bg-green alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data berhasil dihapus.
            </div>";
         }
         // jika alert = 4
         // tampilkan pesan Gagal "Data Gagal Disimpan"
         elseif ($_GET['alert'] == 4) {
            echo "<div class='alert bg-red alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data gagal disimpan.
            </div>";
         }
         // jika alert = 5
         // tampilkan pesan Gagal "Data Gagal Diubah"
         elseif ($_GET['alert'] == 5) {
            echo "<div class='alert bg-red alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data gagal diubah.
            </div>";
         }
         // jika alert = 6
         // tampilkan pesan Gagal "Data Gagal Dihapus"
         elseif ($_GET['alert'] == 6) {
            echo "<div class='alert bg-red alert-dismissible' role='alert' style='margin: 0 10px 10px 10px;'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data gagal dihapus. Pastikan data yang akan dihapus tidak terhubung dengan pengguna.
            </div>";
         }
         ?>
         <!-- Basic Examples -->
         <div class="row clearfix js-sweetalert">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
               <div class="block-header">
                  <h2>
                     <b> Data Jabatan </b>
                  </h2>
               </div>
               <div class="card">
                  <div class="body">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                           <thead>
                              <tr>
                                 <th style="font-size:12px; width: 10%;">ID</th>
                                 <th style="font-size:12px; width: 70%;">Jabatan</th>
                              </tr>
                           </thead>
                           <tbody>

                              <?php
                              $statement = $koneksi -> query("SELECT * FROM JABATAN");
                              while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                                 $jabatan[] = $row;
                              }
                              ?>

                              <?php foreach ($jabatan as $key) { ?>

                                 <tr>
                                    <td style="font-size:12px;"><?= $key['ID_JABATAN'] ?></td>
                                    <td style="font-size:12px;"><?= $key['JABATAN'] ?></td>
                                 </tr>

                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
               <div class="block-header">
                  <h2>
                     <b> Data Posisi Jabatan </b>
                  </h2>
               </div>
               <div class="card">
                  <div class="body">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                           <thead>
                              <tr>
                                 <th style="font-size:12px;">ID</th>
                                 <th style="font-size:12px;">Posisi Jabatan</th>
                              </tr>
                           </thead>
                           <tbody>

                              <?php
                              $statement = $koneksi -> query("SELECT * FROM POSISI_JABATAN");
                              while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                                 $posisijabatan[] = $row;
                              }
                              ?>

                              <?php foreach ($posisijabatan as $key) { ?>

                                 <tr>
                                    <td style="font-size:12px;"><?= $key['ID_POSISI_JABATAN'] ?></td>
                                    <td style="font-size:12px;"><?= $key['POSISI_JABATAN'] ?></td>
                                 </tr>

                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- #END# Basic Examples -->

         <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
            <div class="block-header">
               <h2>
                  <b> Data Pangkat </b>
               </h2>
            </div>
            <div class="card">
               <div class="body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                           <tr>
                              <th style="font-size:12px;">ID</th>
                              <th style="font-size:12px;">Pangkat</th>
                              <th style="font-size:12px;">Golongan</th>
                              <th style="font-size:12px;">Ruang</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php
                           $statement = $koneksi -> query("SELECT * FROM PANGKAT");
                           while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                              $pangkat[] = $row;
                           }
                           ?>

                           <?php foreach ($pangkat as $key) { ?>

                              <tr>
                                 <td style="font-size:12px;"><?= $key['ID_PANGKAT'] ?></td>
                                 <td style="font-size:12px;"><?= $key['JENIS_PANGKAT'] ?></td>
                                 <td style="font-size:12px;"><?= $key['GOLONGAN'] ?></td>
                                 <td style="font-size:12px;"><?= $key['RUANG'] ?></td>
                              </tr>

                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- #END# Basic Examples -->
   </div>
</section>



<!-- Jquery Core Js -->
<script src="../../plugins/jquery/jquery.min.js"></script>



<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="../../plugins/sweetalert/sweetalert.min.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>
<script src="../../js/pages/tables/jquery-datatable.js"></script>
<script src="../../js/pages/ui/dialogs.js"></script>

<!-- Demo Js -->
<script src="../js/demo.js"></script>
</body>

</html>
