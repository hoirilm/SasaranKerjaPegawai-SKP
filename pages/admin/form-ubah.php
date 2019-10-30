<?php
require '../conn/koneksi.php';

if (isset($_GET["NIP"])) {
   pengguna();
}

if (isset($_GET["ID_JABATAN"])) {
   jabatan();
}

if (isset($_GET["ID_POSISI_JABATAN"])) {
   posisijabatan();
}

?>











<!-- FORM EDIT PENGGUNA -->
<?php function pengguna() { ?>
   <!DOCTYPE html>

   <?php
   global $koneksi;

   $statement = $koneksi -> prepare ("SELECT * FROM user
      INNER JOIN pangkat ON user.ID_PANGKAT = pangkat.ID_PANGKAT
      INNER JOIN jabatan ON user.ID_JABATAN = jabatan.ID_JABATAN
      INNER JOIN posisi_jabatan ON user.ID_POSISI_JABATAN = posisi_jabatan.ID_POSISI_JABATAN
      WHERE user.NIP = :NIP");
      $statement -> bindValue(':NIP', $_GET["NIP"]);
      $statement -> execute();

      $data = $statement -> fetch(PDO::FETCH_ASSOC);

      //NILAI YANG DIPAKAI UNTUK MENGISI VALUE
      $nip = $data['NIP'];
      $idjabatan = $data['ID_JABATAN'];
      $jabatan = $data['JABATAN'];
      $idposisijabatan = $data['ID_POSISI_JABATAN'];
      $posisijabatan = $data['POSISI_JABATAN'];
      $nama = $data['NAMA'];
      $idpangkat = $data['ID_PANGKAT'];
      $pangkat = $data['JENIS_PANGKAT'] . " (" . $data['GOLONGAN'] . "/" . $data['RUANG'] . ")";
      $unitkerja = $data['UNIT_KERJA'];
      $username = $data['USERNAME'];
      $email = $data['EMAIL'];
      ?>

      <html>
      <head>
         <meta charset="utf-8">
         <title></title>
      </head>
      <body>
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="modal_tambahPengguna">Ubah Data Pengguna</h4>
               </div>
               <div class="modal-body">

                  <form id="form_validation" action="proses-ubah.php" name="modal_popup" method="POST">

                     <?php
                     $statement = $koneksi -> query("SELECT * FROM JABATAN");
                     while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                        $jabatanbaru[] = $row;
                     }
                     ?>

                     <label for="jabatan">Jabatan</label>
                     <div class="form-group">
                        <select class="form-control show-tick" name="jabatan">
                           <option value="<?= $idjabatan ?>"><?= $jabatan ?></option>
                           <?php foreach ($jabatanbaru as $key): ?>
                              <option value="<?= $key['ID_JABATAN']?>"><?= $key['JABATAN'] ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>


                     <?php
                     $statement = $koneksi -> query("SELECT * FROM POSISI_JABATAN");
                     while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                        $posisijabatanbaru[] = $row;
                     }
                     ?>

                     <label for="posisijabatan">Posisi Jabatan</label>
                     <div class="form-group">
                        <select class="form-control show-tick" name="posisijabatan">
                           <option value="<?= $idposisijabatan ?>"><?= $posisijabatan ?></option>
                           <?php foreach ($posisijabatanbaru as $key): ?>
                              <option value="<?= $key['ID_POSISI_JABATAN']?>"><?= $key['POSISI_JABATAN']?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>

                     <?php
                     $statement = $koneksi -> query("SELECT * FROM PANGKAT");
                     while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                        $pangkatbaru[] = $row;
                     }
                     ?>

                     <label for="pangkat">Pangkat/Gol-Ruang</label>
                     <div class="form-group">
                        <select class="form-control show-tick" name="pangkat">
                           <option value="<?= $idpangkat ?>"><?= $pangkat ?></option>
                           <?php foreach ($pangkatbaru as $key){ ?>
                              <option value="<?= $key["ID_PANGKAT"] ?>"><?= $key["JENIS_PANGKAT"] ?> ( <?= $key["GOLONGAN"] ?> / <?= $key["RUANG"] ?> )</option>
                           <?php } ?>
                        </select>
                     </div>

                     <label for="unitkerja">Unit Kerja</label>
                     <div class="form-group">
                        <select class="form-control show-tick" name="unitkerja">
                           <option value="DISPENDUK & PENCAPIL KAB. BANGKALAN">DISPENDUK & PENCAPIL KAB. BANGKALAN</option>
                        </select>
                     </div>

                     <label for="nip">NIP</label>
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="nip" class="form-control" name="nip" value="<?= $nip ?>" placeholder="Masukkan NIP Pengguna" readonly required>
                        </div>
                     </div>

                     <label for="nama">Nama</label>
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="nama" class="form-control" name="nama" value="<?= $nama ?>" placeholder="Masukkan Nama Pengguna" required>
                        </div>
                     </div>

                     <label for="username">Username</label>
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="username" class="form-control" name="username" value="<?= $username ?>" placeholder="Masukkan Username Pengguna" required>
                        </div>
                     </div>

                     <label for="email">Email</label>
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" id="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Masukkan Email Pengguna" required>
                        </div>
                     </div>

                     <input type='submit' class='btn btn-primary waves-effect' name='ubah_pengguna' value='Simpan'>
                  </form>

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
               </div>
            </div>
         </div>
         <!-- Custom Js -->
         <!-- <script src="../../js/admin.js"></script> -->
      </body>
      </html>
   <?php } ?>
   <!-- #FORM EDIT PENGGUNA -->






   <!-- FORM EDIT JABATAN -->
   <?php function jabatan(){ ?>
      <!DOCTYPE html>
      <?php
      global $koneksi;
      $statement = $koneksi -> prepare ("SELECT * FROM JABATAN WHERE ID_JABATAN = :ID_JABATAN");
      $statement -> bindValue(':ID_JABATAN', $_GET["ID_JABATAN"]);
      $statement -> execute();

      $data = $statement -> fetch(PDO::FETCH_ASSOC);

      //NILAI YANG DIPAKAI UNTUK MENGISI VALUE
      $id = $data['ID_JABATAN'];
      $jabatan = $data['JABATAN'];

      ?>
      <html>
      <head>
         <meta charset="utf-8">
         <title></title>
      </head>
      <body>
         <div class='modal-dialog' role='document'>
            <div class='modal-content'>
               <div class='modal-header'>
                  <h4 class='modal-title' id='modal_ubahJabatan'>Edit Data</h4>
               </div>

               <div class='modal-body'>
                  <form class='' action='proses-ubah.php' method='post' name='modal_popup'>
                     <label for='jabatan'>Jabatan</label>
                     <div class='form-group'>
                        <div class='form-line'>
                           <input type='hidden' class='form-control' name='id' value='<?= $id ?>' required>
                           <input type='text' class='form-control' name='jabatan' value='<?= $jabatan ?>' placeholder='Masukkan Nama Jabatan' required>
                        </div>
                     </div>
                     <input type='submit' class='btn btn-primary waves-effect' name='ubah_jabatan' value='Simpan'>
                  </form>
               </div>

               <div class='modal-footer'>
                  <button type='button' class='btn btn-link waves-effect' data-dismiss='modal'>Kembali</button>
               </div>
            </div>
         </div>
         <!-- Custom Js -->
         <!-- <script src="../../js/admin.js"></script> -->
      </body>
      </html>
   <?php } ?>
   <!-- #FORM EDIT JABATAN -->


   <!-- FORM EDIT POSISI JABATAN -->
   <?php function posisijabatan(){ ?>
      <!DOCTYPE html>
      <?php
      global $koneksi;
      $statement = $koneksi -> prepare ("SELECT * FROM POSISI_JABATAN WHERE ID_POSISI_JABATAN = :ID_POSISI_JABATAN");
      $statement -> bindValue(':ID_POSISI_JABATAN', $_GET["ID_POSISI_JABATAN"]);
      $statement -> execute();

      $data = $statement -> fetch(PDO::FETCH_ASSOC);

      //NILAI YANG DIPAKAI UNTUK MENGISI VALUE
      $id = $data['ID_POSISI_JABATAN'];
      $posisijabatan = $data['POSISI_JABATAN'];

      ?>
      <html>
      <head>
         <meta charset="utf-8">
         <title></title>
      </head>
      <body>
         <div class='modal-dialog' role='document'>
            <div class='modal-content'>
               <div class='modal-header'>
                  <h4 class='modal-title' id='modal_ubahPosisijabatan'>Edit Data</h4>
               </div>

               <div class='modal-body'>
                  <form class='' action='proses-ubah.php' method='post' name='modal_popup'>
                     <label for='jabatan'>Jabatan</label>
                     <div class='form-group'>
                        <div class='form-line'>
                           <input type='hidden' class='form-control' name='id' value='<?= $id ?>' required>
                           <input type='text' class='form-control' name='posisijabatan' value='<?= $posisijabatan ?>' placeholder='Masukkan Posisi Jabatan' required>
                        </div>
                     </div>
                     <input type='submit' class='btn btn-primary waves-effect' name='ubah_posisijabatan' value='Simpan'>
                  </form>
               </div>

               <div class='modal-footer'>
                  <button type='button' class='btn btn-link waves-effect' data-dismiss='modal'>Kembali</button>
               </div>
            </div>
         </div>
         <!-- Custom Js -->
         <!-- <script src="../../js/admin.js"></script> -->
      </body>
      </html>
   <?php } ?>
   <!-- #FORM EDIT POSISI_JABATAN -->
