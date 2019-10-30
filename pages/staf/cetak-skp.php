<?php
require '../conn/koneksi.php';

if ( !isset($_SESSION["staf"]) ) {
  header("Location: ../proses/login.php");
  die;
}

// ambil jumlah skp dari user yang sedang login
$nip = $_SESSION['userstaf'];
$periode = $_POST['periode'];
$statement = $koneksi -> query("SELECT * FROM SKP WHERE NIP = '$nip' AND YEAR(TGL_SKP) = '$periode'");
$cek1 = $statement -> rowCount() > 0;

if ($cek1) {
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $valid1[] = $row;
  }
  $jumlahskp = count($valid1);
} else {
  $jumlahskp = 0;
}

// ambil jumlah skp yang sudah diterima
$statement = $koneksi -> query("SELECT * FROM SKP WHERE ID_STATUS = 2 AND NIP = '$nip' AND YEAR(TGL_SKP) = '$periode'");
$cek2 = $statement -> rowCount() > 0;
if ($cek2) {
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $valid2[] = $row;
  }
  $jumlahstatus = count($valid2);
} else {
  $jumlahstatus = 0;
}

// CEK KONDISI SKP SUDAH DITERIMA SEMUA ATAU TIDAK. JIKA TIDAK, MAKA AKAN DILEMPAR KE HALAMAN SEBELUMNYA
if ($jumlahskp !== $jumlahstatus or $jumlahskp === 0) {
  header("Location: skpsaya.php");
  die;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Cetak SKP</title>
  <script> window.print(); </script>
</head>
<body>
  <div style="font-family: calibri; width: 100%">


    <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 0px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 0px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-ee5k{font-weight:bold;color:#000000;vertical-align:top}
    .tg .tg-1pye{font-weight:bold;color:#000000;text-align:center;vertical-align:top}
    .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-yw4l{vertical-align:top}
    .tg .tg-hgcj{font-weight:bold;text-align:center}
    </style>
    <table class="tg">
      <colgroup>
        <col style="width: 36px">
        <col style="width: 173px">
        <col style="width: 343px">
        <col style="width: 35px">
        <col style="width: 86px">
        <col style="width: 86px">
        <col style="width: 115px">
        <col style="width: 115px">
        <col style="width: 115px">
      </colgroup>
      <tr>
        <th class="tg-amwm" colspan="9" style="border: none;">SASARAN KERJA<br>PEGAWAI NEGERI SIPIL</th>
      </tr>
      <tr>
        <td class="tg-1pye">NO</td>
        <td class="tg-ee5k" colspan="2">I. PEJABAT PENILAI</td>
        <td class="tg-1pye">NO</td>
        <td class="tg-ee5k" colspan="5">II. PEGAWAI NEGERI SIPIL YANG DINILAI</td>
      </tr>
      <tr>
        <td class="tg-baqh">1<br>2<br>3<br>4<br>5</td>
        <td class="tg-yw4l">Nama<br>NIP<br>Pangkat/Gol.Ruang<br>Jabatan<br>Unit Kerja</td>
        <td class="tg-yw4l">

          <?php
          // AMBIL DATA ATASAN
          $nip = $_SESSION['userstaf'];
          $statement = $koneksi -> query("SELECT * FROM USER WHERE NIP = '$nip'");
          while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $staf[] = $row;
          }

          $idjabatan = $staf[0]["ID_POSISI_JABATAN"];
          $statement = $koneksi -> query("SELECT * FROM USER
            INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT
            INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN
            INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN
            WHERE USER.ID_JABATAN = 2 AND USER.ID_POSISI_JABATAN = '$idjabatan'");
            while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
              $atasan[] = $row;
            }
            ?>

            <?= $atasan[0]["NAMA"] ?><br>
            <?= $atasan[0]["NIP"] ?><br>
            <?= $atasan[0]["JENIS_PANGKAT"] . " (" . $atasan[0]["GOLONGAN"] . " / " .$atasan[0]["RUANG"] . ")"  ?><br>
            <?= $atasan[0]["JABATAN"] . " " . $atasan[0]["POSISI_JABATAN"] ?><br>
            <?= $atasan[0]["UNIT_KERJA"] ?>
          </td>
          <td class="tg-baqh">1<br>2<br>3<br>4<br>5</td>
          <td class="tg-yw4l" colspan="2">Nama<br>NIP<br>Pangkat/Gol.Ruang<br>Jabatan<br>Unit Kerja</td>
          <td class="tg-yw4l" colspan="3">
            <?php
            // AMBIL DATA PENGGUNA
            $nip = $_SESSION['userstaf'];
            $statement = $koneksi -> query("SELECT * FROM USER
              INNER JOIN PANGKAT ON USER.ID_PANGKAT = PANGKAT.ID_PANGKAT
              INNER JOIN JABATAN ON USER.ID_JABATAN = JABATAN.ID_JABATAN
              INNER JOIN POSISI_JABATAN ON USER.ID_POSISI_JABATAN = POSISI_JABATAN.ID_POSISI_JABATAN
              WHERE USER.NIP = '$nip'");
              while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                $pengguna[] = $row;
              }
              ?>

              <?= $pengguna[0]["NAMA"] ?><br>
              <?= $pengguna[0]["NIP"] ?><br>
              <?= $pengguna[0]["JENIS_PANGKAT"] . " (" . $pengguna[0]["GOLONGAN"] . " / " .$pengguna[0]["RUANG"] . ")"  ?><br>
              <?= $pengguna[0]["JABATAN"] . " " . $pengguna[0]["POSISI_JABATAN"] ?><br>
              <?= $pengguna[0]["UNIT_KERJA"] ?>
            </td>
          </tr>
          <tr>
            <td class="tg-s6z2" rowspan="2">NO</td>
            <td class="tg-hgcj" colspan="2" rowspan="2">III. KEGIATAN TUGAS JABATAN</td>
            <td class="tg-hgcj" rowspan="2">AK</td>
            <td class="tg-hgcj" colspan="5">TARGET</td>
          </tr>
          <tr>
            <td class="tg-hgcj" colspan="2">KUANT/OUTPUT</td>
            <td class="tg-hgcj">KUAL/MUTU</td>
            <td class="tg-hgcj">WAKTU</td>
            <td class="tg-hgcj">BIAYA</td>
          </tr>

          <?php

          // AMBIL DATA SKP
          $nip = $_SESSION['userstaf'];
          $statement = $koneksi -> query("SELECT * FROM SKP
            INNER JOIN USER ON USER.NIP = SKP.NIP
            -- INNER JOIN STATUS ON STATUS.ID_STATUS = SKP.ID_STATUS
            WHERE USER.NIP = '$nip' AND YEAR(TGL_SKP) = '$periode'");
            while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
              $skp[] = $row;
            }

            $no = 1;
            ?>

            <?php foreach ($skp as $key) { ?>
              <tr>
                <td class="tg-s6z2"><?= $no ?></td>
                <td class="tg-031e" colspan="2"><?= $key["KEGIATAN"] ?></td>
                <td class="tg-s6z2"><?= $key["AK"] ?></td>
                <td class="tg-s6z2" colspan="2"><?= $key["KUANT_OUTPUT"] ?></td>
                <td class="tg-s6z2"><?= $key["KUAL_MUTU"] ?></td>
                <td class="tg-s6z2"><?= $key["WAKTU"] ?></td>
                <td class="tg-s6z2"><?= $key["BIAYA"] ?></td>
              </tr>
              <?php $no ++ ?>
            <?php } ?>
            <tr>

              <?php
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

              $hari = date("j"); //format hari 1-31
              $bulan = date("m"); //format bulan 01-12
              $tahun = date("Y"); //format tahun dalam angka

              $tanggal = $hari . " " . $arrbulan[ (int)$bulan[1] ] . " " . $tahun;



              ?>
              <td style="border: none;" class="tg-yw4l" colspan="4"></td>
              <td style="border: none; padding-top: 10PX;" class="tg-baqh" colspan="5">Bangkalan, <?= $tanggal ?></td>
            </tr>
            <tr>
              <td style="border: none;" class="tg-yw4l"></td>
              <td style="border: none;" class="tg-baqh" colspan="2">Pejabat Penilai,</td>
              <td style="border: none;" class="tg-yw4l"></td>
              <td style="border: none;" class="tg-baqh" colspan="5">Pegawai Negeri Sipil Yang Dinilai</td>
            </tr>
            <tr>
              <td style="border: none; padding: 30px;" class="tg-yw4l" colspan="9"></td>
            </tr>
            <tr>
              <td style="border: none;" class="tg-yw4l"></td>
              <td style="border: none;" class="tg-amwm" colspan="2"><u><?= $atasan[0]["NAMA"] ?></u><br><?= $atasan[0]["NIP"] ?></td>
              <td style="border: none;" class="tg-yw4l"></td>
              <td style="border: none;" class="tg-amwm" colspan="5"><u><?= $pengguna[0]["NAMA"] ?></u><br><?= $pengguna[0]["NIP"] ?></td>
            </tr>
          </table>


          Catatan : <br>
          * AK Bagi PNS yang memangku jabatan fungsional tertentu


        </div>
      </body>
      </html>
