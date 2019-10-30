<?php
require '../conn/koneksi.php';


if (isset($_POST["gantiPass"])) {
  $error = false;
  $nip = $_SESSION["userkabid"];
  $statement = $koneksi -> query("SELECT * FROM USER WHERE NIP = '$nip'");
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $gantipass[] = $row;
  }

  $passDatabase = $gantipass[0]["PASSWORD"]; //pass yang ada di datanase
  $passLama = hash('sha256', $_POST["passLama"]); //data password dari inputan user
  $passwordBaru = $_POST["passBaru"];
  $cekstring = strlen($_POST["passBaru"]);
  $confirmPassBaru = $_POST["confirmPassBaru"];

  if($passDatabase === $passLama) {
    if ($passwordBaru !== $confirmPassBaru) {
      $_SESSION["errorEditPass"] = true;
      $error = true;
    } else if ($cekstring < 6) {
      $_SESSION["errorEditPassLen"] = true;
      $error = true;
    }
  } else {
    $_SESSION["errorEditPassLama"] = true;
    $error = true;
  }

  if ($error === false) {
    $statement = $koneksi -> prepare ("UPDATE USER SET PASSWORD =  SHA2(:PASSWORD, 0)  WHERE NIP = '$nip'");
    $statement -> bindValue(':PASSWORD', $passwordBaru);;
    $statement -> execute();
    header("Location: ../../index4.php?alert=2");
  } else {
    header("Location: ../../index4.php?alert=4");
  }


}


if (isset($_POST["ubah_skp"])) {

  $error = false;

  $id = $_POST["id"];
  date_default_timezone_set("Asia/Jakarta");
  $tanggal = date("Y-m-d");

  $kegiatan = $_POST['kegiatan'];
  $kuant = $_POST['kuantoutput1'] . " " . $_POST['kuantoutput2'];
  $kual = $_POST['kualmutu'];
  $waktu = $_POST['waktu1'] . " " . $_POST['waktu2'];

  if (!preg_match('/^[0-9]+$/',$_POST['kuantoutput1']) or $_POST['kuantoutput1'] == "0") {
    $_SESSION["errorKuant"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorKuant"]);
  }

  if (!preg_match('/^[0-9]+$/',$kual) or intval($kual) > 100) {
    $_SESSION["errorKual"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorKual"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['waktu1']) or intval($_POST['waktu1']) > 12 ) {
    $_SESSION["errorWaktu"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorWaktu"]);
  }

  if ($error == false) {
    $statement = $koneksi -> prepare ("UPDATE SKP SET KEGIATAN = :KEGIATAN, KUANT_OUTPUT = :KUANT_OUTPUT, KUAL_MUTU = :KUAL_MUTU, WAKTU = :WAKTU, TGL_SKP = :TGL_SKP  WHERE ID_SKP = '$id'");
    $statement -> bindValue(':KEGIATAN', $kegiatan);
    $statement -> bindValue(':KUANT_OUTPUT', $kuant);
    $statement -> bindValue(':KUAL_MUTU', $kual);
    $statement -> bindValue(':WAKTU', $waktu);
    $statement -> bindValue(':TGL_SKP', $tanggal);
    $statement -> execute();

    header("Location: skp-saya.php?alert=2");
    die;
  }else{
    header("Location: skp-saya.php?alert=4");
    die;
  }
}

?>
