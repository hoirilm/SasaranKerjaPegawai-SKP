<?php
//MEMULAI SESSION
session_start();

//KOENKSI KEDATABASE MENGGUNAKAN PDO STYLE
$koneksi = new PDO ('mysql:host=localhost;dbname=skp','root','');

//MENJALANKAN FUNGSI LOGIN SAAT TOMBOL LOGIN DITEKAN
if ( isset($_POST["masuk"])){
   login();
}

//==============================================================================

function login() {
   global $koneksi;
   $cekadmin = "SELECT * FROM ADMIN WHERE USERNAME_ADMIN = :USERNAME and PASSWORD_ADMIN = :PASSWORD_ADMIN";
   $cekuser = "SELECT * FROM USER WHERE NIP = :NIP and PASSWORD = SHA2(:PASSWORD, 0)";

   $nip = $_POST['nip'];
   $password = $_POST['password'];
   $userst = $koneksi -> prepare($cekuser);
   $userst -> bindValue(':NIP', $nip);
   $userst -> bindValue(':PASSWORD', $password);
   $userst -> execute();

   $sukses = $userst -> rowCount() > 0;

   if ($sukses){
      while ($row = $userst -> fetch(PDO::FETCH_ASSOC)){
         $user[] = $row;
      }

      if ($user[0]['ID_JABATAN'] === '1') {
         $_SESSION['kabid'] = true;
         $_SESSION["userkabid"] = $nip;
         header("Location: ../../index2.php");
         die;
      }else if ($user[0]['ID_JABATAN'] === '2') {
         $_SESSION['kasi'] = true;
         $_SESSION["userkasi"] = $nip;
         header("Location: ../../index3.php");
         die;
      }else if ($user[0]['ID_JABATAN'] === '3') {
         $_SESSION['staf'] = true;
         $_SESSION["userstaf"] = $nip;
         header("Location: ../../index4.php");
         die;
      }else if ($user[0]['ID_JABATAN'] === '4') {
         $_SESSION['kadis'] = true;
         $_SESSION["userkadis"] = $nip;
         header("Location: ../../index5.php");
         die;
      }

   }else if (!$sukses){

      $username = $_POST['nip'];
      $password = $_POST['password'];
      $adminst = $koneksi -> prepare($cekadmin);
      $adminst -> bindValue(':USERNAME', $username);
      $adminst -> bindValue(':PASSWORD_ADMIN', $password);
      $adminst -> execute();

      $sukses = $adminst -> rowCount() > 0;

      if ($sukses) {
         $_SESSION['admin'] = true;
         $_SESSION["useradmin"] = $username;

         // var_dump($_SESSION); die;

         header("Location: ../../index.php");
         die;
      }else{
         header("Location: ../proses/gagal.php");
         die;
      }
   }
}
?>
