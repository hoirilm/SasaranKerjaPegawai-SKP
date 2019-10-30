<?php
require '../conn/koneksi.php';

if (isset($_GET["NIP"])) {
  realisasi();
}

?>

<!-- FORM REALISASI -->
<?php function realisasi(){ ?>

  <?php
  global $koneksi;
  $statement = $koneksi -> prepare ("SELECT * FROM SKP WHERE NIP = :NIP");
  $statement -> bindValue(':NIP', $_GET["NIP"]);
  $statement -> execute();

  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $skp[] = $row;
  }

  ?>


  <html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    $nipstaf = $_GET["NIP"];
    $tgl = date("Y");
    $sql = "SELECT * FROM skp
    INNER JOIN user ON user.NIP = skp.NIP
    INNER JOIN status ON status.ID_STATUS = skp.ID_STATUS
    WHERE user.NIP = '$nipstaf' AND YEAR(skp.TGL_SKP) = '$tgl'";

    // MENGAMBIL DATA SKP DARI USER YANG SEDANG LOGIN
    $statement1 = $koneksi -> query($sql);
    $cek1 = $statement1 -> rowCount() > 0;

    if ($cek1) {
      while ($row = $statement1 -> fetch(PDO::FETCH_ASSOC)){
        $valid1[] = $row;
      }
      $jumlahskp[] = count($valid1);
    }else{
      $jumlahskp = 0;
    }


    // MENGAMBIL DATA SKP DARI USER YANG SEDANG LOGIN + PENGECEKAN SKP YANG SUDAH DITERIMA
    $statement2 = $koneksi -> query("SELECT * FROM SKP WHERE ID_STATUS = 2 AND NIP = '$nipstaf' AND YEAR(TGL_SKP) = '$tgl'");
    $cek2 = $statement2 -> rowCount() > 0;

    if ($cek2) {
      while ($row = $statement2 -> fetch(PDO::FETCH_ASSOC)){
        $valid2[] = $row;
      }
      $jumlahstatus[] = count($valid2);
    }else{
      $jumlahstatus = 0;
    }

    ?>

    <!-- cek kondisi sudah dipenuhi atau tidak -->
    <?php if ($jumlahskp !== $jumlahstatus){ ?>
      <div class="modal-dialog" role="document" style="width: 98%;">
        <div class="modal-content modal-col-red">
          <div class="modal-header">
          </div>
          <div class="modal-body js-sweetalert">
            <div class="alert bg-red align-center">
              <i class="material-icons">info</i>
              <h5>Tidak dapat memberi nilai pada Staf yang bersangkutan. Pastikan semua SKP sudah disetujui.</h5>
            </div>
          </div>
        </div>
      </div>
    <?php }else if (empty($skp)){ ?>
      <div class="modal-dialog" role="document" style="width: 98%;">
          <div class="modal-content modal-col-red">
             <div class="modal-header">
             </div>
             <div class="modal-body js-sweetalert">
                <div class="alert bg-red align-center">
                   <i class="material-icons">info</i>
                   <h5>Staf tidak memiliki SKP untuk dinilai</h5>
                </div>
             </div>
          </div>
      </div>
    <?php } else { ?>
      <div class="modal-dialog" role="document" style="width: 98%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_ubahskp">Realisasi</h4>
          </div>
          <div class="modal-body js-sweetalert">
            <form id="form_validation" action="proses-simpan.php" method="POST">
              <!-- Normal Rows -->
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                  <div class="body table-responsive">
                    <table class="table">
                      <thead>
                        <th width="35%">Kegiatan</th>
                        <th>AK</th>
                        <th>Kuant/Output</th>
                        <th>Kual/Mutu</th>
                        <th>Waktu</th>
                        <th>Biaya</th>
                        <th width="5%"></th>
                        <th>AK</th>
                        <th>Kuant/Output</th>
                        <th>Kual/Mutu</th>
                        <th>Waktu</th>
                        <th>Biaya</th>
                      </thead>

                      <?php foreach ($skp as $key){ ?>
                        <tbody>
                          <td style="text-align: justify"><?= $key["KEGIATAN"] ?></td>
                          <td><?= $key["AK"] ?></td>
                          <td><?= $key["KUANT_OUTPUT"] ?></td>
                          <td><?= $key["KUAL_MUTU"] ?></td>
                          <td><?= $key["WAKTU"] ?></td>
                          <td><?= $key["BIAYA"] ?></td>

                          <td></td>
                          <!-- untuk ambil id skp -->
                          <input type="hidden" name="idskp[]" value="<?= $key["ID_SKP"] ?>">
                          <input type="hidden" name="nip[]" value="<?= $nipstaf ?>">
                          <td>
                            <input type="text" name="ak[]" value="0" style="border:none; border-bottom:1px solid #eee; width: 30px; height: 30px; text-align:center" readonly>
                          </td>
                          <td>
                            <input type="text" name="kuantoutput1[]" placeholder="0" required style="border:none; border-bottom:1px solid #eee; width: 30px; height: 30px; text-align:center">
                            <select class="" name="kuantoutput2[]" style="border:none; border-bottom:1px solid #eee; height: 30px">
                              <option value="Kali">Kali</option>
                              <option value="Jam">Jam</option>
                            </select>

                          </td>
                          <td>
                            <input type="text" name="kualmutu[]" placeholder="0%" required style="border:none; border-bottom:1px solid #eee; width: 65px; height: 30px; text-align:center">
                          </td>
                          <td>
                            <input type="text" name="waktu1[]" placeholder="0" required style="border:none; border-bottom:1px solid #eee; width: 30px; height: 30px; text-align:center">
                            <select class="" name="waktu2[]" style="border:none; border-bottom:1px solid #eee; height: 30px;">
                              <option value="Bulan">Bulan</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" name="biaya[]" value="0" style="border:none; border-bottom:1px solid #eee; width: 30px; height: 30px; text-align:center" readonly>
                          </td>
                        </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
              <!-- #END# Normal Rows -->

              <div class="col-lg-12">
                <button type="submit" class="btn btn-primary waves-effect alignleft" name="simpan_realisasi">SUBMIT</button>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <div class="col-lg-12">
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </body>
  </html>
<?php } ?>

<!-- #FORM REALISASI -->
