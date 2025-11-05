<?php

// Memasukkan file class-pegawai.php untuk mengakses class Pegawai
include_once '../config/class-pegawai.php';
// Membuat objek dari class Pegawai
$pegawai = new Pegawai();
// Mengambil data pegawai dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataPegawai = [
    'id' => $_POST['id'],
    'nik' => $_POST['nik'],
    'nama' => $_POST['nama'],
    'jabatan' => $_POST['jabatan'],
    'alamat' => $_POST['alamat'],
    'departemen' => $_POST['departemen'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method editPegawai untuk mengupdate data pegawai dengan parameter array $dataPegawai
$edit = $pegawai->editPegawai($dataPegawai);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id pegawai
    header("Location: ../data-edit.php?id=".$dataPegawai['id']."&status=failed");
}

?>