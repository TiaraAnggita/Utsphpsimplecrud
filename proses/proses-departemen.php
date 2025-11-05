<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputdepartemen'){
    // Mengambil data departemen dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataDepartemen = [
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputDepartemen untuk memasukkan data departemen dengan parameter array $dataDepartemen
    $input = $master->inputDepartemen($dataDepartemen);
    if($input){
        header("Location: ../master-departemen-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-departemen-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatedepartemen'){
    // Mengambil data departemen dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataDepartemen = [
        'id' => $_POST['id_departemen'],
        'nama' => $_POST['nama_departemen']
    ];
    // Memanggil method updateDepartemen untuk mengupdate data departemen dengan parameter array $dataDepartemen
    $update = $master->updateDepartemen($dataDepartemen);
    if($update){
        header("Location: ../master-departemen-list.php?status=editsuccess");
    } else {
        header("Location: ../master-departemen-edit.php?id=".$dataDepartemen['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletedepartemen'){
    // Mengambil id departemen dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteDepartemen untuk menghapus data departemen berdasarkan id
    $delete = $master->deleteDepartemen($id);
    if($delete){
        header("Location: ../master-departemen-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-departemen-list.php?status=deletefailed");
    }
}

?>