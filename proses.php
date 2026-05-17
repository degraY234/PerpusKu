<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'database.php';

class Proses extends Database {
    function tampil_buku() {
        $hasil = [];
        $sql = "SELECT b.*, k.nama_kategori FROM buku b LEFT JOIN kategori k ON b.id_kategori = k.id_kategori";
        $data = mysqli_query($this->con, $sql);
        while ($row = mysqli_fetch_array($data)) { $hasil[] = $row; }
        return $hasil;
    }

    function tampil_buku_filter($id_kategori = "") {
        $hasil = [];
        $query = "SELECT b.*, k.nama_kategori FROM buku b LEFT JOIN kategori k ON b.id_kategori = k.id_kategori";
        if ($id_kategori != "") { $query .= " WHERE b.id_kategori = '$id_kategori'"; }
        $data = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_array($data)) { $hasil[] = $row; }
        return $hasil;
    }

    function tambah_buku($judul, $pengarang, $stok, $id_kat) {
        $sql = "INSERT INTO buku (judul_buku, pengarang, stok, id_kategori) 
                VALUES ('$judul', '$pengarang', '$stok', '$id_kat')";
        mysqli_query($this->con, $sql);
    }

    function tampil_kategori() {
        $hasil = [];
        $data = mysqli_query($this->con, "SELECT * FROM kategori");
        if($data) {
            while ($row = mysqli_fetch_array($data)) { $hasil[] = $row; }
        }
        return $hasil;
    }

    function tambah_kategori($nama) {
        $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama')";
        mysqli_query($this->con, $sql);
    }
    
    function hapus_kategori($id) {
        mysqli_query($this->con, "DELETE FROM kategori WHERE id_kategori='$id'");
    }

    function hapus_buku($id) {
        mysqli_query($this->con, "DELETE FROM buku WHERE id_buku='$id'");
    }

    function hapus_pinjam($id_buku) {
        mysqli_query($this->con, "DELETE FROM peminjaman WHERE id_buku='$id_buku'");
        mysqli_query($this->con, "UPDATE buku SET stok = stok + 1 WHERE id_buku='$id_buku'");
    }

    function tampil_mahasiswa() {
        $hasil = [];    
        $data = mysqli_query($this->con, "SELECT * FROM mahasiswa");
        while ($row = mysqli_fetch_array($data)) { $hasil[] = $row; }
        return $hasil;
    }

    function tambah_mhs($nama, $nim, $kelas, $no_hp) {
        $sql = "INSERT INTO mahasiswa (nama, nim, kelas, no_hp) VALUES ('$nama', '$nim', '$kelas', '$no_hp')";
        mysqli_query($this->con, $sql);
    }

    function hapus_mhs($id) {
        mysqli_query($this->con, "DELETE FROM mahasiswa WHERE id_mhs='$id'");
    }
}

$db = new Proses();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : "";

if ($aksi == "tambah_buku") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];
    $id_kat = $_POST['id_kategori'];
    $db->tambah_buku($judul, $pengarang, $stok, $id_kat);
    header("location:index.php");
// Cari bagian elseif ($aksi == "proses_pinjam")
} elseif ($aksi == "proses_pinjam") {
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    
    // Ambil NIM dari session. Kalau loginnya bener, NIM pasti ada di sini.
    $nim = isset($_SESSION['nim']) ? $_SESSION['nim'] : ''; 
    $status = "Dipinjam";

    // SESUAIKAN DENGAN SCREENSHOT TABEL LU (id_buku, nim, tgl_pinjam, status)
    $sql = "INSERT INTO peminjaman (id_buku, nim, tgl_pinjam, status) 
            VALUES ('$id_buku', '$nim', '$tgl_pinjam', '$status')";
    
    $simpan = mysqli_query($db->con, $sql);

    if($simpan) {
        mysqli_query($db->con, "UPDATE buku SET stok = stok - 1 WHERE id_buku = '$id_buku'");
        header("location:index.php");
    } else {
        // Biar ketahuan kalau ada masalah lain
        die("Gagal Simpan Pinjam: " . mysqli_error($db->con));
    }
} elseif ($aksi == "hapus_pinjam") {
    $db->hapus_pinjam($_GET['id_buku']);
    header("location:index.php");

} elseif ($aksi == "hapus_buku") {
    $db->hapus_buku($_GET['id']);
    header("location:index.php");

} elseif ($aksi == "tambah_kat") {
    $db->tambah_kategori($_POST['nama_kategori']);
    header("location:kat_index.php");

} elseif ($aksi == "hapus_kat") {
    $db->hapus_kategori($_GET['id']);
    header("location:kat_index.php");

} elseif ($aksi == "tambah_mhs") {
    $db->tambah_mhs($_POST['nama'], $_POST['nim'], $_POST['kelas'], $_POST['no_hp']);
    header("location:mhs_index.php");

} elseif ($aksi == "hapus_mhs") {
    $db->hapus_mhs($_GET['id']);
    header("location:mhs_index.php");
}
?>