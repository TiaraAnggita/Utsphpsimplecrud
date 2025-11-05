<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Pegawai extends Database {

    // Method untuk input data pegawai
    public function inputPegawai($data){
        // Mengambil data dari parameter $data
        $nik      = $data['nik'];
        $nama     = $data['nama'];
        $jabatan    = $data['jabatan'];
        $alamat   = $data['alamat'];
        $departemen = $data['departemen'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_pegawai (nik_pgw, nama_pgw, jabatan_pgw, alamat, departemen, email, telp, status_pgw) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss",  $nik, $nama, $jabatan, $alamat, $departemen, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data pegawai
    public function getAllPegawai(){
        // Menyiapkan query SQL untuk mengambil data pegawai beserta jabatan dan departemen
        $query = "SELECT id_pgw, nik_pgw, nama_pgw, nama_jabatan, nama_departemen, alamat, email, telp, status_pgw
                  FROM tb_pegawai
                  JOIN tb_jabatan ON jabatan_pgw = kode_jabatan
                  JOIN tb_departemen ON departemen = id_departemen";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data pegawai
        $pegawai = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $pegawai[] = [
                    'id' => $row['id_pgw'],
                    'nik' => $row['nik_pgw'],
                    'nama' => $row['nama_pgw'],
                    'jabatan' => $row['nama_jabatan'],
                    'departemen' => $row['nama_departemen'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_pgw']
                ];
            }
        }
        // Mengembalikan array data pegawai
        return $pegawai;
    }

    // Method untuk mengambil data pegawai berdasarkan ID
    public function getUpdatePegawai($id){
        // Menyiapkan query SQL untuk mengambil data pegawai berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_pegawai WHERE id_pgw = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data pegawai  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_pgw'],
                'nik' => $row['nik_pgw'],
                'nama' => $row['nama_pgw'],
                'jabatan' => $row['jabatan_pgw'],
                'alamat' => $row['alamat'],
                'departemen' => $row['departemen'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_pgw']
            ];
        }
        $stmt->close();
        // Mengembalikan data pegawai
        return $data;
    }

    // Method untuk mengedit data pegawai
    public function editPegawai($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $nik      = $data['nik'];
        $nama     = $data['nama'];
        $jabatan    = $data['jabatan'];
        $alamat   = $data['alamat'];
        $departemen = $data['departemen'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_pegawai SET nik_pgw = ?, nama_pgw = ?, jabatan_pgw = ?, alamat = ?, departemen = ?, email = ?, telp = ?, status_pgw = ? WHERE id_pgw = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi", $nik, $nama, $jabatan, $alamat, $departemen, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data pegawai
    public function deletePegawai($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_pegawai WHERE id_pgw = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data pegawai berdasarkan kata kunci
    public function searchPegawai($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data pegawai menggunakan prepared statement
        $query = "SELECT id_pgw, nik_pgw, nama_pgw, nama_jabatan, nama_departemen, alamat, email, telp, status_pgw 
                  FROM tb_pegawai
                  JOIN tb_jabatan ON jabatan_pgw = kode_jabatan
                  JOIN tb_departemen ON departemen = id_departemen
                  WHERE nik_pgw LIKE ? OR nama_pgw LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data pegawai
        $pegawai = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data pegawai dalam array
                $pegawai[] = [
                    'id' => $row['id_pgw'],
                    'nik' => $row['nik_pgw'],
                    'nama' => $row['nama_pgw'],
                    'jabatan' => $row['nama_jabatan'],
                    'departemen' => $row['nama_departemen'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_pgw']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data pegawai yang ditemukan
        return $pegawai;
    }

}

?>