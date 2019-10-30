<?php
require '../conn/koneksi.php';
require 'notif.php';
require 'reset-error.php';


if ( !isset($_SESSION["kabid"]) ) {
   header("Location: ../proses/login.php");
   die;
}



// INFO KABID
$nip = $_SESSION['userkabid'];
$sql = "SELECT * FROM user
INNER JOIN pangkat ON user.ID_PANGKAT = pangkat.ID_PANGKAT
INNER JOIN jabatan ON user.ID_JABATAN = jabatan.ID_JABATAN
INNER JOIN posisi_jabatan ON user.ID_POSISI_JABATAN = posisi_jabatan.ID_POSISI_JABATAN
WHERE user.NIP = :NIP";

$statement = $koneksi -> prepare ($sql);
$statement -> bindValue(':NIP', $nip);
$statement -> execute();
$kabid = $statement -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>Kabid - Realisasi</title>
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

   <!-- MODAL PROFILE KABID -->
   <div class="modal fade" id="modal_profile_kabid" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modal_lihat">Profile</h4>
            </div>
            <div class="modal-body">


               <!-- Striped Rows -->
               <div class="row clearfix">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

                     <div class="body table-responsive">
                        <table class="table table-hover">
                           <tbody>
                              <tr>
                                 <td style="font-weight: bold">NIP</td>
                                 <td><?= $kabid["NIP"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Jabatan</td>
                                 <td><?= $kabid["JABATAN"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Posisi Jabatan</td>
                                 <td><?= $kabid["POSISI_JABATAN"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Nama</td>
                                 <td><?= $kabid["NAMA"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Pangkat/Gol-Ruang</td>
                                 <td><?= $kabid['JENIS_PANGKAT'] . " (" . $kabid['GOLONGAN'] . "/" . $kabid['RUANG'] . ")" ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Unit Kerja</td>
                                 <td><?= $kabid["UNIT_KERJA"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Username</td>
                                 <td><?= $kabid["USERNAME"] ?></td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold">Email</td>
                                 <td><?= $kabid["EMAIL"] ?></td>
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

   <!-- MODAL REALISASI-->
   <div class="modal fade" id="modal_realisasi" tabindex="-1" role="dialog">

   </div>
   <!-- #END# MODAL -->

   <!-- MODAL DETAIL-->
   <div class="modal fade" id="modal_detailRealisasi" tabindex="-1" role="dialog">

   </div>
   <!-- #END# MODAL -->

   <!-- MODAL UBAH-->
   <div class="modal fade" id="modal_ubahRealisasi" tabindex="-1" role="dialog">

   </div>
   <!-- #END# MODAL -->

   <!-- MODAL NILAI KERJA -->
   <div class="modal fade" id="modal_nilaiKerja" tabindex="-1" role="dialog">

   </div>
   <!-- MODAL NILAI KERJA -->

   <!-- MODAL DETAIL-->
   <div class="modal fade" id="modal_detailNilaiKerja" tabindex="-1" role="dialog">

   </div>
   <!-- #END# MODAL -->

   <!-- MODAL UBAH-->
   <div class="modal fade" id="modal_ubahNilaiKerja" tabindex="-1" role="dialog">

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
               <img src="../../images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">

               <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $kabid["NAMA"] ?></div>
               <div class="email"><?= $kabid["EMAIL"] ?></div>
               <div class="btn-group user-helper-dropdown">
                  <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                  <ul class="dropdown-menu pull-right">
                     <li><a href="#" data-toggle="modal" data-target="#modal_profile_kabid"><i class="material-icons">person</i>Profile</a></li>
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
                  <a href="../../index2.php">
                     <i class="material-icons">home</i>
                     <span>Home</span>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="menu-toggle">
                     <i class="material-icons">view_list</i>
                     <span>SKP</span>
                  </a>
                  <ul class="ml-menu">
                     <li>
                        <a href="skp-kasi.php">SKP - Kepala Seksi</a>
                     </li>
                  </ul>
               </li>
               <li class="active">
                  <a href="javascript:void(0);" class="menu-toggle">
                     <i class="material-icons">assignment</i>
                     <span>Realisasi</span>
                  </a>
                  <ul class="ml-menu">
                     <li class="active">
                        <a href="realisasi.php">Realisasi - Kepala Seksi</a>
                     </li>
                  </ul>
               </li>
               <li>
                 <a href="javascript:void(0);" class="menu-toggle">
                   <i class="material-icons">archive</i>
                   <span>Arsip</span>
                 </a>
                 <ul class="ml-menu">
                   <li>
                     <a href="arsip-kasi.php">Arsip - Kasi</a>
                   </li>
                 </ul>
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
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Realisasi berhasil dibuat.
            </div>";
         }
         // jika alert = 2
         // tampilkan pesan Sukses "Mahasiswa berhasil diubah"
         elseif ($_GET['alert'] == 2) {
            echo "<div class='alert bg-green alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Realisasi berhasil diubah.
            </div>";
         }
         // jika alert = 3
         // tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
         elseif ($_GET['alert'] == 3) {
            echo "<div class='alert bg-green alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Realisasi berhasil dihapus.
            </div>";
         }
         // jika alert = 4
         // tampilkan pesan Gagal "Data Gagal Disimpan"
         elseif ($_GET['alert'] == 4) {
            echo "<div class='alert bg-red alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data Realisasi gagal dibuat.<br><br>

            <p style='font-size: 12px; padding:0;'>$notifKuant</p>
            <p style='font-size: 12px; padding:0;'>$notifKual</p>
            <p style='font-size: 12px; padding:0;'>$notifWaktu</p>

            <p style='font-size: 12px; padding:0;'>$notifKuantRealisasi</p>
            <p style='font-size: 12px; padding:0;'>$notifKualRealisasi</p>
            <p style='font-size: 12px; padding:0;'>$notifWaktuRealisasi</p>

            <p style='font-size: 12px; padding:0;'>$notifOrientasi</p>
            <p style='font-size: 12px; padding:0;'>$notifIntegritas</p>
            <p style='font-size: 12px; padding:0;'>$notifKomitmen</p>
            <p style='font-size: 12px; padding:0;'>$notifDisiplin</p>
            <p style='font-size: 12px; padding:0;'>$notifKerjasama</p>
            <p style='font-size: 12px; padding:0;'>$notifKepemimpinan</p>
            </div>";
         }
         ?>

         <!-- Basic Examples -->
         <div class="row clearfix js-sweetalert">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
               <div class="card">
                  <div class="header">
                     <form class="" action="realisasi.php" method="post">
                        <?php
                        // PENGAMBILAN DATA KASI========================================
                        $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 2");
                        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                           $user[] = $row;
                        }
                        // =============================================================
                        ?>

                        <select class="" name="nama">
                           <option value="0">-- Pilih Staf --</option>
                           <?php foreach ($user as $key): ?>
                              <option value="<?= $key["NIP"] ?>"><?= $key["NAMA"] ?></option>
                           <?php endforeach; ?>
                        </select>
                        <button class="btn btn-primary waves-effect" name="cari" style="margin-left: 10px"><i class="material-icons">search</i></button>
                     </form>
                  </div>

                  <?php if (!isset($_POST["cari"])){ ?>

                     <div class="body">
                        <p><strong>Pilih nama Kasi untuk menilai</strong></p>
                     </div>

                  <?php } else if (isset($_POST["cari"])){ ?>

                     <?php
                     // CEK DATA YG DICARI ADA ATAU TIDAK =============================
                     $nipkasi = $_POST["nama"];
                     $pencarian = $koneksi -> query("SELECT DISTINCT NIP, NAMA FROM USER WHERE NIP = '$nipkasi'");
                     while ($row = $pencarian -> fetch(PDO::FETCH_ASSOC)){
                        $hasilcari[] = $row;
                     }
                     $sukses1 = $pencarian -> rowCount() > 0;
                     // ===============================================================
                     ?>

                     <?php
                     // CEK SUDAH ADA DATA REALISASI ATAU TIDAK =======================
                     $tgl = date("Y");
                     $cekrealisasi = $koneksi -> query("SELECT * FROM realisasi WHERE NIP = '$nipkasi' AND YEAR(TGL_REALISASI) = '$tgl'");
                     // while ($row = $cekrealisasi -> fetch(PDO::FETCH_ASSOC)){
                     //    $hasilcekrealisasi[] = $row;
                     // }
                     $sukses2 = $cekrealisasi -> rowCount() > 0;
                     // ===============================================================
                     ?>


                     <?php
                     // CEK SUDAH ADA DATA NILAI AKHIR ATAU TIDAK =======================
                     $ceknilaikerja = $koneksi -> query("SELECT * FROM nilai_kerja WHERE NIP = '$nipkasi' AND YEAR(TGL_NILAI) = '$tgl'");
                     // while ($row = $cekrealisasi -> fetch(PDO::FETCH_ASSOC)){
                     //    $hasilceknilaikerja[] = $row;
                     // }
                     $sukses3 = $ceknilaikerja -> rowCount() > 0;
                     // ===============================================================
                     ?>

                     <?php if (!$sukses1){ ?>
                        <div class="body">
                           <p><strong>Data tidak ditemukan</strong></p>
                        </div>
                     <?php }else if ($sukses1){ ?>
                        <?php if (!$sukses2){ ?>
                           <div class="body">
                              <div class="table-responsive">
                                 <table class="table" style="width: 100%">
                                    <thead>
                                       <tr>
                                          <th width="60%">Nama</th>
                                          <!-- <th width="10%">Status</th> -->
                                          <th width="10%">Realisasi</th>
                                       </tr>
                                    </thead>

                                    <tbody>
                                       <?php foreach ($hasilcari as $key) { ?>
                                          <tr>
                                             <td><?= $key["NAMA"] ?></td>
                                             <!-- <td>Belum dinilai</td> -->
                                             <td>
                                                <button type="button" class="btn btn-primary waves-effect realisasi" id="<?= $key['NIP']; ?>">Beri nilai</button>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        <?php }else if ($sukses2 && !$sukses3){ ?>
                           <div class="body">
                              <div class="table-responsive">
                                 <table class="table" style="width: 100%">
                                    <thead>
                                       <tr>
                                          <th width="50%">Nama</th>
                                          <!-- <th width="10%">Status</th> -->
                                          <th width="10%">Realisasi</th>
                                          <th width="10%">Perilaku</th>
                                       </tr>
                                    </thead>

                                    <tbody>
                                       <?php foreach ($hasilcari as $key) { ?>
                                          <tr>
                                             <td><?= $key["NAMA"] ?></td>
                                             <!-- <td>Sudah dinilai</td> -->
                                             <td>
                                                <button type="button" class="btn btn-primary waves-effect detailRealisasi" id="<?= $key['NIP']; ?>">Lihat</button>
                                                <button type="button" class="btn btn-primary waves-effect ubahRealisasi" id="<?= $key['NIP']; ?>">Edit</button>
                                             </td>
                                             <td>
                                                <button type="button" class="btn btn-primary waves-effect nilai_kerja" id="<?= $key['NIP']; ?>">Beri nilai</button>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        <?php } else if ($sukses2 && $sukses3) {?>
                           <div class="body">
                              <div class="table-responsive">
                                 <table class="table" style="width: 100%">
                                    <thead>
                                       <tr>
                                          <th width="50%">Nama</th>
                                          <!-- <th width="10%">Status</th> -->
                                          <th width="10%">Realisasi</th>
                                          <th width="10%">Perilaku</th>
                                       </tr>
                                    </thead>

                                    <tbody>
                                       <?php foreach ($hasilcari as $key) { ?>
                                          <tr>
                                             <td><?= $key["NAMA"] ?></td>
                                             <!-- <td>Sudah dinilai</td> -->
                                             <td>
                                                <button type="button" class="btn btn-primary waves-effect detailRealisasi" id="<?= $key['NIP']; ?>">Lihat</button>
                                                <button type="button" class="btn btn-primary waves-effect ubahRealisasi" id="<?= $key['NIP']; ?>">Edit</button>
                                             </td>
                                             <td>
                                                <button type="button" class="btn btn-primary waves-effect detailNilaiKerja" id="<?= $key['NIP']; ?>">Lihat</button>
                                                <button type="button" class="btn btn-primary waves-effect ubahNilaiKerja" id="<?= $key['NIP']; ?>">Edit</button>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  <?php } ?>
               </div>
            </div>
         </div>
         <!-- #END# Basic Examples -->
      </div>
   </section>

   <!-- Jquery Core Js -->
   <script src="../../plugins/jquery/jquery.min.js"></script>


   <!-- Javascript untuk popup modal realisasi-->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".realisasi").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-realisasi.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_realisasi").html(ajaxData);
               $("#modal_realisasi").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>

   <!-- Javascript untuk popup modal detail realisasi-->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".detailRealisasi").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-detail-realisasi.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_detailRealisasi").html(ajaxData);
               $("#modal_detailRealisasi").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>

   <!-- Javascript untuk popup modal detail nilai kerja -->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".detailNilaiKerja").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-detail-nilai-kerja.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_detailNilaiKerja").html(ajaxData);
               $("#modal_detailNilaiKerja").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>

   <!-- Javascript untuk popup modal nilai kerja-->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".nilai_kerja").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-nilai_kerja.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_nilaiKerja").html(ajaxData);
               $("#modal_nilaiKerja").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>

   <!-- Javascript untuk popup modal ubah realisasi-->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".ubahRealisasi").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-ubah-realisasi.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_ubahRealisasi").html(ajaxData);
               $("#modal_ubahRealisasi").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>

   <!-- Javascript untuk popup modal ubah nilai kerja-->
   <script type="text/javascript">
   $(document).ready(function () {
      $(".ubahNilaiKerja").click(function(e) {
         var id = $(this).attr("id");
         $.ajax({
            url: "form-ubah-nilai-kerja.php",
            type: "GET",
            data : {'NIP': id},
            success: function (ajaxData){
               $("#modal_ubahNilaiKerja").html(ajaxData);
               $("#modal_ubahNilaiKerja").modal('show',{backdrop: 'true'});
            }
         });
      });
   });
   </script>


   <!-- Bootstrap Core Js -->
   <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

   <!-- Select Plugin Js -->
   <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

   <!-- Slimscroll Plugin Js -->
   <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

   <!-- Bootstrap Notify Plugin Js -->
   <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

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
   <script src="../../js/demo.js"></script>
</body>

</html>
