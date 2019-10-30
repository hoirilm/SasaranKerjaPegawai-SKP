<?php
require '../conn/koneksi.php';
require 'notif.php';
require 'reset-error.php';

if ( !isset($_SESSION["kasi"]) ) {
  header("Location: ../proses/login.php");
  die;
}

if (isset($_POST["tolak"])) {
  $terpilih = $_POST["pilih"];
  $jumlah_terpilih = count($terpilih);

  if ($jumlah_terpilih == 0) {
    header("Location: skp-staf.php?alert=4");
    die;
  }

  for ($i=0; $i < $jumlah_terpilih; $i++) {
    $statement = $koneksi -> prepare("UPDATE SKP SET ID_STATUS = :ID_STATUS WHERE ID_SKP = '$terpilih[$i]'");
    $statement -> bindValue(':ID_STATUS', 1);
    $statement -> execute();
  }

  for ($i=0; $i < $jumlah_terpilih; $i++) {
    $statement = $koneksi -> prepare("UPDATE SKP SET ID_STATUS = :ID_STATUS WHERE ID_SKP = '$terpilih[$i]'");
    $statement -> bindValue(':ID_STATUS', 3);
    $statement -> execute();
  }

  $sukses = $statement -> rowCount() > 0;
  if($sukses) {
    header("Location: skp-staf.php?alert=2");
    die;
  }else{
    header("Location: skp-staf.php?alert=3");
    die;
  }

}

if (isset($_POST["terima"])) {

  $terpilih = $_POST["pilih"];
  $jumlah_terpilih = count($terpilih);

  if ($jumlah_terpilih == 0) {
    header("Location: skp-staf.php?alert=4");
    die;
  }

  for ($i=0; $i < $jumlah_terpilih; $i++) {
    $statement = $koneksi -> prepare("UPDATE SKP SET ID_STATUS = :ID_STATUS WHERE ID_SKP = '$terpilih[$i]'");
    $statement -> bindValue(':ID_STATUS', 1);
    $statement -> execute();
  }

  for ($i=0; $i < $jumlah_terpilih; $i++) {
    $statement = $koneksi -> prepare("UPDATE SKP SET ID_STATUS = :ID_STATUS WHERE ID_SKP = '$terpilih[$i]'");
    $statement -> bindValue(':ID_STATUS', 2);
    $statement -> execute();
  }

  $sukses = $statement -> rowCount() > 0;
  if($sukses) {
    header("Location: skp-staf.php?alert=1");
    die;
  }else{
    header("Location: skp-staf.php?alert=3");
    die;
  }

}

// INFO KASI
$nip = $_SESSION['userkasi'];
$sql = "SELECT * FROM user
INNER JOIN pangkat ON user.ID_PANGKAT = pangkat.ID_PANGKAT
INNER JOIN jabatan ON user.ID_JABATAN = jabatan.ID_JABATAN
INNER JOIN posisi_jabatan ON user.ID_POSISI_JABATAN = posisi_jabatan.ID_POSISI_JABATAN
WHERE user.NIP = :NIP";

$statement = $koneksi -> prepare ($sql);
$statement -> bindValue(':NIP', $nip);
$statement -> execute();
$kasi = $statement -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Kasi - SKP</title>
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

  <!-- MODAL PROFILE KASI -->
  <div class="modal fade" id="modal_profile_kasi" tabindex="-1" role="dialog">
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
                      <td><?= $kasi["NIP"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Jabatan</td>
                      <td><?= $kasi["JABATAN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Posisi Jabatan</td>
                      <td><?= $kasi["POSISI_JABATAN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Nama</td>
                      <td><?= $kasi["NAMA"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Pangkat/Gol-Ruang</td>
                      <td><?= $kasi['JENIS_PANGKAT'] . " (" . $kasi['GOLONGAN'] . "/" . $kasi['RUANG'] . ")" ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Unit Kerja</td>
                      <td><?= $kasi["UNIT_KERJA"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Username</td>
                      <td><?= $kasi["USERNAME"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Email</td>
                      <td><?= $kasi["EMAIL"] ?></td>
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

          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $kasi["NAMA"] ?></div>
          <div class="email"><?= $kasi["EMAIL"] ?></div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="#" data-toggle="modal" data-target="#modal_profile_kasi"><i class="material-icons">person</i>Profile</a></li>
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
            <a href="../../index3.php">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li class="active">
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">view_list</i>
              <span>SKP</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="skp-saya.php">SKP - Saya</a>
              </li>
              <li class="active">
                <a href="skp-staf.php">SKP - Staf</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">assignment</i>
              <span>Realisasi</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="realisasi-saya.php">Realisasi - Saya</a>
              </li>
              <li>
                <a href="realisasi-staf.php">Realisasi - Staf</a>
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
                <a href="arsip.php">Arsip - Saya</a>
              </li>
              <li>
                <a href="arsip-staf.php">Arsip - Staf</a>
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
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert bg-blue alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        Data SKP telah dikonfirmasi.
        </div>";
      }
      // jika alert = 2
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert bg-blue alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        Data SKP telah ditolak.
        </div>";
      }
      // jika alert = 3
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert bg-red alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        Terjadi kesalahan, pastikan yang dipilih sudah diterima atau ditolak.
        </div>";
      }
      // jika alert = 4
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert bg-red alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        Data SKP harus dipilih terlebih dahulu.
        </div>";
      }
      ?>

      <!-- Basic Examples -->
      <div class="row clearfix js-sweetalert">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
          <div class="card">
            <div class="header">
              <form class="" action="skp-staf.php" method="post">
                <?php
                // PENGAMBILAN DATA STAF
                $nip = $_SESSION["userkasi"];
                $statement = $koneksi -> query("SELECT * FROM USER WHERE NIP = '$nip'");
                while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                  $user[] = $row;
                }

                $posisijabatan = $user[0]["ID_POSISI_JABATAN"];
                $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 3 AND ID_POSISI_JABATAN = '$posisijabatan'");
                while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                  $staf[] = $row;
                }

                // PENGAMBILAN DATA PERIODE
                $gettgl = date("Y");
                $tanggal = intval($gettgl);
                ?>

                <div class="form-group" style="margin:0" style="width: 30%">


                  <select class="periode" name="periode">
                    <option value="<?= date("Y") ?>"><?= date("Y") ?> (Periode saat ini)</option>
                    <?php for ($i=2017; $i <= $tanggal ; $i++) { ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                  </select>

                  &nbsp; &nbsp;

                  <select class="" name="nama">
                    <option value="0">--Pilih Pengguna--</option>
                    <?php foreach ($staf as $key): ?>
                      <option value="<?= $key["NIP"] ?>"><?= $key["NAMA"] ?></option>
                    <?php endforeach; ?>
                  </select>


                  <button class="btn btn-primary waves-effect" name="cari" style="margin-left: 10px"><i class="material-icons">search</i></button>
                </div>
              </form>
            </div>

            <?php
            if (isset($_POST["cari"])){
              $nip = $_POST["nama"];
              $periode = $_POST["periode"];
              // $thnsekarang = date("Y");
              $query = "SELECT * FROM SKP INNER JOIN STATUS ON SKP.ID_STATUS = STATUS.ID_STATUS WHERE NIP = '$nip' AND YEAR(TGL_SKP) = '$periode' ORDER BY ID_SKP DESC";

              $statement = $koneksi -> query($query);
              while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                $cari[] = $row;
              }
              $sukses = $statement -> rowCount() > 0;
              ?>

              <?php if ($sukses) { ?>
                <form class="" action="skp-staf.php" method="post">
                  <div class="body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width: 100%">
                        <thead>
                          <tr>
                            <th>Pilih</th>
                            <th width="65%">Kegiatan</th>
                            <th width="5%">AK</th>
                            <th width="5%">Kuant/Output</th>
                            <th width="5%">Kual/Mutu</th>
                            <th width="5%">Waktu</th>
                            <th width="5%">Biaya</th>
                            <th width="5%">Status</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($cari as $key) { ?>
                            <tr>
                              <td>
                                <input type="checkbox" class="filled-in" name="pilih[]" value="<?= $key["ID_SKP"] ?>" id="ig_checkbox.<?= $key["ID_SKP"] ?>">
                                <label for="ig_checkbox.<?= $key["ID_SKP"] ?>"></label>
                              </td>
                              <td><?= $key["KEGIATAN"] ?></td>
                              <td><?= $key["AK"] ?></td>
                              <td><?= $key["KUANT_OUTPUT"] ?></td>
                              <td><?= $key["KUAL_MUTU"] ?></td>
                              <td><?= $key["WAKTU"] ?></td>
                              <td><?= $key["BIAYA"] ?></td>
                              <?php if ($key["STATUS"] === "Belum ada status") { ?>
                                <td style="color:grey; font-weight: bold;"><?= $key["STATUS"] ?></td>
                              <?php } else if ($key["STATUS"] === "Ditolak"){ ?>
                                <td style="color:red; font-weight: bold;"><?= $key["STATUS"] ?></td>
                              <?php } else { ?>
                                <td style="color:green; font-weight: bold;"><?= $key["STATUS"] ?></td>
                              <?php } ?>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <button class="btn bg-green waves-effect" name="terima" style="margin-left: 10px">Terima</button>
                    <button class="btn bg-red waves-effect" name="tolak" style="margin-left: 10px">Tolak</button>
                  </form>
                </div>
              <?php } else { ?>
                <div class="body">
                  <strong><p style="color:red"> Maaf, SKP tidak ditemukan </p></strong>
                </div>
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
  <script src="../../js/pages/ui/tooltips-popovers.js"></script>

  <!-- Demo Js -->
  <script src="../../js/demo.js"></script>
</body>

</html>
