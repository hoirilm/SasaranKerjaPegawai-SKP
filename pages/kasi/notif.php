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


// ERROR ISIAN REALISASI

if (!isset($_SESSION["errorKuantRealisasi"])) {
   $notifKuantRealisasi = "";
}else{
   $notifKuantRealisasi = "* Isian kuantitas harus berupa angka dan tidak boleh lebih dari target.";
}

if (!isset($_SESSION["errorKualRealisasi"])) {
   $notifKualRealisasi = "";
}else{
   $notifKualRealisasi = "* Isian kualitas harus berupa angka dan tidak boleh lebih dari target.";
}

if (!isset($_SESSION["errorWaktuRealisasi"])) {
   $notifWaktuRealisasi = "";
} else {
   $notifWaktuRealisasi = "* Isian waktu harus berupa angka dan tidak boleh lebih dari target.";
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


// NOTIF ISI NILAI Kerja

if (!isset($_SESSION['errorOrientasi'])) {
  $notifOrientasi = "";
} else {
  $notifOrientasi = "* Input 'orientasi pelayanan' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorIntegritas'])) {
  $notifIntegritas = "";
} else {
  $notifIntegritas = "* Input 'integritas' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorKomitmen'])) {
  $notifKomitmen = "";
} else {
  $notifKomitmen = "* Input 'komitmen' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorDisiplin'])) {
  $notifDisiplin = "";
} else {
  $notifDisiplin = "* Input 'disiplin' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorKerjaSama'])) {
  $notifKerjasama = "";
} else {
  $notifKerjasama = "* Input 'kerja sama' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorKepemimpinan'])) {
  $notifKepemimpinan = "";
} else {
  $notifKepemimpinan = "* Input 'kepemimpinan' harus berupa angka dan memiliki nilai maksimal 100";
}

if (!isset($_SESSION['errorKepemimpinan'])) {
  $notifKepemimpinan = "";
} else {
  $notifKepemimpinan = "* Input 'kepemimpinan' harus berupa angka dan memiliki nilai maksimal 100 (tidak untuk staf)";
}

?>
