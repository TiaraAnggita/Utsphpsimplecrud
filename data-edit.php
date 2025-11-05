<?php 

include_once 'config/class-master.php';
include_once 'config/class-pegawai.php';
$master = new MasterData();
$pegawai = new Pegawai();
// Mengambil daftar jabatan pegawai, departemen, dan status pegawai
$jabatanList = $master->getJabatan();
// Mengambil daftar jabatan
$departemenList = $master->getDepartemen();
// Mengambil daftar status pegawai
$statusList = $master->getStatus();
// Mengambil data pegawai yang akan diedit berdasarkan id dari parameter GET
$dataPegawai = $pegawai->getUpdatePegawai($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data pegawai. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Edit Pegawai</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Formulir Pegawai</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataPegawai['id']; ?>">
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">Nomor Induk Kepegawaian (NIK)</label>
                                                <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK Pegawai" value="<?php echo $dataPegawai['nik']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Pegawai" value="<?php echo $dataPegawai['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan Pegawai</label>
                                                <select class="form-select" id="jabatan" name="jabatan" required>
                                                    <option value="" selected disabled>Pilih Jabatan Pegawai</option>
                                                    <?php 
                                                    // Iterasi daftar jabatan dan menandai yang sesuai dengan data pegawai yang dipilih
                                                    foreach ($jabatanList as $jabatan){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedJabatan = "";
                                                        // Mengecek apakah jabatan saat ini sesuai dengan data pegawai
                                                        if($dataPegawai['jabatan'] == $jabatan['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedJabatan = "selected";
                                                        }
                                                        // Menampilkan opsi jabatan pegawai dengan penanda yang sesuai
                                                        echo '<option value="'.$jabatan['id'].'" '.$selectedJabatan.'>'.$jabatan['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" required><?php echo $dataPegawai['alamat']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="departemen" class="form-label">Departemen</label>
                                                <select class="form-select" id="departemen" name="departemen" required>
                                                    <option value="" selected disabled>Pilih Departemen</option>
                                                    <?php
                                                    // Iterasi daftar departemen dan menandai yang sesuai dengan data pegawai yang dipilih
                                                    foreach ($departemenList as $departemen){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedDepartemen = "";
                                                        // Mengecek apakah departemen saat ini sesuai dengan data pegawai
                                                        if($dataPegawai['departemen'] == $departemen['id_departemen']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedDepartemen = "selected";
                                                        }
                                                        // Menampilkan opsi departemen dengan penanda yang sesuai
                                                        echo '<option value="'.$departemen['id_departemen'].'" '.$selectedDepartemen.'>'.$departemen['nama_departemen'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid dan Benar" value="<?php echo $dataPegawai['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telpon/HP" value="<?php echo $dataPegawai['telp']; ?>" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status pegawai dan menandai yang sesuai dengan data pegawai yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data pegawai
                                                        if($dataPegawai['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>