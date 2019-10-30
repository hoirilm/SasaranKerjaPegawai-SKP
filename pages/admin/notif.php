<?php

// CEK ERROR!

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

if (!isset($_SESSION["errorPosisiKadis1"])) {
   $notifPosisiKadis1 = "";
} else {
   $notifPosisiKadis1 = "* Kadis hanya bisa memilih (Bidang Pengelolaan Informasi Adm. Kependudukan) sebagai posisi jabatan.";
}

if (!isset($_SESSION["errorPosisiKadis2"])) {
   $notifPosisiKadis2 = "";
} else {
   $notifPosisiKadis2 = "* Posisi kabid telah terisi.";
}

if (!isset($_SESSION["errorPosisiKabid1"])) {
   $notifPosisiKabid1 = "";
} else {
   $notifPosisiKabid1 = "* Kabid hanya bisa memilih (Bidang Pengelolaan Informasi Adm. Kependudukan) sebagai posisi jabatan.";
}

if (!isset($_SESSION["errorPosisiKabid2"])) {
   $notifPosisiKabid2 = "";
} else {
   $notifPosisiKabid2 = "* Posisi kabid telah terisi.";
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
?>
