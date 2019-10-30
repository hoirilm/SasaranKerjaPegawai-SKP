<?php
require '../conn/koneksi.php';


if (isset($_POST['tambah_skp'])){

  $error = false;

   // CEK MASA SKP SEDANG DIBUKA ATAU TIDAK
   $cekstatusskp = $koneksi -> prepare("SELECT * FROM MASA_SKP WHERE ID_STATUS = :ID_STATUS");
   $cekstatusskp -> bindValue(':ID_STATUS', 6);
   $cekstatusskp -> execute();
   $masaskp = $cekstatusskp -> rowCount() > 0;

   if ($masaskp){
      // var_dump($statement); die;
      header ("Location: skp-saya.php?alert=4");
      die;
   }

   $nip = $_SESSION['userstaf'];
   date_default_timezone_set("Asia/Jakarta");
   $tanggal = date("Y-m-d");

   $kegiatan = $_POST['kegiatan'];
   $ak = $_POST['ak'];
   $kuant = $_POST['kuantoutput1'] . " " . $_POST['kuantoutput2'];
   $kual = $_POST['kualmutu'];
   $waktu = $_POST['waktu1'] . " " . $_POST['waktu2'];
   $biaya = $_POST['biaya'];


   if (!preg_match('/^[0-9]+$/',$_POST['kuantoutput1']) || $_POST['kuantoutput1'] == "0") {
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

   var_dump($kegiatan);
   var_dump($ak);
   var_dump($kuant);
   var_dump($kual);
   var_dump($waktu);
   var_dump($biaya);
   var_dump($error);



   if ($error == false) {
      $statement = $koneksi -> prepare("INSERT INTO SKP (ID_SKP, ID_STATUS, NIP, KEGIATAN, AK, KUANT_OUTPUT, KUAL_MUTU, WAKTU, BIAYA, TGL_SKP) VALUES (:ID_SKP, :ID_STATUS, :NIP, :KEGIATAN, :AK, :KUANT_OUTPUT, :KUAL_MUTU, :WAKTU, :BIAYA, :TGL_SKP)");
      $statement -> bindValue(':ID_SKP', '');
      $statement -> bindValue(':ID_STATUS', 1); //KARENA BARU MEMBUAT, MAKA STATUS 1 ATAU BELUM ADA STATUS
      $statement -> bindValue(':NIP', $nip);
      $statement -> bindValue(':KEGIATAN', $kegiatan);
      $statement -> bindValue(':AK', $ak);
      $statement -> bindValue(':KUANT_OUTPUT', $kuant );
      $statement -> bindValue(':KUAL_MUTU', $kual ."%");
      $statement -> bindValue(':WAKTU', $waktu);
      $statement -> bindValue(':BIAYA', $biaya);
      $statement -> bindValue(':TGL_SKP', $tanggal);
      $statement -> execute();

      // while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
      //    $kasi[] = $row;
      // }

      $sukses = $statement -> rowCount() > 0;

      if($sukses) {
         header("Location: skp-saya.php?alert=1");
         die;
      }else{
         // var_dump($statement); die;
         header ("Location: skp-saya.php?alert=4#error1");
         die;
      }
   } else {
      header ("Location: skp-saya.php?alert=4#error2");
      die;
   }
}
?>
