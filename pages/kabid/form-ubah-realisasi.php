<?php
require '../conn/koneksi.php';

if (isset($_GET["NIP"])){
  realisasi();
}

?>

<!-- FORM EDIT REALISASI -->
<?php function realisasi(){ ?>
  <!DOCTYPE html>
  <?php
  global $koneksi;
  $tgl = date("Y");
  $sql = "SELECT * FROM SKP
  INNER JOIN realisasi ON realisasi.ID_SKP = SKP.ID_SKP
  WHERE SKP.NIP = :NIP AND YEAR(TGL_REALISASI) = :TGL_REALISASI";

  $statement = $koneksi -> prepare ($sql);
  $statement -> bindValue(':NIP', $_GET["NIP"]);
  $statement -> bindValue(':TGL_REALISASI', $tgl);
  $statement -> execute();

  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $realisasi[] = $row;
  }
  ?>

  <html>
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
      <div class="modal-dialog" role="document" style="width: 98%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_ubahskp">Edit Realisasi</h4>
          </div>
          <div class="modal-body js-sweetalert">
            <form id="form_validation" action="proses-ubah.php" method="POST">
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

                      <?php foreach ($realisasi as $key){ ?>
                        <tbody>
                          <td><?= $key["KEGIATAN"] ?></td>
                          <td><?= $key["AK"] ?></td>
                          <td><?= $key["KUANT_OUTPUT"] ?></td>
                          <td><?= $key["KUAL_MUTU"] ?></td>
                          <td><?= $key["WAKTU"] ?></td>
                          <td><?= $key["BIAYA"] ?></td>

                          <td></td>
                          <!-- untuk ambil id skp -->
                          <input type="hidden" name="idrealisasi[]" value="<?= $key["ID_REALISASI"] ?>">
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
                <button type="submit" class="btn btn-primary waves-effect alignleft" name="ubah_realisasi">SUBMIT</button>
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
    </body>
  </html>
<?php } ?>
