<?php
require '../conn/koneksi.php';

if (isset($_GET['nip'])){

  //ambil data user untuk dipasang ke riwayat
  $nip = $_GET['nip'];
  $statement = $koneksi -> prepare("SELECT * FROM USER WHERE NIP = :NIP");
  $statement -> bindValue(':NIP', $nip);
  $statement -> execute();
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $getuser[] = $row;
  }

  //variable NAMA untuk menyimpan NAMA di riwayat
  $nama = $getuser[0]["NAMA"];

  //query untuk hapus data
  $statement = $koneksi -> prepare("DELETE FROM USER WHERE NIP = :NIP");
  $statement -> bindValue(':NIP', $_GET["nip"]);
  $statement -> execute();

  $sukses = $statement -> rowCount() > 0;

  if($sukses) {
    // data riwayat
    //cek admin yang melakukan aktivitas
    $username = $_SESSION['useradmin'];
    $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$username'");
    while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
      $admin[] = $row;
    }

    //set data yang akan digunakan untuk mengisi riwayat
    $id = $admin[0]['ID_ADMIN'];
    $aktivitas = "Menghapus pengguna " . "<strong>".$nama."</strong>" ;
    date_default_timezone_set("Asia/Jakarta");
    $waktu = date("Y-m-d H:i:s");

    //query untuk membuat riwayat
    $statement = $koneksi -> prepare("INSERT INTO RIWAYAT_ADMIN (ID_ADMIN, AKTIVITAS_ADMIN, TGL_RIWAYAT_ADMIN) VALUES (:ID_ADMIN, :AKTIVITAS_ADMIN, :TGL_RIWAYAT_ADMIN)");
    $statement -> bindValue(':ID_ADMIN', $id);
    $statement -> bindValue(':AKTIVITAS_ADMIN', $aktivitas);
    $statement -> bindValue(':TGL_RIWAYAT_ADMIN', $waktu);
    $statement -> execute();


    header("Location: pengguna.php?alert=3");
    die;
  }else{
    header("Location: pengguna.php?alert=4");
    die;
  }
}

if (isset($_GET['id_jabatan'])){

  //ambil data user untuk dipasang ke riwayat
  $id = $_GET['id_jabatan'];
  $statement = $koneksi ->  prepare("SELECT * FROM JABATAN WHERE ID_JABATAN = :ID_JABATAN");
  $statement -> bindValue(':ID_JABATAN', $id);
  $statement -> execute();
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $getjabatan[] = $row;
  }

  //variable JABATAN untuk menyimpan JABATAN di riwayat
  $jabatan = $getjabatan[0]["JABATAN"];

  //query untuk hapus data
  $statement = $koneksi -> prepare("DELETE FROM JABATAN WHERE ID_JABATAN = :ID_JABATAN");
  $statement -> bindValue(':ID_JABATAN', $id);
  $statement -> execute();

  $sukses = $statement -> rowCount() > 0;

  if($sukses) {
    // data riwayat
    //cek admin yang melakukan aktivitas
    $username = $_SESSION['useradmin'];
    $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$username'");
    while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
      $admin[] = $row;
    }

    //set data yang akan digunakan untuk mengisi riwayat
    $id = $admin[0]['ID_ADMIN'];
    $aktivitas = "Menghapus jabatan " . "<strong>".$jabatan."</strong>" ;
    date_default_timezone_set("Asia/Jakarta");
    $waktu = date("Y-m-d H:i:s");

    //query untuk membuat riwayat
    $statement = $koneksi -> prepare("INSERT INTO RIWAYAT_ADMIN (ID_ADMIN, AKTIVITAS_ADMIN, TGL_RIWAYAT_ADMIN) VALUES (:ID_ADMIN, :AKTIVITAS_ADMIN, :TGL_RIWAYAT_ADMIN)");
    $statement -> bindValue(':ID_ADMIN', $id);
    $statement -> bindValue(':AKTIVITAS_ADMIN', $aktivitas);
    $statement -> bindValue(':TGL_RIWAYAT_ADMIN', $waktu);
    $statement -> execute();

    header("Location: struktur.php?alert=3");
    die;
  }else{
    header("Location: struktur.php?alert=4");
    die;
  }
}

if (isset($_GET['id_seksi'])){

  //ambil data user untuk dipasang ke riwayat
  $id = $_GET['id_seksi'];
  $statement = $koneksi -> prepare("SELECT * FROM SEKSI WHERE ID_SEKSI = :ID_SEKSI");
  $statement -> bindValue(':ID_SEKSI', $id);
  $statement -> execute();
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $getseksi[] = $row;
  }

  //variable nama untuk menyimpan nama di riwayat
  $seksi = $getseksi[0]["SEKSI"];

  //query untuk hapus data
  $statement = $koneksi -> prepare ("DELETE FROM SEKSI WHERE ID_SEKSI = :ID_SEKSI");
  $statement -> bindValue(':ID_SEKSI', $id);
  $statement -> execute();

  $sukses = $statement -> rowCount() > 0;

  if($sukses) {
    // data riwayat
    //cek admin yang melakukan aktivitas
    $username = $_SESSION['useradmin'];
    $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$username'");
    while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
      $admin[] = $row;
    }

    //set data yang akan digunakan untuk mengisi riwayat
    $id = $admin[0]['ID_ADMIN'];
    $aktivitas = "Menghapus seksi " . "<strong>".$seksi."</strong>" ;
    date_default_timezone_set("Asia/Jakarta");
    $waktu = date("Y-m-d H:i:s");

    //query untuk membuat riwayat
    $statement = $koneksi -> prepare("INSERT INTO RIWAYAT_ADMIN (ID_ADMIN, AKTIVITAS_ADMIN, TGL_RIWAYAT_ADMIN) VALUES (:ID_ADMIN, :AKTIVITAS_ADMIN, :TGL_RIWAYAT_ADMIN)");
    $statement -> bindValue(':ID_ADMIN', $id);
    $statement -> bindValue(':AKTIVITAS_ADMIN', $aktivitas);
    $statement -> bindValue(':TGL_RIWAYAT_ADMIN', $waktu);
    $statement -> execute();

    header("Location: struktur.php?alert=3");
    die;
  }else{
    header("Location: struktur.php?alert=4");
    die;
  }
}
?>
