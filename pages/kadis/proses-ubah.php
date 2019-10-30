<?php
require '../conn/koneksi.php';


if (isset($_POST["gantiPass"])) {
  $error = false;
  $nip = $_SESSION["userkadis"];
  $statement = $koneksi -> query("SELECT * FROM USER WHERE NIP = '$nip'");
  while ($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    $gantipass[] = $row;
  }

  $passDatabase = $gantipass[0]["PASSWORD"]; //pass yang ada di database
  $passLama = hash('sha256', $_POST["passLama"]); //data password dari inputan user
  $passwordBaru = $_POST["passBaru"];
  $cekstring = strlen($_POST["passBaru"]);
  $confirmPassBaru = $_POST["confirmPassBaru"];

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
    $statement = $koneksi -> prepare ("UPDATE USER SET PASSWORD =  SHA2(:PASSWORD, 0)  WHERE NIP = '$nip'");
    $statement -> bindValue(':PASSWORD', $passwordBaru);;
    $statement -> execute();
    header("Location: ../../index4.php?alert=2");
  } else {
    header("Location: ../../index4.php?alert=4");
  }
}


?>
