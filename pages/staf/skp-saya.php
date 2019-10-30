<?php
require '../conn/koneksi.php';
require 'notif.php';
require 'reset-error.php';

if ( !isset($_SESSION["staf"]) ) {
  header("Location: ../proses/login.php");
  exit;
}

// INFO STAF
$nip = $_SESSION['userstaf'];
$sql = "SELECT * FROM user
INNER JOIN pangkat ON user.ID_PANGKAT = pangkat.ID_PANGKAT
INNER JOIN jabatan ON user.ID_JABATAN = jabatan.ID_JABATAN
INNER JOIN posisi_jabatan ON user.ID_POSISI_JABATAN = posisi_jabatan.ID_POSISI_JABATAN
WHERE user.NIP = :NIP";

$statement = $koneksi -> prepare ($sql);
$statement -> bindValue(':NIP', $nip);
$statement -> execute();
$staf = $statement -> fetch(PDO::FETCH_ASSOC);


$periodecari = ""; // SET periodecari dengan string kosong supaya ada isi (tidak error)
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Staf - Home</title>
  <!-- Favicon-->
  <link rel="icon" href="../../favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="../../googleicon.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Select Plugin Js -->
  <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

  <!-- Waves Effect Css -->
  <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Custom Css -->
  <link href="../../css/style.css" rel="stylesheet">

  <!-- Bootstrap Select Css -->
  <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-indigo">

  <!-- MODAL PROFILE STAF -->
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
                      <td><?= $staf["NIP"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Jabatan</td>
                      <td><?= $staf["JABATAN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Posisi Jabatan</td>
                      <td><?= $staf["POSISI_JABATAN"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Nama</td>
                      <td><?= $staf["NAMA"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Pangkat/Gol-Ruang</td>
                      <td><?= $staf['JENIS_PANGKAT'] . " (" . $staf['GOLONGAN'] . "/" . $staf['RUANG'] . ")" ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Unit Kerja</td>
                      <td><?= $staf["UNIT_KERJA"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Username</td>
                      <td><?= $staf["USERNAME"] ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold">Email</td>
                      <td><?= $staf["EMAIL"] ?></td>
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

  <!-- MODAL TAMBAH SKP-->
  <div class="modal fade" id="modal_tambahskp" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_tambahskp">Tambah Kegiatan</h4>
        </div>
        <div class="modal-body js-sweetalert">

          <form id="form_validation" action="proses-simpan.php" method="POST">


            <label for="kegiatan">Kegiatan</label>
            <div class="form-group">
              <div class="form-line">
                <textarea rows="5" id="kegiatan" class="form-control no-resize auto-growth" name="kegiatan" placeholder="Masukkan Kegiatan" required></textarea>
              </div>
            </div>

            <div class="col-lg-12" style="padding-left: 0">
              <div class="col-lg-6">
                <label for="ak">AK</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" id="ak" class="form-control" name="ak" placeholder="0" value="0" readonly required>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="kuantoutput1">Kuant / Output</label>
                <div class="form-group">
                  <div class="col-lg-6" style="padding: 0">
                    <div class="form-line">
                      <input type="text" id="kuantoutput1" class="form-control" name="kuantoutput1" placeholder="0" required>
                    </div>
                  </div>

                  <div class="col-lg-6" style="padding-right: 0">
                    <select class="form-control show-tick" name="kuantoutput2">
                      <option value="Kali">Kali</option>
                      <option value="Jam">Jam</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12" style="padding-left: 0">
              <div class="col-lg-6">
                <label for="kualmutu" style="">Kual / Mutu</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" id="kualmutu" class="form-control" name="kualmutu" placeholder="0%" required>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="waktu1">Waktu</label>
                <div class="form-group">
                  <div class="col-lg-6" style="padding: 0">
                    <div class="form-line">
                      <input type="text" id="waktu1" class="form-control" name="waktu1" placeholder="0" required>
                    </div>
                  </div>

                  <div class="col-lg-6" style="padding-right: 0">
                    <select class="form-control show-tick" name="waktu2">
                      <option value="Bulan">Bulan</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12">
              <label for="biaya">Biaya</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="biaya" class="form-control" name="biaya" placeholder="0" value="0" readonly required>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <button type="submit" class="btn btn-primary waves-effect alignleft" name="tambah_skp">SUBMIT</button>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <div class="col-lg-12">
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- #END# MODAL -->

  <!-- MODAL HAPUS-->
  <div class="modal fade" id="modal_hapusskp" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-col-red">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_hapusskp">Hapus Data</h4>
        </div>
        <div class="modal-body">
          Anda akan menghapus data SKP. Lanjutkan menghapus?
        </div>
        <div class="modal-footer">
          <a href="#" type="button" class="btn btn-link waves-effect" id="link_hapus">Ya, Hapus</a>
          <a href="#" type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</a>
        </div>
      </div>
    </div>
  </div>
  <!-- #END# MODAL -->

  <!-- MODAL EDIT SKP-->
  <div class="modal fade" id="modal_ubahskp" tabindex="-1" role="dialog">

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


          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $staf["NAMA"] ?></div>
          <div class="email"><?= $staf["EMAIL"] ?></div>
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
            <a href="../../index4.php">
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
              <li class="active">
                <a href="skp-saya.php">SKP - Saya</a>
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
            </ul>
          </li>
          <li>
            <a href="arsip.php">
              <i class="material-icons">archive</i>
              <span>Arsip</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
        <div class="copyright">
          &copy; 2017 - 2018 <a href="javascript:void(0);">Dispenduk Bangkalan</a>.
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
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data SKP berhasil dibuat.
        </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Mahasiswa berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert bg-green alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data SKP berhasil diubah.
        </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert bg-green alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data SKP berhasil dihapus.
        </div>";
      }
      // jika alert = 4
      // tampilkan pesan Gagal "Data Gagal Disimpan"
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert bg-red alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> Data SKP gagal dibuat.

        <p style='font-size: 12px; padding:0;'>$notifKuant</p>
        <p style='font-size: 12px; padding:0;'>$notifKual</p>
        <p style='font-size: 12px; padding:0;'>$notifWaktu</p>

        </div>";
      }
      ?>

      <!-- Basic Examples -->
      <div class="row clearfix js-sweetalert">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
          <div class="card">
            <div class="header">

              <!-- TOMBOL TAMBAH SKP -->
              <?php
              $statement = $koneksi -> query("SELECT * FROM MASA_SKP");
              while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                $mulaiskp[] = $row;
              }?>

              <?php
              if ($mulaiskp[0]["ID_STATUS"] == 6) { ?>
                <button type="button" class="btn btn-info waves-effect disabled">
                  <i class="material-icons">assignment</i>
                  <span>TAMBAH SKP</span>
                </button>
              <?php } else if ($mulaiskp[0]["ID_STATUS"] == 5) { ?>
                <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#modal_tambahskp">
                  <i class="material-icons">assignment</i>
                  <span>TAMBAH SKP</span>
                </button>
              <?php } ?>
              <!-- TOMBOL TAMBAH SKP -->

              <?php
              //PENCARIAN SKP PENGGUNA YANG SEDANG LOGIN
              if (isset($_POST["cari"])) {
                $periodecari = $_POST['periode'];
                $nip = $_SESSION['userstaf'];
                $statement = $koneksi -> query("SELECT * FROM SKP INNER JOIN STATUS ON SKP.ID_STATUS = STATUS.ID_STATUS WHERE NIP = '$nip' AND YEAR(TGL_SKP) = '$periodecari'");

                $sukses = $statement -> rowCount() > 0;
                if ($sukses){
                  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                    $cari[] = $row;
                  }
                  $cariskp = true;
                }else{
                  $cariskp = false;
                }
              }
              ?>


              <?php
              $nip = $_SESSION['userstaf'];
              $sql = "SELECT * FROM skp
              INNER JOIN user ON user.NIP = skp.NIP
              INNER JOIN status ON status.ID_STATUS = skp.ID_STATUS
              WHERE user.NIP = '$nip' AND YEAR(TGL_SKP) = '$periodecari'";

              // MENGAMBIL DATA SKP DARI USER YANG SEDANG LOGIN
              $statement = $koneksi -> query($sql);
              $cek1 = $statement -> rowCount() > 0;

              if ($cek1) {
                while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                  $skp[] = $row;
                }
                $jumlahskp = count($skp);
                $cekskp = true;
              }else{
                $jumlahskp = 0;
                $cekskp = false;
              }


              // MENGAMBIL DATA SKP DARI USER YANG SEDANG LOGIN + PENGECEKAN SKP YANG SUDAH DITERIMA
              $statement = $koneksi -> query("SELECT * FROM SKP WHERE ID_STATUS = 2 AND NIP = '$nip' AND YEAR(TGL_SKP) = '$periodecari'");
              $cek2 = $statement -> rowCount() > 0;

              if ($cek2) {
                while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                  $konfirmasi[] = $row;
                }
                $jumlahstatus = count($konfirmasi);
              }else{
                $jumlahstatus = 0;
              }
              ?>

              <?php if ($jumlahskp !== $jumlahstatus or $jumlahskp === 0) {?>
                <button type="button" class="btn btn-info waves-effect disabled">
                  <i class="material-icons">print</i>
                  <span>CETAK SKP</span>
                </button>
              <?php } else { ?>
                <form action="cetak-skp.php" style="display: inline" method="post" target="_blank">
                  <input type="hidden" name="periode" value="<?= $periodecari ?>">
                  <button type="submit" class="btn btn-info waves-effect">
                    <i class="material-icons">print</i>
                    <span>CETAK SKP</span>
                  </button>
                </form>
              <?php } ?>

              <!-- TOMBOL CARI (TOMBOL YANG HARUS DI TEKAN UNTUK MEMULAI SEMUA PROSES) -->
              <form class="" action="skp-saya.php" method="post" style="display: inline; float: right">
                <select class="periode" name="periode">
                  <?php
                  // PENGAMBILAN DATA PERIODE
                  $gettgl = date("Y");
                  $tanggal = intval($gettgl);
                  ?>
                  <option value="<?= date("Y") ?>"><?= date("Y") ?> (Periode saat ini)</option>
                  <?php for ($i=2017; $i <= $tanggal ; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                  <?php } ?>
                </select>
                <button class="btn btn-primary waves-effect" type="submit" name="cari"><i class="material-icons">search</i></button>
              </form>
            </div>

            <?php if ($periodecari === "") {?>
              <div class="body">
                <p><strong>Pilih periode SKP untuk melihat</strong></p>
              </div>
            <?php } else if (isset($_POST["cari"])) { ?>
              <?php if ($cariskp === false) {?>
                <div class="body">
                  <p>Tidak ada SKP diperiode tersebut</p>
                </div>
              <?php } else if ($cariskp === true) { ?>
                <div class="body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width: 100%">
                      <thead>
                        <tr>
                          <!-- <th>Nama</th> -->
                          <th width="%">Kegiatan</th>
                          <th width="%">AK</th>
                          <th width="%">Kuant/Output</th>
                          <th width="%">Kual/Mutu</th>
                          <th width="%">Waktu</th>
                          <th width="%">Biaya</th>
                          <th width="%">Aksi</th>
                          <th width="%">Status</th>
                          <!-- <th>Status</th> -->
                        </tr>
                      </thead>

                      <tbody>
                        <?php foreach ($cari as $key) { ?>
                          <tr>
                            <!-- <td><?= $key["NAMA"] ?></td> -->
                            <td><?= $key["KEGIATAN"] ?></td>
                            <td><?= $key["AK"] ?></td>
                            <td><?= $key["KUANT_OUTPUT"] ?></td>
                            <td><?= $key["KUAL_MUTU"] ?></td>
                            <td><?= $key["WAKTU"] ?></td>
                            <td><?= $key["BIAYA"] ?></td>

                            <?php if ($key["ID_STATUS"] != 2){ ?>
                              <td class="align-center">
                                <a href="#" data-toggle="modal" class="modal_edit" id="<?= $key['ID_SKP']; ?>">
                                  <i class="material-icons">mode_edit</i>
                                </a>
                                <a href="#" onclick="confirm_modal('proses-hapus.php?&id_skp=<?= $key['ID_SKP']; ?>');" data-skp="<?= $key['ID_SKP'];?>">
                                  <i class="material-icons">delete</i>
                                </a>
                              </td>
                            <?php } else { ?>
                              <td class="align-center">
                                <a href="#" data-toggle="popover" data-trigger="focus" data-container="body" data-placement="left" title="Tidak dapat mengedit" data-content="Tidak dapat mengedit data saat status sudah diterima.">
                                  <i class="material-icons">mode_edit</i>
                                </a>
                                <a href="#" data-toggle="popover" data-trigger="focus" data-container="body" data-placement="left" title="Tidak dapat menghapus" data-content="Tidak dapat menghapus data saat status sudah diterima.">
                                  <i class="material-icons">delete</i>
                                </a>
                              </td>
                            <?php } ?>
                            <?php if ($key["STATUS"] === "Ditolak") { ?>
                              <td style="color:red; font-weight: bold;"><?= $key["STATUS"] ?></td>
                            <?php } else { ?>
                              <td style="color:green; font-weight: bold;"><?= $key["STATUS"] ?></td>
                            <?php } ?>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
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

  <!-- Javascript untuk popup modal Edit-->
  <script type="text/javascript">
  $(document).ready(function () {
    $(".modal_edit").click(function(e) {
      var id = $(this).attr("id");
      $.ajax({
        url: "form-ubah.php",
        type: "GET",
        data : {'ID_SKP': id},
        success: function (ajaxData){
          $("#modal_ubahskp").html(ajaxData);
          $("#modal_ubahskp").modal('show',{backdrop: 'true'});
        }
      });
    });
  });
  </script>

  <!-- Javascript untuk popup modal Delete-->
  <script type="text/javascript">
  function confirm_modal(delete_url)
  {
    $('#modal_hapusskp').modal('show', {backdrop: 'static'});
    document.getElementById('link_hapus').setAttribute('href' , delete_url);
  }
  </script>

  <!-- Bootstrap Core Js -->
  <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

  <!-- Select Plugin Js -->
  <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="../../plugins/node-waves/waves.js"></script>

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
  <script src="../../js/pages/ui/tooltips-popovers.js"></script>

  <!-- Demo Js -->
  <script src="../../js/demo.js"></script>
</body>

</html>
