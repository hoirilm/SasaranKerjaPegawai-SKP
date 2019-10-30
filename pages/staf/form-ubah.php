<?php
require '../conn/koneksi.php';

if (isset($_GET["ID_SKP"])) {
  skp();
}

?>

<!-- FORM EDIT JABATAN -->
<?php function skp(){ ?>
  <!DOCTYPE html>
  <?php
  global $koneksi;
  $statement = $koneksi -> prepare ("SELECT * FROM SKP WHERE ID_SKP = :ID_SKP");
  $statement -> bindValue(':ID_SKP', $_GET["ID_SKP"]);
  $statement -> execute();

  $skp = $statement -> fetch(PDO::FETCH_ASSOC);

  //NILAI YANG DIPAKAI UNTUK MENGISI VALUE
  $id = $skp["ID_SKP"];
  $kegiatan = $skp["KEGIATAN"];

  ?>

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_ubahskp">Edit SKP</h4>
      </div>
      <div class="modal-body js-sweetalert">

        <form id="form_validation" action="proses-ubah.php" method="POST">

          <input type="hidden" name="id" value="<?= $id ?>">

          <label for="kegiatan">Kegiatan</label>
          <div class="form-group">
            <div class="form-line">
              <textarea rows="5" id="kegiatan" class="form-control no-resize auto-growth" name="kegiatan" placeholder="Masukkan Kegiatan" required><?= $kegiatan ?></textarea>
            </div>
          </div>

          <div class="col-lg-12" style="padding-left: 0">
            <div class="col-lg-6">
              <label for="ak">AK</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="ak" class="form-control" name="ak" placeholder="0" value="0" readonly required>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <label for="kuantoutput1">Kuant / Output</label>
              <div class="form-group">
                <div class="col-lg-6" style="padding: 0">
                  <div class="form-line">
                    <input type="text" id="kuantoutput1" class="form-control" name="kuantoutput1" placeholder="0" required>
                  </div>
                </div>

                <div class="col-lg-6" style="padding-right: 0">
                  <select class="form-control show-tick" name="kuantoutput2">
                    <option value="Kali">Kali</option>
                    <option value="Jam">Jam</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12" style="padding-left: 0">
            <div class="col-lg-6">
              <label for="kualmutu" style="">Kual / Mutu</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="kualmutu" class="form-control" name="kualmutu" placeholder="0%" required>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <label for="waktu1">Waktu</label>
              <div class="form-group">
                <div class="col-lg-6" style="padding: 0">
                  <div class="form-line">
                    <input type="text" id="waktu1" class="form-control" name="waktu1" placeholder="0" required>
                  </div>
                </div>

                <div class="col-lg-6" style="padding-right: 0">
                  <select class="form-control show-tick" name="waktu2">
                    <option value="Bulan">Bulan</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-12">
            <label for="biaya">Biaya</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" id="biaya" class="form-control" name="biaya" placeholder="0" value="0" readonly required>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary waves-effect alignleft" name="ubah_skp">SUBMIT</button>
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
  <!-- Custom Js -->
  <!-- <script src="../../js/admin.js"></script> -->
</body>
</html>
<?php } ?>
<!-- #FORM EDIT JABATAN -->
