<?php
require '../conn/koneksi.php';

if (isset($_GET["NIP"])) {
  $sql = "SELECT * FROM user
  INNER JOIN pangkat ON user.ID_PANGKAT = pangkat.ID_PANGKAT
  INNER JOIN jabatan ON user.ID_JABATAN = jabatan.ID_JABATAN
  INNER JOIN posisi_jabatan ON user.ID_POSISI_JABATAN = posisi_jabatan.ID_POSISI_JABATAN
  WHERE user.NIP = :NIP";

  $statement = $koneksi -> prepare ($sql);
  $statement -> bindValue(':NIP', $_GET["NIP"]);
  $statement -> execute();
  $data = $statement -> fetch(PDO::FETCH_ASSOC);

  //NILAI YANG DIPAKAI UNTUK MENGISI VALUE
  $nip = $data['NIP'];
  $jabatan = $data['JABATAN'];
  $posisijabatan = $data['POSISI_JABATAN'];
  $nama = $data['NAMA'];
  $pangkat = $data['JENIS_PANGKAT'] . " (" . $data['GOLONGAN'] . "/" . $data['RUANG'] . ")";
  $unitkerja = $data['UNIT_KERJA'];
  $username = $data['USERNAME'];
  $email = $data['EMAIL'];
}

?>


<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="modal_lihat">Detail Pengguna</h4>
    </div>
    <div class="modal-body">


      <!-- Striped Rows -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">

          <div class="body table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td style="font-weight: bold">NIP</td>
                  <td><?= $nip ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Jabatan</td>
                  <td><?= $jabatan ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Posisi Jabatan</td>
                  <td><?= $posisijabatan ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Nama</td>
                  <td><?= $nama ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Pangkat/Gol-Ruang</td>
                  <td><?= $pangkat ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Unit Kerja</td>
                  <td><?= $unitkerja ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Username</td>
                  <td><?= $username ?></td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Email</td>
                  <td><?= $email ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- #END# Striped Rows -->


    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Kembali</button>
    </div>
  </div>
</div>
