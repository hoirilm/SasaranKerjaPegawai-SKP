<?php
require '../conn/koneksi.php';

if (isset($_GET["ID_PENILAIAN"])) {
  tanggal();
}

?>


<?php function tanggal(){ ?>
  <!DOCTYPE html>

  <?php
  global $koneksi;
  ?>

  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:400px; margin:auto">
      <div class="modal-header">
        <h4 class="modal-title" id="cetak_arsip">Tanggal Surat</h4>
      </div>
      <div class="modal-body">

        <form action="cetak-nilai-kerja.php" method="post" target="_blank">
          <div class="demo-masked-input">
            <div class="row clearfix" style="margin-bottom:25px">

              <div class="col-md-12" style="margin: 10px">
                <!-- data untuk ambil id penilaian yang dipilih -->
                <?php $id = $_GET['ID_PENILAIAN'] ?>
                <input type="hidden" name="id_penilaian" value=<?= $id ?>>

                <b>Dibuat pada tanggal</b>
                <input type="date" name="dibuat" style="border:none; font-size:15px; float: right; margin-top: -2px;" required>
              </div>

              <div class="col-md-12" style="margin: 10px">
                <b>Diterima pegawai</b>
                <input type="date" name="diterima1" style="border:none; font-size:15px; float: right; display:inline; margin-top: -2px;" required>
              </div>

              <div class="col-md-12" style="margin: 10px">
                <b>Diterima atasan</b>
                <input type="date" name="diterima2" style="border:none; font-size:15px; float: right; margin-top: -2px;" required>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary waves-effect alignleft" name="cetak">Cetak</button>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
<?php } ?>
