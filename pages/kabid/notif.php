<?php

// CEK ERROR!

// NOTIF EDIT PASSWORD

if (!isset($_SESSION['errorEditPass'])) {
   $errorerrorEditPass = "";
} else {
   $errorerrorEditPass = "* Konfirmasi password salah.";
}

if (!isset($_SESSION['errorEditPassLen'])) {
   $errorerrorEditPassLen = "";
} else {
   $errorerrorEditPassLen = "* Panjang password harus 6 digit.";
}

if (!isset($_SESSION['errorEditPassLama'])) {
   $errorerrorEditPassLama = "";
} else {
   $errorerrorEditPassLama = "* Password saat ini tidak cocok.";
}


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



// ERROR PILIHAN DROPDOWN

if (!isset($_SESSION["errorJabatanKosong"])) {
   $notifJabatanKosong = "";
}else{
   $notifJabatanKosong = "* Jabatan tidak boleh kosong.";
}

if (!isset($_SESSION["errorPosisiJabatanKosong"])) {
   $notifPosisiJabatanKosong = "";
} else {
   $notifPosisiJabatanKosong = "* Posisi jabatan tidak boleh kosong.";
}

if (!isset($_SESSION["errorPangkatKosong"])) {
   $notifPangkatKosong = "";
} else {
   $notifPangkatKosong = "* Pangkat tidak boleh kosong.";
}

if (!isset($_SESSION["errorUnitKerjaKosong"])) {
   $notifUnitKerjaKosong = "";
} else {
   $notifUnitKerjaKosong = "* Unit kerja tidak boleh kosong.";
}


// ERROR ISIAN TAMBAH ANGGOTA

if (!isset($_SESSION['errorNip'])) {
   $notifNip = "";
}else{
   $notifNip = "* Nip tidak valid. Harus berupa angka dan 18 digit.";
}

if (!isset($_SESSION["errorPosisiKabid"])) {
   $notifPosisiKabid = "";
} else {
   $notifPosisiKabid = "* Kabid hanya bisa memilih (Bidang Pengelolaan Informasi Adm. Kependudukan) sebagai posisi jabatan.";
}

if (!isset($_SESSION["errorDuplikatJabatan"])) {
   $notifDuplikatJabatan = "";
} else {
   $notifDuplikatJabatan = "* Hanya boleh ada 1 Kasi di tiap seksi.";
}

if (!isset($_SESSION["errorJabatanKabid"])) {
   $notifJabatanKabid = "";
} else {
   $notifJabatanKabid = "* Posisi (Bidang Pengelolaan Informasi Adm. Kependudukan) hanya untuk Kabid.";
}


if (!isset($_SESSION['errorNama'])) {
   $notifNama = "";
}else{
   $notifNama = "* Nama harus berisi alphabet.";
}

if (!isset($_SESSION['errorUsername'])) {
   $notifUsername = "";
}else{
   $notifUsername = "* Username tidak boleh lebih dari 12 karakter.";
}

if (!isset($_SESSION['errorEmail1'])) {
   $errorEmail1 = "";
}else{
   $errorEmail1 = "* Email tidak valid.";
}

if (!isset($_SESSION['errorEmail2'])) {
   $errorEmail2 = "";
}else{
   $errorEmail2 = "* Email sudah terdaftar.";
}


// NOTIF ISI NILAI Kerja

if (!isset($_SESSION['errorOrientasi'])) {
  $notifOrientasi = "";
} else {
  $notifOrientasi = "* Input 'orientasi pelayanan' harus berupa angka";
}

if (!isset($_SESSION['errorIntegritas'])) {
  $notifIntegritas = "";
} else {
  $notifIntegritas = "* Input 'integritas' harus berupa angka";
}

if (!isset($_SESSION['errorKomitmen'])) {
  $notifKomitmen = "";
} else {
  $notifKomitmen = "* Input 'komitmen' harus berupa angka";
}

if (!isset($_SESSION['errorDisiplin'])) {
  $notifDisiplin = "";
} else {
  $notifDisiplin = "* Input 'disiplin' harus berupa angka";
}

if (!isset($_SESSION['errorKerjaSama'])) {
  $notifKerjasama = "";
} else {
  $notifKerjasama = "* Input 'kerja sama' harus berupa angka";
}

if (!isset($_SESSION['errorKepemimpinan'])) {
  $notifKepemimpinan = "";
} else {
  $notifKepemimpinan = "* Input 'kepemimpinan' harus berupa angka";
}

if (!isset($_SESSION['errorKepemimpinan'])) {
  $notifKepemimpinan = "";
} else {
  $notifKepemimpinan = "* Input 'kepemimpinan' harus berupa angka";
}
?>
