<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar jabatan pegawai
    public function getJabatan(){
        $query = "SELECT * FROM tb_jabatan";
        $result = $this->conn->query($query);
        $jabatan = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jabatan[] = [
                    'id' => $row['kode_jabatan'],
                    'nama' => $row['nama_jabatan']
                ];
            }
        }
        return $jabatan;
    }

    // Method untuk mendapatkan daftar departemen
    public function getDepartemen(){
        $query = "SELECT * FROM tb_departemen";
        $result = $this->conn->query($query);
        $departemen = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $departemen[] = [
                    'id_departemen' => $row['id_departemen'],
                    'nama_departemen' => $row['nama_departemen']
                ];
            }
        }
        return $departemen;
    }

    // Method untuk mendapatkan daftar status pegawai menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Sudah Menikah'],
            ['id' => 2, 'nama' => 'Belum Menikah'],
            ['id' => 3, 'nama' => 'Cuti'],
            ['id' => 4, 'nama' => 'Aktif']
        ];
    }

    // Method untuk input data jabatan pegawai
    public function inputJabatan($data){
        $kodeJabatan = $data['kode'];
        $namaJabatan = $data['nama'];
        $query = "INSERT INTO tb_jabatan (kode_jabatan, nama_jabatan) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeJabatan, $namaJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data jabatan pegawai berdasarkan kode
    public function getUpdateJabatan($id){
        $query = "SELECT * FROM tb_jabatan WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jabatan = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jabatan = [
                'id' => $row['kode_jabatan'],
                'nama' => $row['nama_jabatan']
            ];
        }
        $stmt->close();
        return $jabatan;
    }

    // Method untuk mengedit data jabatan pegawai
    public function updateJabatan($data){
        $kodeJabatan = $data['kode'];
        $namaJabatan = $data['nama'];
        $query = "UPDATE tb_jabatan SET nama_jabatan = ? WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaJabatan, $kodeJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data jabatan pegawai
    public function deleteJabatan($id){
        $query = "DELETE FROM tb_jabatan WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data departemen
    public function inputDepartemen($data){
        $namaDepartemen = $data['nama'];
        $query = "INSERT INTO tb_departemen (nama_departemen) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaDepartemen);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data departemen berdasarkan id
    public function getUpdateDepartemen($id){
        $query = "SELECT * FROM tb_departemen WHERE id_departemen = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $departemen = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $departemen = [
                'id' => $row['id_departemen'],
                'nama' => $row['nama_departemen']
            ];
        }
        $stmt->close();
        return $departemen;
    }

    // Method untuk mengedit data departemen
    public function updateDepartemen($data){
        $idDepartemen = $data['id'];
        $namaDepartemen = $data['nama'];
        $query = "UPDATE tb_departemen SET nama_departemen = ? WHERE id_departemen = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaDepartemen, $idDepartemen);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data departemen
    public function deleteDepartemen($id){
        $query = "DELETE FROM tb_departemen WHERE id_departemen = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>