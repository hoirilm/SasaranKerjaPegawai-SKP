<?php
require '../conn/koneksi.php';

if (isset($_POST["gantiPass"])) {
   $error = false;
   $id = $_SESSION["admin"];
   $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE ID_ADMIN = '$id'");
   while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
      $gantipass[] = $row;
   }

   $passDatabase = $gantipass[0]["PASSWORD_ADMIN"]; //pass yang ada di datanase
   $passLama = htmlspecialchars(hash('sha256', $_POST["passLama"])); //data password dari inputan user
   $passwordBaru = htmlspecialchars($_POST["passBaru"]);
   $cekstring = strlen($_POST["passBaru"]);
   $confirmPassBaru = htmlspecialchars($_POST["confirmPassBaru"]);

   if($passDatabase === $passLama) {
      if ($passwordBaru !== $confirmPassBaru) {
         $_SESSION["errorEditPass"] = true;
         $error = true;
      } else if ($cekstring < 6) {
         $_SESSION["errorEditPassLen"] = true;
         $error = true;
      }
   } else {
      $_SESSION["errorEditPassLama"] = true;
      $error = true;
   }

   if ($error === false) {
      $statement = $koneksi -> prepare ("UPDATE ADMIN SET PASSWORD_ADMIN =  SHA2(:PASSWORD_ADMIN, 0)  WHERE ID_ADMIN = '$id'");
      $statement -> bindValue(':PASSWORD_ADMIN', $passwordBaru);;
      $statement -> execute();
      header("Location: ../../index.php?alert=2");
   } else {
      header("Location: ../../index.php?alert=4");
   }


}

if (isset($_POST["ubah_pengguna"])) {
   $error = false;

   $nip = htmlspecialchars($_POST['nip']);
   $jabatan = htmlspecialchars($_POST['jabatan']);
   $posisijabatan = htmlspecialchars($_POST['posisijabatan']);
   $nama = htmlspecialchars($_POST['nama']);
   $pangkat = htmlspecialchars($_POST['pangkat']);
   $unitkerja = htmlspecialchars($_POST['unitkerja']);
   $username = htmlspecialchars($_POST['username']);
   $email = htmlspecialchars($_POST['email']);

   var_dump($nip);
   var_dump($jabatan);
   var_dump($posisijabatan);
   var_dump($nama);
   var_dump($pangkat);
   var_dump($unitkerja);
   var_dump($username);
   var_dump($email);
   // die;

   // VALIDASI =====================================================================


   // cek jika yang pilih adalah kepala dinas.
    if ($jabatan == "4" and $posisijabatan != "5") {
       $_SESSION["errorPosisiKadis1"] = true;
       $error = true;
    } else if ($jabatan == "4" and $posisijabatan == "5") { //cek apakah sudah ada kadis atau belum
       $statement = $koneksi -> query("SELECT * FROM USER WHERE ID_JABATAN = 4");
       $ada = $statement -> rowCount() > 0;
       if ($ada){
          $_SESSION["errorPosisiKadis2"] = true;
          $error = true;
       }
    } else {
       unset($_SESSION["errorPosisiKadis1"]);
       unset($_SESSION["errorPosisiKadis2"]);
    }
    

   //cek jika jabatan ang dipilih adalah kabid namun tidak memilih bidang pengelolaan informasi
   if ($jabatan == "1" and $posisijabatan !== "1") {
      $_SESSION["errorPosisiKabid"] = true;
      $error = true;
   } else {
      unset($_SESSION["errorPosisiKabid"]);
   }

   // cek jika pilihan jabatan adalah kasi
   if ($jabatan == "2" and $posisijabatan == "1") {
      $_SESSION["errorJabatanKabid"] = true;
      $error = true;

   } else if ($jabatan == "2") {
      //jika jabatan ang dipilih adalah kasi, maka akan dilakukan pengecekan ditipa posisi jabatan.apakah sudah ada kasi atau belum
      $statement = $koneksi -> query("SELECT * FROM USER
         INNER JOIN JABATAN ON JABATAN.ID_JABATAN = USER.ID_JABATAN
         INNER JOIN POSISI_JABATAN on POSISI_JABATAN.ID_POSISI_JABATAN = USER.ID_POSISI_JABATAN
         WHERE JABATAN.ID_JABATAN = '$jabatan' and POSISI_JABATAN.ID_POSISI_JABATAN = '$posisijabatan'");
         while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
            $cekKondisi[] = $row;
         }

         //cek data jabatan sudah ada atau belum
         $cek = $statement -> rowCount() > 0;

         if ($cek) {
            $_SESSION["errorDuplikatJabatan"] = true;
            $error = true;
         }

      } else {
         unset($_SESSION["errorDuplikatJabatan"]);
         unset($_SESSION["errorJabatanKabid"]);
      }

      // cek jika kondisi jabatan adalah staf
      if ($jabatan == "3" and $posisijabatan == "1") {
         $_SESSION["errorJabatanKabid"] = true;
         $error = true;
      } else {
         unset($_SESSION["errorJabatanKabid"]);
      }

      if (!preg_match("/^[a-zA-Z_,. ]*$/",$nama)){
         $_SESSION["errorNama"] = true;
         $error = true;
      }else{
         unset($_SESSION["errorNama"]);
      }

      if (strlen($username) > 12) {
         $_SESSION["errorUsername"] = true;
         $error = true;
      }else{
         unset($_SESSION["errorUsername"]);
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         unset($_SESSION["errorEmail2"]);
         $_SESSION["errorEmail1"] = true;
         $error = true;
      } else if (filter_var($email, FILTER_VALIDATE_EMAIL)){
         unset($_SESSION["errorEmail1"]);
         $statement = $koneksi -> query("SELECT EMAIL FROM USER WHERE EMAIL = '$email'");
         $row = $statement -> fetch(PDO::FETCH_ASSOC);
         $ada = $statement -> rowCount() > 0;

         // echo "<br>";echo "<br>";echo "<br>";echo "<br>";
         // var_dump($email);echo "<br>";
         // var_dump($row['EMAIL']); die;

         if ($ada) {
            if ($email === $row['EMAIL']) {
               unset($_SESSION["errorEmail2"]);
            }else{
               $_SESSION["errorEmail2"] = true;
               $error = true;
            }
         }else{
            unset($_SESSION["errorEmail2"]);
         }
      }

      var_dump($error); echo "<br>";
      var_dump($_SESSION["errorPosisiKabid1"]);echo "<br>";
      var_dump($_SESSION["errorPosisiKabid2"]);echo "<br>";
      var_dump($_SESSION["errorDuplikatJabatan"]);echo "<br>";
      var_dump($_SESSION["errorJabatanKabid"]);echo "<br>";
      var_dump($_SESSION["errorNip"]);echo "<br>";
      var_dump($_SESSION["errorNama"]);echo "<br>";
      var_dump($_SESSION["errorUsername"]);echo "<br>";
      var_dump($_SESSION["errorEmail1"]);echo "<br>";
      var_dump($_SESSION["errorEmail2"]);echo "<br>";
      // die;


      // ========================================================================


      if ($error === false) {
         $statement = $koneksi -> prepare ("UPDATE USER SET
            ID_JABATAN = :ID_JABATAN,
            ID_POSISI_JABATAN = :ID_POSISI_JABATAN,
            NAMA = :NAMA,
            ID_PANGKAT = :ID_PANGKAT,
            UNIT_KERJA = :UNIT_KERJA,
            USERNAME = :USERNAME,
            EMAIL = :EMAIL
            WHERE NIP = :NIP");

            $statement -> bindValue(':NIP', $nip);
            $statement -> bindValue(':ID_JABATAN', $jabatan);
            $statement -> bindValue(':ID_POSISI_JABATAN', $posisijabatan);
            $statement -> bindValue(':NAMA', $nama);
            $statement -> bindValue(':ID_PANGKAT', $pangkat);
            $statement -> bindValue(':UNIT_KERJA', $unitkerja);
            $statement -> bindValue(':USERNAME', $username);
            $statement -> bindValue(':EMAIL', $email);
            $statement -> execute();

            $sukses = $statement -> rowCount() > 0;

            // var_dump($sukses); die;

            if($sukses) {
               // data riwayat
               $username = $_SESSION['useradmin'];
               $statement = $koneksi -> query("SELECT * FROM ADMIN WHERE USERNAME_ADMIN = '$username'");
               while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
                  $admin[] = $row;
               }

               $idAdmin = $admin[0]['ID_ADMIN'];
               $aktivitas = "Mengubah data pengguna " . "<strong>".$nama."</strong>";
               date_default_timezone_set("Asia/Jakarta");
               $waktu = date("Y-m-d H:i:s");

               $riwayat = $koneksi -> prepare("INSERT INTO RIWAYAT_ADMIN (ID_ADMIN, AKTIVITAS_ADMIN, TGL_RIWAYAT_ADMIN) VALUES (:ID_ADMIN, :AKTIVITAS_ADMIN, :TGL_RIWAYAT_ADMIN)");
               $riwayat -> bindValue(':ID_ADMIN', $idAdmin);
               $riwayat -> bindValue(':AKTIVITAS_ADMIN', $aktivitas);
               $riwayat -> bindValue(':TGL_RIWAYAT_ADMIN', $waktu);
               $riwayat -> execute();

               $cek2 = $riwayat -> rowCount() > 0;
               if ($cek2) {
                  header("Location: pengguna.php?alert=2");
                  die;
               }
            }else{
               header("Location: pengguna.php?alert=4");
            }
         } else {
            header("Location: pengguna.php?alert=4");
            die;
         }

      }

      ?>
