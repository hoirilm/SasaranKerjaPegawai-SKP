<?php
require '../conn/koneksi.php';
?>

<?php if (isset($_GET["NIP"])) {  ?>
  <?php
  $nip = $_GET["NIP"];
  $tgl = date("Y");

  $statement = $koneksi -> prepare ("SELECT * FROM NILAI_KERJA WHERE NIP = :NIP AND YEAR(TGL_NILAI) = :TGL_NILAI");
  $statement -> bindValue(':NIP', $nip);
  $statement -> bindValue(':TGL_NILAI', $tgl);
  $statement -> execute();

  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $detail[] = $row;
  }

  ?>
  
  <div class="modal-dialog" role="document" style="width: 40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_ubahskp">Detail Nilai Kerja</h4>
      </div>
      <div class="modal-body js-sweetalert">
        <!-- Normal Rows -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
            <div class="body table-responsive">

              <!-- Striped Rows -->
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

                  <div class="body table-responsive">
                    <table class="table table-hover">
                      <tbody>
                        <!-- untuk ambil nip dari staf yang di pilih -->
                        <input type="hidden" name="nip" value="<?= $_GET["NIP"]?>">
                        <tr>
                          <td style="font-weight: bold; width: 50%">Orientasi Pelayanan</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="orientasi_pelayanan" value="<?= $detail[0]['ORIENTASI_PELAYANAN'] ?>" readonly></td>
                        </tr>
                        <tr>
                          <td style="font-weight: bold; width: 50%">Integritas</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="integritas" value="<?= $detail[0]['INTEGRITAS'] ?>" readonly></td>
                        </tr>
                        <tr>
                          <td style="font-weight: bold; width: 50%">Komitmen</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="komitmen" value="<?= $detail[0]['KOMITMEN'] ?>" readonly></td>
                        </tr>
                        <tr>
                          <td style="font-weight: bold; width: 50%">Disiplin</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="disiplin" value="<?= $detail[0]['DISIPLIN'] ?>" readonly></td>
                        </tr>
                        <tr>
                          <td style="font-weight: bold; width: 50%">Kerja sama</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="kerjasama" value="<?= $detail[0]['KERJASAMA'] ?>" readonly></td>
                        </tr>
                        <tr>
                          <td style="font-weight: bold; width: 50%">Kepemimpinan</td>
                          <td><input style="border-left: none;border-right: none;border-top: none;width: 100%;text-align: center;font-weight: bold;" type="text" name="kepemimpinan" value="0" readonly></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- #END# Striped Rows -->



              <div class="modal-footer">
                <div class="col-lg-12">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
              </div>
            </div>
          </div>

        <?php } ?>
