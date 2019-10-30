<?php
require '../conn/koneksi.php';
require 'notif.php';
require 'reseterror.php';

if ( !isset($_SESSION["admin"]) ) {
  header("Location: ../proses/login.php");
}

$sql =
"SELECT * FROM user as f
INNER JOIN jabatan as d ON d.ID_JABATAN = f.ID_JABATAN
INNER JOIN posisi_jabatan as c on c.ID_POSISI_JABATAN = f.ID_POSISI_JABATAN";

$statement = $koneksi -> query($sql);
while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
  $users[] = $row;
}



// INFO ADMIN
$user = $_SESSION['useradmin'];
$statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$user'");
while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
  $admin[] = $row;
}
// INFO ADMIN

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Admin - Pengguna</title>
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


  <!-- MODAL TAMBAH -->
  <div class="modal fade" id="modal_tambahPengguna" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_tambahPengguna">Tambah Pengguna</h4>
        </div>
        <div class="modal-body">

          <form id="form_validation" action="proses-simpan.php" name="modal_popup" method="POST">

            <?php
            $statement = $koneksi -> query("SELECT * FROM JABATAN");
            while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
              $jabatan[] = $row;
            }
            ?>

            <label for="jabatan">Jabatan</label>
            <div class="form-group">
              <select class="form-control show-tick" name="jabatan">
                <option value="0">Pilih Jabatan</option>
                <?php foreach ($jabatan as $key): ?>
                  <option value="<?= $key['ID_JABATAN']?>"><?= $key['JABATAN'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>


            <?php
            $statement = $koneksi -> query("SELECT * FROM POSISI_JABATAN");
            while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
              $posisijabatan[] = $row;
            }
            ?>

            <label for="posisijabatan">Posisi Jabatan</label>
            <div class="form-group">
              <select class="form-control show-tick" name="posisijabatan">
                <option value="0">Pilih Posisi Jabatan</option>
                <?php foreach ($posisijabatan as $key): ?>
                  <option value="<?= $key['ID_POSISI_JABATAN']?>"><?= $key['POSISI_JABATAN']?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <?php
            $statement = $koneksi -> query("SELECT * FROM PANGKAT");
            while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
              $pangkat[] = $row;
            }
            ?>

            <label for="pangkat">Pangkat/Gol-Ruang</label>
            <div class="form-group">
              <select class="form-control show-tick" name="pangkat">
                <option value="0">Pilih Pangkat/Gol-Ruang</option>
                <?php foreach ($pangkat as $key){ ?>
                  <option value="<?= $key["ID_PANGKAT"] ?>"><?= $key["JENIS_PANGKAT"] ?> ( <?= $key["GOLONGAN"] ?> / <?= $key["RUANG"] ?> )</option>
                <?php } ?>
              </select>
            </div>

            <label for="unitkerja">Unit Kerja</label>
            <div class="form-group">
              <select class="form-control show-tick" name="unitkerja">
                <option value="0">Pilih Unit Kerja</option>
                <option value="DISPENDUK & PENCAPIL KAB. BANGKALAN">DISPENDUK & PENCAPIL KAB. BANGKALAN</option>
              </select>
            </div>

            <label for="nip">NIP</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="nip" class="form-control" name="nip" placeholder="Masukkan NIP Pengguna" required>
              </div>
            </div>

            <label for="nama">Nama</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="nama" class="form-control" name="nama" placeholder="Masukkan Nama Pengguna" required>
              </div>
            </div>

            <label for="username">Username</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="username" class="form-control" name="username" placeholder="Masukkan Username Pengguna" required>
              </div>
            </div>

            <label for="email">Email</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="email" class="form-control" name="email" placeholder="Masukkan Email Pengguna" required>
              </div>
            </div>

            <!-- <label for="password">Password</label>
            <div class="form-group">
            <div class="col-md-12 align-right" style="padding: 0">
            <div class="input-group input-group-md">
            <div class="form-line">
            <input type="text" id="password" name="password" class="form-control" placeholder="Masukkan Password Pengguna" required>
          </div>
          <span class="input-group-addon">
          <a href="#"><i class="material-icons">cached</i></a>
        </span>
      </div>
    </div>
  </div> -->

  <button class="btn btn-primary waves-effect" name="simpan_pengguna">SUBMIT</button>
</form>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
</div>
</div>
</div>
</div>
<!-- #END# MODAL -->

<!-- MODAL HAPUS-->
<div class="modal fade" id="modal_hapusPengguna" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-col-red">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_hapusPengguna">Hapus Data</h4>
      </div>
      <div class="modal-body">
        Anda akan menghapus data pengguna. Lanjutkan menghapus?
      </div>
      <div class="modal-footer">
        <a href="#" type="button" class="btn btn-link waves-effect" id="link_hapus">Ya, Hapus</a>
        <a href="#" type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</a>
      </div>
    </div>
  </div>
</div>
<!-- #END# MODAL -->

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

<!-- MODAL DETAIL-->
<div class="modal fade" id="modal_lihatPengguna" tabindex="-1" role="dialog">

</div>
<!-- #END# MODAL -->

<!-- MODAL EDIT -->
<div class="modal fade" id="modal_ubahPengguna" tabindex="-1" role="dialog">

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
        <li class="active">
          <a href="pengguna.php">
            <i class="material-icons">people</i>
            <span>Pengguna</span>
          </a>
        </li>
        <li>
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

      <p style='font-size: 12px; padding:0;'>$notifPosisiKadis1</p>
      <p style='font-size: 12px; padding:0;'>$notifPosisiKadis2</p>
      <p style='font-size: 12px; padding:0;'>$notifPosisiKabid1</p>
      <p style='font-size: 12px; padding:0;'>$notifPosisiKabid2</p>
      <p style='font-size: 12px; padding:0;'>$notifNip</p>
      <p style='font-size: 12px; padding:0;'>$notifNama</p>
      <p style='font-size: 12px; padding:0;'>$notifUsername</p>
      <p style='font-size: 12px; padding:0;'>$errorEmail1</p>
      <p style='font-size: 12px; padding:0;'>$errorEmail2</p>
      <p style='font-size: 12px; padding:0;'>$notifJabatanKosong</p>
      <p style='font-size: 12px; padding:0;'>$notifPosisiJabatanKosong</p>
      <p style='font-size: 12px; padding:0;'>$notifPangkatKosong</p>
      <p style='font-size: 12px; padding:0;'>$notifUnitKerjaKosong</p>
      <p style='font-size: 12px; padding:0;'>$notifDuplikatJabatan</p>
      <p style='font-size: 12px; padding:0;'>$notifJabatanKabid</p>

      </div>";
    }
    ?>
    <!-- Basic Examples -->
    <div class="row clearfix js-sweetalert">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
        <div class="card">
          <div class="header">
            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#modal_tambahPengguna">
              <i class="material-icons">person_add</i>
              <span>TAMBAH PENGGUNA</span>
            </button>

          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width: 100%">
                <thead>
                  <tr>
                    <th style=" width: 20%;">NIP</th>
                    <th style=" width: 15%;">Jabatan</th>
                    <th style=" width: 15%;">Posisi Jabatan</th>
                    <th style=" width: 30%;">Nama</th>
                    <th style=" width: 10%;">Detail</th>
                    <th style=" width: 10%;">Action</th>
                  </tr>
                </thead>


                <?php if (empty($users)){ ?>
                  <tbody>

                  </tbody>
                <?php }else{ ?>
                  <tbody>
                    <?php foreach ($users as $key) { ?>
                      <tr>
                        <td><?= $key["NIP"] ?></td>
                        <td><?= $key["JABATAN"] ?></td>
                        <td><?= $key["POSISI_JABATAN"] ?></td>
                        <td><?= $key["NAMA"] ?></td>
                        <td class="align-center">
                          <a href="#" data-toggle="tooltip" class="modal_lihat" id="<?= $key['NIP']; ?>">
                            Lihat
                          </a>
                        </td>
                        <td class="align-center">
                          <a href="#" data-toggle="modal" class="modal_edit" id="<?= $key['NIP']; ?>">
                            <i class="material-icons">mode_edit</i>
                          </a>
                          <a href="#" onclick="confirm_modal('proses-hapus.php?&nip=<?= $key['NIP']; ?>');" data-nip="<?= $key['NIP'];?>">
                            <i class="material-icons">delete</i>
                          </a>
                        </td>
                      </tr>

                    <?php } ?>
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

<!-- Javascript untuk popup modal detail-->
<script type="text/javascript">
$(document).ready(function () {
  $(".modal_lihat").click(function(e) {
    var id = $(this).attr("id");
    $.ajax({
      url: "form-detail.php",
      type: "GET",
      data : {'NIP': id},
      success: function (ajaxData){
        $("#modal_lihatPengguna").html(ajaxData);
        $("#modal_lihatPengguna").modal('show',{backdrop: 'true'});
      }
    });
  });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function () {
  $(".modal_edit").click(function(e) {
    var id = $(this).attr("id");
    $.ajax({
      url: "form-ubah.php",
      type: "GET",
      data : {'NIP': id},
      success: function (ajaxData){
        $("#modal_ubahPengguna").html(ajaxData);
        $("#modal_ubahPengguna").modal('show',{backdrop: 'true'});
      }
    });
  });
});
</script>

<!-- Javascript untuk popup modal Delete-->
<script type="text/javascript">
function confirm_modal(delete_url)
{
  $('#modal_hapusPengguna').modal('show', {backdrop: 'static'});
  document.getElementById('link_hapus').setAttribute('href' , delete_url);
}
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
