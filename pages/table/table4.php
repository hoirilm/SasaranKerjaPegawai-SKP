<!DOCTYPE html>
<html>
<head>
	<title>Cetak SKP</title>
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
.tg .tgRight{font-family:"Times New Roman", Times, serif !important;;border-color:inherit;text-align:center;border-left: none;border-bottom: none;}
.tg .tgLeft{font-family:"Times New Roman", Times, serif !important;;border-color:inherit;text-align:center;border-right: none;border-bottom: none;}
.tg .tg-ypv2{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;border-color:inherit}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 300.010417px">
<col style="width: 300.010417px">
</colgroup>
  <tr>
    <th class="tg-ypv2" colspan="2" style="padding-bottom: 200px; text-align: left; ">8. REKOMENDASI</th>
  </tr>
  <tr>
    <td class="tgLeft"></td>
    <td class="tgRight" style="padding-bottom: 60px; "><b>9. DIBUAT TANGGAL, <?= $tanggaldibuat ?><br>PEJABAT PENILAI</b></td>
  </tr>
  <tr>
    <td class="tgLeft" style="border-top: none;"></td>
    <td class="tgRight" style="border-top: none;"><b><u><?= $atasan[0]["NAMA"] ?></u></b><br><?= $atasan[0]["NIP"] ?><br></td>
  </tr>
  <tr>
    <td class="tgLeft" style="border-top: none; padding-bottom: 60px;"><b>10. DITERIMA TANGGAL, <?= $tanggalditerima1 ?><br>PEGAWAI NEGERI SIPIL YANG DINILAI</b></td>
    <td class="tgRight" style="border-top: none;"></td>
  </tr>
  <tr>
    <td class="tgLeft" style="border-top: none;"><b><u><?= $pengguna[0]["NAMA"] ?></u></b><br><?= $pengguna[0]["NIP"] ?></td>
    <td class="tgRight" style="border-top: none;"></td>
  </tr>
  <tr>
    <td class="tgLeft" style="border-top: none;"></td>
    <td class="tgRight" style="border-top: none; padding-bottom: 60px;"><b>11. DITERIMA TANGGAL, <?= $tanggalditerima2 ?><br>ATASAN PEJABAT PENILAI <br></b></td>
  </tr>
  <tr>
    <td class="tg-ypv2" style="border-top: none; border-right: none;"></td>
    <td class="tg-ypv2" style="text-align: center; border-top: none; border-left: none;"><b><u><?= $atasan_penilai[0]["NAMA"] ?></u></b><br><?= $atasan_penilai[0]["NIP"] ?></td>
  </tr>
</table>
  </div>
</body>
</html>
