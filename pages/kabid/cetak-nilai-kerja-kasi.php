<?php

require '../conn/koneksi.php';

if ( !isset($_SESSION["kabid"]) ) {
  header("Location: ../proses/login.php");
  die;
}

// AMBIL DATA PENGGUNA
$nipkasi = $_POST["nipkasi"];
$statement = $koneksi -> query("SELECT * FROM USER INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN WHERE USER.NIP = '$nipkasi'");
while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
  $pengguna[] = $row;
}


// // AMBIL DATA ATASAN
// $idjabatan = $pengguna[0]["ID_POSISI_JABATAN"];
// $statement = $koneksi -> query("SELECT * FROM USER
//   INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT
//   INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN
//   INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN WHERE USER.ID_JABATAN = 2 AND USER.ID_POSISI_JABATAN = '$idjabatan'");
//   while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
//     $atasan[] = $row;
//   }

// ATASAN
$idjabatan = $pengguna[0]["ID_POSISI_JABATAN"];
$a = $koneksi -> query("SELECT * FROM USER
  INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT
  INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN
  INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN
  WHERE USER.ID_JABATAN = 1");
  while ($row = $a -> fetch(PDO::FETCH_ASSOC)){
    $atasan[] = $row;
  }

  // ATASAN PENILAI
  $idjabatan = $pengguna[0]["ID_POSISI_JABATAN"];
  $a = $koneksi -> query("SELECT * FROM USER
    INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT
    INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN
    INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN
    WHERE USER.ID_JABATAN = 4");
    while ($row = $a -> fetch(PDO::FETCH_ASSOC)){
      $atasan_penilai[] = $row;
    }

    // AMBIL NILAI SKP LALU DIHITUNG
    $tgl = date("Y");
    $b = $koneksi -> query("SELECT * FROM realisasi
      INNER JOIN skp ON SKP.ID_SKP = realisasi.ID_SKP
      WHERE realisasi.NIP = '$nipkasi' AND YEAR(TGL_SKP) = '$tgl'");
      while ($row = $b -> fetch(PDO::FETCH_ASSOC)){
        $skp[] = $row;
      }

      $nilai = 0;
      $jumlahbagi = count($skp);

      // DIJUMLAHKAN
      foreach ($skp as $key => $value) {
        $nilai += $value['NILAI_CAPAI_SKP'];
      }
      // DIBAGI
      $nilai_capai_final = $nilai / $jumlahbagi;



      // AMBIL DATA NILAI KERJA
      $id_penilaian = $_POST["id_penilaian"];
      $c = $koneksi -> query("SELECT * FROM NILAI_KERJA WHERE ID_PENILAIAN = '$id_penilaian'");
      while ($row = $c -> fetch(PDO::FETCH_ASSOC)){
        $nilai_kerja[] = $row;
      }

      //DIJUMLAHKAN
      $jumlah_total =
      $nilai_kerja[0]["ORIENTASI_PELAYANAN"] +
      $nilai_kerja[0]["INTEGRITAS"] +
      $nilai_kerja[0]["KOMITMEN"] +
      $nilai_kerja[0]["DISIPLIN"] +
      $nilai_kerja[0]["KERJASAMA"] +
      $nilai_kerja[0]["KEPEMIMPINAN"];

      //DIBAGI
      $jumlah_rata = $jumlah_total / 6;

      function cekNilai($nilai){
        if ($nilai <= 50) {
          echo "(Buruk)";
        } else if ($nilai <= 60) {
          echo "(Sedang)";
        } else if ($nilai <= 75){
          echo "(Cukup)";
        } else if ($nilai <= 90.99){
          echo "(Baik)";
        } else {
          echo "(Sangat Baik)";
        }
      }



      // AMBIL TANGGAL SEKARANG
      date_default_timezone_set("Asia/Jakarta");

      $arrbulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );

      $hari = explode("-", $_POST["dibuat"]); //format hari 1-31
      $bulan = explode("-", $_POST["dibuat"]); //format bulan 01-12
      $tahun = explode("-", $_POST["dibuat"]); //format tahun dalam angka
      $tanggaldibuat = $hari[2] . " " . $arrbulan[ (int)$bulan[1] ] . " " . $tahun[0];

      $hari = explode("-", $_POST["diterima1"]); //format hari 1-31
      $bulan = explode("-", $_POST["diterima1"]); //format bulan 01-12
      $tahun = explode("-", $_POST["diterima1"]); //format tahun dalam angka
      $tanggalditerima1 = $hari[2] . " " . $arrbulan[ (int)$bulan[1] ] . " " . $tahun[0];

      $hari = explode("-", $_POST["diterima2"]); //format hari 1-31
      $bulan = explode("-", $_POST["diterima2"]); //format bulan 01-12
      $tahun = explode("-", $_POST["diterima2"]); //format tahun dalam angka
      $tanggalditerima2 = $hari[2] . " " . $arrbulan[ (int)$bulan[1] ] . " " . $tahun[0];

      include '../table/table1.php';
      include '../table/table2.php';
      include '../table/table3.php';
      include '../table/table3.php';
      include '../table/table4.php';

      ?>

      <script> window.print(); </script>
