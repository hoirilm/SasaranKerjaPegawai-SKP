<?php
require '../conn/koneksi.php';

if ( !isset($_SESSION["kasi"]) ) {
   header("Location: ../proses/login.php");
   die;
}

?>
<!DOCTYPE html>
<html>
<head>
   <title>Cetak Realisasi</title>
   <script> window.print(); </script>
</head>
<body>
   <div style="font-family: calibri; width: 100%;">


      <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:1px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:1px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg .tg-1rv4{font-size:11px;text-align:right}
      .tg .tg-0ord{text-align:right}
      .tg .tg-0e41{font-size:11px; text-align:left}
      .tg .tg-s6z2{text-align:center}
      .tg .tg-baqh{text-align:center;vertical-align:top;}
      .tg .tg-214n{font-size:11px;text-align:center}
      .tg .tg-by3v{font-weight:bold;font-size:14px;text-align:center}
      .tg .tg-62xo{font-weight:bold;font-size:14px;text-align:center;vertical-align:top}
      .tg .tg-0e45{font-size:11px; text-align:center;}
      .tg .tg-d3l3{font-weight:bold;font-size:6px;text-align:center}
      .tg .tg-dx8v{font-size:12px;vertical-align:top}
      .tg .tg-pi53{font-weight:bold;font-size:12px;text-align:center}
      .tg .tg-889k{font-weight:bold;font-size:11px;text-align:center}
      .tg .tg-3sk9{font-weight:bold;font-size:12px}
      .tg .tg-yw4l{vertical-align:top}
      .tg .tg-9hbo{font-weight:bold;vertical-align:top}
      .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
      </style>
      <table class="tg">
         <tr>
            <th class="tg-62xo" colspan="14" style="border: none;">PENILAIAN CAPAIAN SASARAN KERJA<br>PEGAWAI NEGERI SIPIL</th>
         </tr>
         <tr>
            <td class="tg-dx8v" colspan="14" style="border: none;">Jangka Waktu Penilaian 01 Januari s.d. 31 Desember <?= date("Y") ?></td>
         </tr>
         <tr>
            <td class="tg-pi53" rowspan="2">NO</td>
            <td class="tg-pi53" rowspan="2">I. Kegiatan Tugas,Jabatan</td>
            <td class="tg-pi53" rowspan="2">AK</td>
            <td class="tg-pi53" colspan="4">TARGET</td>
            <td class="tg-pi53">AK</td>
            <td class="tg-pi53" colspan="4">REALISASI</td>
            <td class="tg-pi53" rowspan="2">PENGHITUNGAN</td>
            <td class="tg-pi53" rowspan="2">NILAI CAPAIAN<br>SKP</td>
         </tr>
         <tr>
            <td class="tg-889k">Kuant/Output</td>
            <td class="tg-889k">Kual/Mutu</td>
            <td class="tg-889k">Waktu</td>
            <td class="tg-889k">Biaya</td>
            <td class="tg-889k"></td>
            <td class="tg-889k">Kuant/Output</td>
            <td class="tg-889k">Kual/Mutu</td>
            <td class="tg-889k">Waktu</td>
            <td class="tg-889k">Biaya</td>
         </tr>
         <tr>
            <td class="tg-d3l3">1</td>
            <td class="tg-d3l3">2</td>
            <td class="tg-d3l3">3</td>
            <td class="tg-d3l3">4</td>
            <td class="tg-d3l3">5</td>
            <td class="tg-d3l3">6</td>
            <td class="tg-d3l3">7</td>
            <td class="tg-d3l3">8</td>
            <td class="tg-d3l3">9</td>
            <td class="tg-d3l3">10</td>
            <td class="tg-d3l3">11</td>
            <td class="tg-d3l3">12</td>
            <td class="tg-d3l3">13</td>
            <td class="tg-d3l3">14</td>
         </tr>

         <?php

         // AMBIL DATA REALISASI
         $nip = $_SESSION['userkasi'];
         $tgl = date("Y");
         $statement = $koneksi -> query("SELECT * FROM realisasi INNER JOIN skp ON SKP.ID_SKP = realisasi.ID_SKP  WHERE realisasi.NIP = '$nip' AND YEAR(TGL_SKP) = '$tgl'");
         while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $realisasi[] = $row;
         }

         $no =1;
         ?>

         <?php foreach ($realisasi as $key): ?>
            <tr>
               <td class="tg-0e45"><?= $no ?></td>
               <td class="tg-0e41"><?= $key['KEGIATAN'] ?></td>
               <td class="tg-0e45"><?= $key['AK'] ?></td>
               <td class="tg-214n"><?= $key['KUANT_OUTPUT'] ?></td>
               <td class="tg-214n"><?= $key['KUAL_MUTU'] ?></td>
               <td class="tg-214n"><?= $key['WAKTU'] ?></td>
               <td class="tg-214n"><?= $key['BIAYA'] ?></td>

               <td class="tg-214n"><?= $key['R_AK'] ?></td>
               <td class="tg-214n"><?= $key['R_KUANT_OUTPUT'] ?></td>
               <td class="tg-214n"><?= $key['R_KUAL_MUTU'] ?></td>
               <td class="tg-214n"><?= $key['R_WAKTU'] ?></td>
               <td class="tg-214n"><?= $key['R_BIAYA'] ?></td>
               <td class="tg-1rv4"><?= number_format($key['PENGHITUNGAN'],2)?></td>
               <td class="tg-1rv4"><?= number_format($key['NILAI_CAPAI_SKP'],2) ?></td>
            </tr>
            <?php $no ++ ?>
         <?php endforeach; ?>

         <?php

         $nilai = 0;
         $jumlahbagi = $no-1;

         // DIJUMLAHKAN
         foreach ($realisasi as $key => $value) {
            $nilai += $value['NILAI_CAPAI_SKP'];
         }
         // DIBAGI
         $nilai_capai_final = $nilai / $jumlahbagi;
         ?>

         <tr>
            <td class="tg-yw4l" colspan="13"></td>
            <td class="tg-yw4l"> </td>
         </tr>
         <tr>
            <td class="tg-by3v" colspan="13" rowspan="2">Nilai Capaian SKP</td>
            <td class="tg-amwm"><?= number_format($nilai_capai_final,2) ?></td>
         </tr>
         <tr>
            <?php if ($nilai_capai_final < 40) {
               $hasil = "(Buruk)";
            }else if ($nilai_capai_final > 40 &&  $nilai_capai_final < 60) {
               $hasil = "(Cukup)";
            }else if ($nilai_capai_final > 60 &&  $nilai_capai_final < 80) {
               $hasil = "(Baik)";
            }else{
               $hasil = "(Sangat Baik)";
            } ?>
            <td class="tg-amwm"><?= $hasil ?></td>
         </tr>

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


         <tr>
            <td class="tg-baqh" colspan="14" style="padding-top: 20px; border: none; padding-left: 82%;">Bangkalan, <?= $tanggal ?><br>Pejabat Penilai,</td>
         </tr>
         <tr>
            <td class="tg-yw4l" colspan="14" style="border: none; padding: 30px;"></td>
         </tr>

         <?php
         // AMBIL DATA ATASAN
         $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 1");
         while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $atasan[] = $row;
         }

         ?>

         <tr>
            <td class="tg-amwm" colspan="14" style="border: none; padding-left: 82%;"><u><?= $atasan[0]['NAMA'] ?></u><br><?= $atasan[0]['NIP'] ?></td>
         </tr>
      </table>


   </div>
</body>
</html>
