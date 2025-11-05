<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputjabatan'){
    // Mengambil data jabatan dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputJabatan untuk memasukkan data jabatan dengan parameter array $dataJabatan
    $input = $master->inputJabatan($dataJabatan);
    if($input){
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status inputsuccess
        header("Location: ../master-jabatan-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-input.php dengan status failed
        header("Location: ../master-jabatan-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatejabatan'){
    // Mengambil data jabatan dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'id' => $_POST['id'],
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateJabatan untuk mengupdate data jabatan dengan parameter array $dataJabatan
    $update = $master->updateJabatan($dataJabatan);
    if($update){
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status editsuccess
        header("Location: ../master-jabatan-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-edit.php dengan status failed dan membawa id jabatan
        header("Location: ../master-jabatan-edit.php?id=".$dataJabatan['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletejabatan'){
    // Mengambil id jabatan dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteJabatan untuk menghapus data jabatan berdasarkan id
    $delete = $master->deleteJabatan($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status deletesuccess
        header("Location: ../master-jabatan-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-list.php dengan status deletefailed
        header("Location: ../master-jabatan-list.php?status=deletefailed");
    }
}

?>