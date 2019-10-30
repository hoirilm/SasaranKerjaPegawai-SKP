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
    .tg td{font-family:"Times New Roman", Times, serif !important;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-family:"Times New Roman", Times, serif !important;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-f1li{color:#000000;border-color:inherit;vertical-align:top}
    .tg .tg-3m5g{font-weight:bold;color:#000000;border-color:inherit;text-align:center}
    .tg .tg-vpkt{font-weight:bold;color:#000000;border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-tkpq{font-weight:bold;color:#000000;border-color:inherit}
    .tg .tg-9ddn{font-weight:bold;color:#000000;border-color:inherit;vertical-align:top}
    .tg .tg-ml2k{color:#000000;border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-w2j3{color:#000000;border-color:inherit}
    .tg .tg-sgdp{font-weight:bold;color:#000000;border-color:inherit;text-align:center;vertical-align:bottom}
    </style>
    <table class="tg" style="undefined;table-layout: fixed; width: 100%">
      <colgroup>
        <col style="width: 36.010417px">
        <col style="width: 120.010417px">
        <col style="width: 186.010417px">
        <col style="width: 57.010417px">
        <col style="width: 76.010417px">
        <col style="width: 80.010417px">
      </colgroup>
      <tr>
        <th class="tg-vpkt" rowspan="11">4. </th>
        <th class="tg-tkpq" colspan="4">UNSUR YANG DINILAI</th>
        <th class="tg-vpkt">Jumlah</th>
      </tr>
      <tr>
        <td class="tg-tkpq" colspan="2" style="border-right: none;">a. Sasaran Kerja Pegawai (SKP)</td>
        <td class="tg-9ddn" colspan="2" style="border-left: none; text-align: right;"><?=number_format($nilai_capai_final,2)?> x 60%</td>
        <?php $jumlah1 = $nilai_capai_final * 0.6; ?>
        <td class="tg-ml2k"><?= number_format($jumlah1,2) ?></td>
      </tr>
      <tr>
        <td class="tg-tkpq" rowspan="9">b. Perilaku Kerja</td>
        <td class="tg-w2j3">1. Orientasi Pelayanan</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["ORIENTASI_PELAYANAN"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["ORIENTASI_PELAYANAN"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">2. Integritas</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["INTEGRITAS"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["INTEGRITAS"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">3. Komitmen</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["KOMITMEN"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["KOMITMEN"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">4. Disiplin</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["DISIPLIN"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["DISIPLIN"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">5. Kerjasama</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["KERJASAMA"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["KERJASAMA"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">6. Kepemimpinan</td>
        <td class="tg-ml2k"><?= $nilai_kerja[0]["KEPEMIMPINAN"] ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($nilai_kerja[0]["KEPEMIMPINAN"]) ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">7. Jumlah</td>
        <td class="tg-ml2k">
          <?= $jumlah_total ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-w2j3">8. Nilai rata – rata</td>
        <td class="tg-ml2k"><?= number_format($jumlah_rata,2) ?></td>
        <td class="tg-ml2k">
          <?php cekNilai($jumlah_rata); ?>
        </td>
        <td class="tg-f1li" style="background-color: #5e6060"></td>
      </tr>
      <tr>
        <td class="tg-tkpq" style="border-right: none;">9. Nilai Perilaku Kerja</td>
        <td class="tg-9ddn" colspan="2" style="border-left: none; text-align: right;"><?= number_format($jumlah_rata,2) ?> x 40 %</td>
        <?php $jumlah2 = $jumlah_rata * 0.4 ?>
        <td class="tg-ml2k"><?= number_format($jumlah2,2) ?></td>
      </tr>
      <tr>
        <td class="tg-sgdp" colspan="5" rowspan="2">NILAI PRESTASI KERJA</td>
        <?php $nilai_prestasi_kerja = $jumlah2 + $jumlah1 ?>
        <td class="tg-vpkt"><?= number_format($nilai_prestasi_kerja,2) ?></td>
      </tr>
      <tr>
        <td class="tg-vpkt">
          <?php cekNilai($nilai_prestasi_kerja); ?>
        </td>
      </tr>
      <tr>
        <td class="tg-tkpq" colspan="6" style="border-bottom: none; padding-bottom: 300px;">5. KEBERATAN DARI PEGAWAI NEGERI<br>  SIPIL YANG DINILAI (APABILA ADA)<br><br></td>
      </tr>
      <tr>
        <td class="tg-3m5g" colspan="6" style="border-top: none;">Tanggal, ………………….</td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>

  </div>
</body>
</html>
