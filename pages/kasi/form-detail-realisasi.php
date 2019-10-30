<?php
require '../conn/koneksi.php';
?>

<?php if (isset($_GET["NIP"])) {  ?>
  <?php
  $tgl = date("Y");
  $sql = "SELECT * FROM SKP
  INNER JOIN realisasi ON realisasi.ID_SKP = SKP.ID_SKP
  WHERE SKP.NIP = :NIP AND YEAR(TGL_REALISASI) = :TGL_REALISASI";

  $statement = $koneksi -> prepare ($sql);
  $statement -> bindValue(':NIP', $_GET["NIP"]);
  $statement -> bindValue(':TGL_REALISASI', $tgl);
  $statement -> execute();

  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $detail[] = $row;
  }
  ?>

  <div class="modal-dialog" role="document" style="width: 98%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_ubahskp">Detail Realisasi</h4>
      </div>
      <div class="modal-body js-sweetalert">
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

                <?php foreach ($detail as $key){ ?>
                  <tbody>
                    <td style="text-align: justify;"><?= $key["KEGIATAN"] ?></td>
                    <td><?= $key["AK"] ?></td>
                    <td><?= $key["KUANT_OUTPUT"] ?></td>
                    <td><?= $key["KUAL_MUTU"] ?></td>
                    <td><?= $key["WAKTU"] ?></td>
                    <td><?= $key["BIAYA"] ?></td>

                    <td></td>
                    <!-- untuk ambil id skp -->

                    <td><?= $key["R_AK"] ?></td>
                    <td><?= $key["R_KUANT_OUTPUT"] ?></td>
                    <td><?= $key["R_KUAL_MUTU"] ?></td>
                    <td><?= $key["R_WAKTU"] ?></td>
                    <td><?= $key["R_BIAYA"] ?></td>
                  </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
        <!-- #END# Normal Rows -->
      </div>

      <div class="modal-footer">
        <div class="col-lg-12">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>

<?php } ?>
