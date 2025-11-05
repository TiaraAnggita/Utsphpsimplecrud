<?php

// Memasukkan file class-pegawai.php untuk mengakses class Pegawai
include '../config/class-pegawai.php';
// Membuat objek dari class Pegawai
$pegawai = new Pegawai();
// Mengambil data pegawai dari form input menggunakan metode POST dan menyimpannya dalam array
$dataPegawai = [
    'nik' => $_POST['nik'],
    'nama' => $_POST['nama'],
    'jabatan' => $_POST['jabatan'],
    'alamat' => $_POST['alamat'],
    'departemen' => $_POST['departemen'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method inputPegawai untuk memasukkan data pegawai dengan parameter array $dataPegawai
$input = $pegawai->inputPegawai($dataPegawai);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>