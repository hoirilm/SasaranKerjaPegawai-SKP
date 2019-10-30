<?php
require '../conn/koneksi.php';

if (isset($_POST["gantiPass"])) {
  $error = false;
  $nip = $_SESSION["userkasi"];
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
    header("Location: ../../index3.php?alert=2");
  } else {
    header("Location: ../../index3.php?alert=4");
  }


}


if (isset($_POST["ubah_realisasi"])){
  $error = 0;

  date_default_timezone_set("Asia/Jakarta");
  $tanggal = date("Y-m-d");

  // menghitung banyak skp yang dinilai, dan dijadikan patokan untuk looping
  $jumlahskp = count($_POST['idskp']);

  for ($i=0; $i < $jumlahskp; $i++) {

    //RUMUS===================================================================
    $idskp = $_POST['idskp'][$i];
    $statement = $koneksi -> query("SELECT * FROM SKP WHERE ID_SKP = '$idskp'");
    $skp = $statement -> fetch(PDO::FETCH_ASSOC);

    // RUMUS PERSEN WAKTU
    $waktu_realisasi = (float) $_POST['waktu1'][$i];
    $waktu_target = (float) $skp['WAKTU'];
    $persen_waktu = 100 - ($waktu_realisasi / $waktu_target * 100);


    //RUMUS KUANTITAS
    $kuantitas_realisasi = (float) $_POST['kuantoutput1'][$i];
    $kuantitas_target = (float) $skp['KUANT_OUTPUT'];
    $kuantitas = $kuantitas_realisasi / $kuantitas_target * 100;


    //RUMUS KUALITAS
    $kualitas_realisasi = (float) $_POST['kualmutu'][$i];
    $kualitas_target = (float) $skp['KUAL_MUTU'];
    $kualitas = $kualitas_realisasi / $kualitas_target * 100;

    //RUMUS WAKTU
    $kurang24 = ((1.76 * $waktu_target - $waktu_realisasi) / $waktu_target) * 100;
    $lebih24 = 76 - ((((1.76 * $waktu_target - $waktu_realisasi) / $waktu_target) * 100) - 100);

    if ($persen_waktu > $lebih24) {
      $waktu = (float) $lebih24;
    } else if ($persen_waktu < $kurang24) {
      $waktu = (float) $kurang24;
    }
    $hasilpenghitungan[] = $kuantitas + $kualitas + $waktu;

    // RUMUS NILAI CAPAI
    if ($skp['BIAYA'] == "0") {
      if ($_POST['biaya'][$i] == "0") {
        $nilai_capai[] = $hasilpenghitungan[$i]/3;
      }else{
        $nilai_capai[] = $hasilpenghitungan[$i]/4;
      }
    }else{
      $nilai_capai[] = $hasilpenghitungan[$i]/4;
    }

    //=======================================================================

    // VALIDASI
    $kuantInput = intval($_POST['kuantoutput1'][$i]);
    $kuantDb = intval($skp['KUANT_OUTPUT']);
    if (!preg_match('/^[0-9]+$/',$_POST['kuantoutput1'][$i]) or $_POST['kuantoutput1'][$i] == "0" or $kuantInput > $kuantDb) {
      $_SESSION["errorKuant"] = true;
      $error++;
    } else {
      unset($_SESSION["errorKuant"]);
    }

    $kualInput = intval($_POST['kualmutu'][$i]);
    $kualDb = intval($skp['KUAL_MUTU']);
    if (!preg_match('/^[0-9]+$/',str_replace('%','',$_POST['kualmutu'])[$i]) or intval($_POST['kualmutu'][$i]) > 100 or $kualInput > $kualDb) {
      $_SESSION["errorKual"] = true;
      $error++;
    } else {
      unset($_SESSION["errorKual"]);
    }

    $waktuInput = intval($_POST['waktu1'][$i]);
    $waktuDb = intval($skp['WAKTU']);
    if (!preg_match('/^[0-9]+$/',$_POST['waktu1'][$i]) or intval($_POST['waktu1'][$i]) > 12 or  $waktuInput > $waktuDb) {
      $_SESSION["errorWaktu"] = true;
      $error++;
    } else {
      unset($_SESSION["errorWaktu"]);
    }

    $ak[] = $_POST['ak'][$i];
    $kuant1[] = $_POST['kuantoutput1'][$i];
    $kuant2[] = $_POST['kuantoutput2'][$i];
    $kual[] = str_replace('%','',$_POST['kualmutu'])[$i];
    $waktu1[] = $_POST['waktu1'][$i];
    $waktu2[] = $_POST['waktu2'][$i];
    $biaya[] = $_POST['biaya'][$i];
  }

  var_dump($error);echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";

  echo "ini adalah ak: ";var_dump($ak);echo "<br>";echo "<br>";
  echo "ini adalah kuant1: ";var_dump($kuant1);echo "<br>";echo "<br>";
  echo "ini adalah kuant2: ";var_dump($kuant2);echo "<br>";echo "<br>";
  echo "ini adalah kual: ";var_dump($kual);echo "<br>";echo "<br>";
  echo "ini adalah waktu1: ";var_dump($waktu1);echo "<br>";echo "<br>";
  echo "ini adalah waktu2: ";var_dump($waktu2);echo "<br>";echo "<br>";
  echo "ini adalah biaya: ";var_dump($biaya);echo "<br>";echo "<br>";
  echo "ini adalah perhitungan: ";var_dump($hasilpenghitungan);echo "<br>";echo "<br>";
  echo "ini adalah nilai capai: ";var_dump($nilai_capai);echo "<br>";echo "<br>";
  echo "ini adalah tgl realisasi: ";var_dump($tanggal);echo "<br>";echo "<br>";
  // die;

  if ($error === 0){
    for ($i=0; $i < $jumlahskp; $i++) {
      $statement = $koneksi -> prepare("UPDATE REALISASI SET R_AK = :R_AK, R_KUANT_OUTPUT = :R_KUANT_OUTPUT, R_KUAL_MUTU = :R_KUAL_MUTU, R_WAKTU = :R_WAKTU, R_BIAYA = :R_BIAYA, PENGHITUNGAN = :PENGHITUNGAN, NILAI_CAPAI_SKP = :NILAI_CAPAI_SKP, TGL_REALISASI = :TGL_REALISASI WHERE ID_REALISASI = :ID_REALISASI");
      $statement -> bindValue(':ID_REALISASI', $_POST['idrealisasi'][$i]);
      $statement -> bindValue(':R_AK', $ak[$i]);
      $statement -> bindValue(':R_KUANT_OUTPUT', $kuant1[$i] . " " . $kuant2[$i] );
      $statement -> bindValue(':R_KUAL_MUTU', $kual[$i]."%");
      $statement -> bindValue(':R_WAKTU', $waktu1[$i] . " " . $waktu2[$i]);
      $statement -> bindValue(':R_BIAYA', $biaya[$i]);
      $statement -> bindValue(':PENGHITUNGAN', $hasilpenghitungan[$i]);
      $statement -> bindValue(':NILAI_CAPAI_SKP', $nilai_capai[$i]);
      $statement -> bindValue(':TGL_REALISASI', $tanggal);
      $statement -> execute();
    }

    header("Location: realisasi-staf.php?alert=1");
    die;
  }else{
    // var_dump($statement); die;
    header ("Location: realisasi-staf.php?alert=4");
    die;
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





if (isset($_POST["ubah_nilai_kerja"])) {

  $error = false;

  if (!preg_match('/^[0-9]+$/',$_POST['orientasi_pelayanan'])) {
    $_SESSION["errorOrientasi"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorOrientasi"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['integritas'])) {
    $_SESSION["errorIntegritas"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorIntegritas"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['komitmen'])) {
    $_SESSION["errorKomitmen"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorKomitmen"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['disiplin'])) {
    $_SESSION["errorDisiplin"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorDisiplin"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['kerjasama'])) {
    $_SESSION["errorKerjaSama"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorKerjaSama"]);
  }

  if (!preg_match('/^[0-9]+$/',$_POST['kepemimpinan'])) {
    $_SESSION["errorKepemimpinan"] = true;
    $error = true;
  } else {
    unset($_SESSION["errorKepemimpinan"]);
  }


  if ($error == false) {

    $nip = $_POST["nip"];
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");

    $orientasi = $_POST["orientasi_pelayanan"];
    $integritas = $_POST["integritas"];
    $komitmen = $_POST["komitmen"];
    $disiplin = $_POST["disiplin"];
    $kerjasama = $_POST["kerjasama"];
    $kepemimpinan = $_POST["kepemimpinan"];
    $jumlah = $orientasi + $integritas + $komitmen + $disiplin + $kerjasama + $kepemimpinan;
    // $nilai_capaian_skp = $nilai / count($tampungRealisasi) * 0.6;
    $nilai_rata = $jumlah/5;

    $statement = $koneksi -> prepare ("UPDATE NILAI_KERJA SET ORIENTASI_PELAYANAN = :ORIENTASI_PELAYANAN, INTEGRITAS = :INTEGRITAS, KOMITMEN = :KOMITMEN, DISIPLIN = :DISIPLIN, KERJASAMA = :KERJASAMA, KEPEMIMPINAN = :KEPEMIMPINAN, JUMLAH = :JUMLAH, NILAI_RATA = :NILAI_RATA, TGL_NILAI = :TGL_NILAI  WHERE NIP = '$nip' AND YEAR(TGL_NILAI) = '$tanggal'");
    $statement -> bindValue(':ORIENTASI_PELAYANAN', $orientasi);
    $statement -> bindValue(':INTEGRITAS', $integritas);
    $statement -> bindValue(':KOMITMEN', $komitmen);
    $statement -> bindValue(':DISIPLIN', $disiplin);
    $statement -> bindValue(':KERJASAMA', $kerjasama);
    $statement -> bindValue(':KEPEMIMPINAN', $kepemimpinan);
    $statement -> bindValue(':JUMLAH', $jumlah);
    $statement -> bindValue(':NILAI_RATA', $nilai_rata);
    $statement -> bindValue(':TGL_NILAI', $tanggal);
    $statement -> execute();

    header("Location: realisasi-staf.php?alert=1");
    die;

  } else {
    header("Location: realisasi-staf.php?alert=4");
    die;
  }

}

?>
