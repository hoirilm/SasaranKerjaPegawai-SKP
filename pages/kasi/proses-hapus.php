<?php
require '../conn/koneksi.php';

if (isset($_GET['id_skp'])){

  $id = $_GET['id_skp'];

  //query untuk hapus data
  $statement = $koneksi -> prepare("DELETE FROM SKP WHERE ID_SKP = :ID_SKP");
  $statement -> bindValue(':ID_SKP', $id);
  $statement -> execute();

  $sukses = $statement -> rowCount() > 0;

  if($sukses) {
    header("Location: skp-saya.php?alert=3");
    die;
  }else{
    header("Location: skp-saya.php?alert=4");
    die;
  }
}
?>
