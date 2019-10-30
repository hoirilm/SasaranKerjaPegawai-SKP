<!DOCTYPE html>
<html>
<head>
	<title>Cetak SKP</title>
	<script> window.print(); </script>
</head>
<style type="text/css">
table{
	border-collapse: collapse;
}

th,td
{
	border-style: all;
	border : 1px solid black;
}
h3{
	text-align: center;
	margin-bottom: 0%;
	margin-top: 0%;
}
</style>
<body>
	<div style=" width: 100%;">
		<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-us36{border-color:inherit;vertical-align:top}
.tg .tg-mjfx{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-es7u{font-family:"Times New Roman", Times, serif !important;;border-color:inherit;vertical-align:bottom; padding-bottom: 0px;}
.tg .tg-7btt{font-weight:bold;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-p8bj{font-weight:bold;border-color:inherit;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 48.010417px">
<col style="width: 270.010417px">
<col style="width: 400.010417px">
</colgroup>
  <tr>
    <th class="tg-us36" colspan="3" style="border: none;"><img src="../../images/logo.png" width="10%"></th>
  </tr>
  <tr>
    <td class="tg-mjfx" colspan="3" style="border: none;">PENILAIAN PRESTASI KERJA</td>
  </tr>
  <tr>
    <td class="tg-mjfx" colspan="3" style="border: none;">PEGAWAI NEGERI SIPIL</td>
  </tr>
  <tr>
    <td class="tg-es7u" colspan="2" style="border: none; ">DEPARTEMEN DALAM NEGERI</td>
    <td class="tg-es7u" style="border: none; padding-left: 150px; text-align: right;">JANGKA WAKTU PENILAIAN</td>
  </tr>
  <tr>
    <td class="tg-es7u" colspan="2" style="border: none; border">PEMERINTAH KABUPATEN BANGKALAN</td>
    <td class="tg-es7u" style="border: none; padding-left: 150px; text-align: right;">BULAN : Januari s/d 31 Desember <?= date("Y") ?> </td>
  </tr>
  <tr>
    <td class="tg-7btt" rowspan="6"	>1.</td>
    <td class="tg-p8bj" colspan="2">YANG DINILAI</td>
  </tr>
  <tr>
    <td class="tg-us36">a. Nama</td>
    <td class="tg-us36"><?= $pengguna[0]["NAMA"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">b. N I P</td>
    <td class="tg-us36"><?= $pengguna[0]["NIP"] ?> </td>
  </tr>
  <tr>
    <td class="tg-us36">c. Pangkat, Golongan ruang, TMT</td>
    <td class="tg-us36"><?= $pengguna[0]["JENIS_PANGKAT"] . " (" . $pengguna[0]["GOLONGAN"] . " / " .$pengguna[0]["RUANG"] . ")" ?></td>
  </tr>
  <tr>
    <td class="tg-us36">d. Jabatan/Pekerjaan</td>
    <td class="tg-us36"><?= $pengguna[0]["JABATAN"] . " " . $pengguna[0]["POSISI_JABATAN"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">e. Unit Organisasi</td>
    <td class="tg-us36"><?= $pengguna[0]["UNIT_KERJA"] ?></td>
  </tr>
  <tr>
    <td class="tg-7btt" rowspan="6">2.</td>
    <td class="tg-p8bj" colspan="2">PEJABAT PENILAI</td>
  </tr>
  <tr>
    <td class="tg-us36">a. N a m a</td>
    <td class="tg-us36"><?= $atasan[0]["NAMA"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">b N I P</td>
    <td class="tg-us36"><?= $atasan[0]["NIP"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">c. Pangkat, Golongan ruang, TMT</td>
    <td class="tg-us36"><?= $pengguna[0]["JENIS_PANGKAT"] . " (" . $pengguna[0]["GOLONGAN"] . " / " .$pengguna[0]["RUANG"] . ")" ?></td>
  </tr>
  <tr>
    <td class="tg-us36">d. Jabatan/Pekerjaan</td>
    <td class="tg-us36"><?= $pengguna[0]["JABATAN"] . " " . $pengguna[0]["POSISI_JABATAN"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">e. Unit Organisasi</td>
    <td class="tg-us36"><?= $pengguna[0]["UNIT_KERJA"] ?></td>
  </tr>
  <tr>
    <td class="tg-7btt" rowspan="6">3.</td>
    <td class="tg-p8bj" colspan="2">ATASAN PEJABAT PENILAI</td>
  </tr>
  <tr>
    <td class="tg-us36">a. N a m a</td>
    <td class="tg-us36"><?= $atasan_penilai[0]["NAMA"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">b. N I P</td>
    <td class="tg-us36"><?= $atasan_penilai[0]["NIP"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">c. Pangkat, Golongan ruang, TMT</td>
    <td class="tg-us36"><?= $atasan_penilai[0]["JENIS_PANGKAT"] . " (" . $atasan_penilai[0]["GOLONGAN"] . " / " .$atasan_penilai[0]["RUANG"] . ")" ?></td>
  </tr>
  <tr>
    <td class="tg-us36">d. Jabatan/Pekerjaan</td>
    <td class="tg-us36"><?= $atasan_penilai[0]["JABATAN"] . " " . $atasan_penilai[0]["POSISI_JABATAN"] ?></td>
  </tr>
  <tr>
    <td class="tg-us36">e. Unit Organisasi</td>
    <td class="tg-us36"><?= $atasan_penilai[0]["UNIT_KERJA"] ?></td>
  </tr>
</table>

<br>
<br>
<br>
<br>
<br>
<br>
<br>



</div>
</body>
</html>
