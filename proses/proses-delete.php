<?php

// Memasukkan file class-pegawai.php untuk mengakses class Pegawai
include_once '../config/class-pegawai.php';
// Membuat objek dari class Pegawai
$pegawai = new Pegawai();
// Mengambil id pegawai dari parameter GET
$id = $_GET['id'];
// Memanggil method deletePegawai untuk menghapus data pegawai berdasarkan id
$delete = $pegawai->deletePegawai($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>