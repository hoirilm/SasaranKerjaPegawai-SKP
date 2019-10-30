<?php

// CEK ERROR!

// ERROR ISIAN SKP

if (!isset($_SESSION["errorKuant"])) {
   $notifKuant = "";
}else{
   $notifKuant = "* Isian kuantitas harus berupa angka dan tidak boleh kurang dari 1.";
}

if (!isset($_SESSION["errorKual"])) {
   $notifKual = "";
}else{
   $notifKual = "* Isian kualitas harus berupa angka dan memiliki nilai maksimal 100.";
}

if (!isset($_SESSION["errorWaktu"])) {
   $notifWaktu = "";
} else {
   $notifWaktu = "* Isian waktu harus berupa angka dan memiliki nilai maksimal 12.";
}



// NOTIF EDIT PASSWORD

if (!isset($_SESSION['errorEditPass'])) {
   $notifEditPass = "";
} else {
   $notifEditPass = "* Konfirmasi password salah.";
}

if (!isset($_SESSION['errorEditPassLen'])) {
   $notifEditPassLen = "";
} else {
   $notifEditPassLen = "* Panjang password harus 6 digit.";
}

if (!isset($_SESSION['errorEditPassLama'])) {
   $notifEditPassLama = "";
} else {
   $notifEditPassLama = "* Password saat ini tidak cocok.";
}

?>
