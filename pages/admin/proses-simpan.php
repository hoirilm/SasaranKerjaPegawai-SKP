<?php
require '../conn/koneksi.php';
// require 'reseterror.php';


if (isset($_POST['simpan_pengguna'])){
  $error = false;

  $nip = htmlspecialchars($_POST['nip']);
  $nipbaru = str_replace(' ','',$nip);
  $jabatan = htmlspecialchars($_POST['jabatan']);
  $posisijabatan = htmlspecialchars($_POST['posisijabatan']);
  $nama = htmlspecialchars($_POST['nama']);
  $pangkat = htmlspecialchars($_POST['pangkat']);
  $unitkerja = htmlspecialchars($_POST['unitkerja']);
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);



  // cek jika pilihan dropdown tidak dipilih
  if ($jabatan == "0") {
    $_SESSION["errorJabatanKosong"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorJabatanKosong"]);
  }

  if ($posisijabatan == "0") {
    $_SESSION["errorPosisiJabatanKosong"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorPosisiJabatanKosong"]);
  }

  if ($pangkat == "0") {
    $_SESSION["errorPangkatKosong"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorPangkatKosong"]);
  }

  if ($unitkerja == "0") {
    $_SESSION["errorUnitKerjaKosong"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorUnitKerjaKosong"]);
  }



  // cek jika yang pilih adalah kepala dinas.
  if ($jabatan == "4" and $posisijabatan != "5") {
    $_SESSION["errorPosisiKadis1"] = true;
    $error = true;
  } else if ($jabatan == "4" and $posisijabatan == "5") { //cek apakah sudah ada kadis atau belum
    $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 4");
    $ada = $statement -> rowCount() > 0;
    if ($ada){
      $_SESSION["errorPosisiKadis2"] = true;
      $error = true;
    }
  } else {
    unset($_SESSION["errorPosisiKadis1"]);
    unset($_SESSION["errorPosisiKadis2"]);
  }






  //cek jika jabatan yang dipilih adalah kabid namun tidak memilih bidang pengelolaan informasi
  if ($jabatan == "1" and $posisijabatan != "1") {
    $_SESSION["errorPosisiKabid1"] = true;
    $error = true;
  } else if ($jabatan == "1" and $posisijabatan == "1") { //cek apakah sudah ada kabid atau belum
    $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 1");
    $ada = $statement -> rowCount() > 0;
    // var_dump($ada); die;
    if ($ada) {
      $_SESSION["errorPosisiKabid2"] = true;
      $error = true;
    }
  } else {
    unset($_SESSION["errorPosisiKabid1"]);
    unset($_SESSION["errorPosisiKabid2"]);
  }



  // cek jika pilihan jabatan adalah kasi
  if ($jabatan == "2" and $posisijabatan == "1") {
    $_SESSION["errorJabatanKabid"] = true;
    $error = true;

  } else if ($jabatan == "2") {
    //jika jabatan ang dipilih adalah kasi, maka akan dilakukan pengecekan ditiap posisi jabatan.apakah sudah ada kasi atau belum
    $statement = $koneksi -> query("SELECT * FROM USER
      INNER JOIN JABATAN ON JABATAN.ID_JABATAN = USER.ID_JABATAN
      INNER JOIN POSISI_JABATAN on POSISI_JABATAN.ID_POSISI_JABATAN = USER.ID_POSISI_JABATAN
      WHERE JABATAN.ID_JABATAN = '$jabatan' and POSISI_JABATAN.ID_POSISI_JABATAN = '$posisijabatan'");
      while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
        $cekKondisi[] = $row;
      }

      //cek data jabatan sudah ada atau belum
      $cek = $statement -> rowCount() > 0;

      if ($cek) {
        $_SESSION["errorDuplikatJabatan"] = true;
        $error = true;
      }

    } else {
      unset($_SESSION["errorDuplikatJabatan"]);
      unset($_SESSION["errorJabatanKabid"]);
    }

    // cek jika kondisi jabatan adalah staf
    if ($jabatan == "3" and $posisijabatan == "1") {
      $_SESSION["errorJabatanKabid"] = true;
      $error = true;
    } else {
      unset($_SESSION["errorJabatanKabid"]);
    }



    if (!preg_match('/^[0-9]+$/',$nipbaru) or strlen($nipbaru) !== 18) {
      $_SESSION["errorNip"] = true;
      $error = true;
    }else{
      unset($_SESSION["errorNip"]);
    }

    if (!preg_match("/^[a-zA-Z_,. ]*$/",$nama)){
      $_SESSION["errorNama"] = true;
      $error = true;
    }else{
      unset($_SESSION["errorNama"]);
    }

    if (strlen($username) > 12) {
      $_SESSION["errorUsername"] = true;
      $error = true;
    }else{
      unset($_SESSION["errorUsername"]);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      unset($_SESSION["errorEmail2"]);
      $_SESSION["errorEmail1"] = true;
      $error = true;
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      unset($_SESSION["errorEmail1"]);
      $statement = $koneksi -> query("SELECT EMAIL FROM USER WHERE EMAIL = '$email'");
      $ada = $statement -> rowCount() > 0;

      if ($ada) {
        $_SESSION["errorEmail2"] = true;
        $error = true;
      }else{
        unset($_SESSION["errorEmail2"]);
      }
    }
    

    if ($error == false) {
      $statement = $koneksi -> prepare("INSERT INTO USER (NIP, ID_JABATAN, ID_POSISI_JABATAN, NAMA, ID_PANGKAT, UNIT_KERJA, USERNAME, EMAIL, PASSWORD) VALUES (:NIP, :ID_JABATAN, :ID_POSISI_JABATAN, :NAMA, :ID_PANGKAT, :UNIT_KERJA, :USERNAME, :EMAIL, SHA2(:PASSWORD, 0))");
      $statement -> bindValue(':NIP', $nipbaru);
      $statement -> bindValue(':ID_JABATAN', $jabatan);
      $statement -> bindValue(':ID_POSISI_JABATAN', $posisijabatan);
      $statement -> bindValue(':NAMA', $nama);
      $statement -> bindValue(':ID_PANGKAT', $pangkat);
      $statement -> bindValue(':UNIT_KERJA', $unitkerja);
      $statement -> bindValue(':USERNAME', $username);
      $statement -> bindValue(':EMAIL', $email);
      $statement -> bindValue(':PASSWORD', $nipbaru); //password awal menggunakan NIP
      $statement -> execute();

      $sukses = $statement -> rowCount() > 0;

      // var_dump($sukses); die;

      if($sukses) {

        // data riwayat
        $username = $_SESSION['useradmin'];
        $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$username'");
        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
          $admin[] = $row;
        }

        $id = $admin[0]['ID_ADMIN'];
        $aktivitas = "Menambahkan pengguna " . "<strong>".$nama."</strong>" ;
        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("Y-m-d H:i:s");

        $statement = $koneksi -> prepare("INSERT INTO RIWAYAT_ADMIN (ID_ADMIN, AKTIVITAS_ADMIN, TGL_RIWAYAT_ADMIN) VALUES (:ID_ADMIN, :AKTIVITAS_ADMIN, :TGL_RIWAYAT_ADMIN)");
        $statement -> bindValue(':ID_ADMIN', $id);
        $statement -> bindValue(':AKTIVITAS_ADMIN', $aktivitas);
        $statement -> bindValue(':TGL_RIWAYAT_ADMIN', $waktu);
        $statement -> execute();

        header ("Location: pengguna.php?alert=1");
        die;
      }else{
        header ("Location: pengguna.php?alert=4");
        die;
      }

    }else{
      // var_dump($statement); die;
      header ("Location: pengguna.php?alert=4");
      die;
    }
  }
