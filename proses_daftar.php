<?php 
include 'database.php';
$db = new Database();

$nama     = mysqli_real_escape_string($db->con, $_POST['nama']);
$nim      = mysqli_real_escape_string($db->con, $_POST['nim']); // NIM penting!
$kelas    = mysqli_real_escape_string($db->con, $_POST['kelas']);
$no_hp    = mysqli_real_escape_string($db->con, $_POST['no_hp']);
$username = mysqli_real_escape_string($db->con, $_POST['username']);
$password = mysqli_real_escape_string($db->con, $_POST['password']);
$level    = 'peminjam';

// 1. Simpan ke tabel mahasiswa
$sql_mhs = "INSERT INTO mahasiswa (nama, nim, kelas, no_hp) VALUES ('$nama', '$nim', '$kelas', '$no_hp')";

if (mysqli_query($db->con, $sql_mhs)) {
    // 2. Simpan ke tabel users, bawa NIM-nya kesini juga
    // Pastikan di tabel users lu ada kolom 'nim'
    $sql_user = "INSERT INTO users (username, password, level, nim) 
                 VALUES ('$username', '$password', '$level', '$nim')";
    
    if (mysqli_query($db->con, $sql_user)) {
        echo "<script>alert('Daftar Berhasil!'); window.location='login.php';</script>";
    } else {
        echo "Gagal Tabel Users: " . mysqli_error($db->con);
    }
} else {
    echo "Gagal Tabel Mahasiswa: " . mysqli_error($db->con);
}
?>