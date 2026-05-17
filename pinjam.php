<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include_once 'proses.php';
$db = new Proses();

if (!isset($_SESSION['id_user']) || $_SESSION['level'] == 'guest') {
    echo "<script>alert('Guest atau User tidak login tidak bisa meminjam!'); window.location='index.php';</script>";
    exit();
}

$id = $_GET['id'];
$data = mysqli_query($db->con, "SELECT * FROM buku WHERE id_buku='$id'");
$b = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Pinjam</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div style="padding: 50px; max-width: 400px; margin: 50px auto; background: #161b22; border: 1px solid #00d4ff; box-shadow: 0 0 15px #00d4ff; border-radius: 10px;">
    <h2 style="color: #00d4ff; text-align: center;">Verifikasi Pinjam</h2>
    <form action="proses.php?aksi=proses_pinjam" method="post">
        <input type="hidden" name="id_buku" value="<?= $b['id_buku']; ?>">
        <p>Buku: <b style="color: #fff;"><?= $b['judul_buku'] ?></b></p>
        <p>Peminjam: <b style="color: #00d4ff;"><?= $_SESSION['username'] ?></b></p>
        
        <div style="margin-bottom: 20px;">
            <label style="color: #ccc;">Masukkan NIM Anda:</label>
            <input type="number" name="nim_verifikasi" required placeholder="NIM saat daftar"
                   style="width: 100%; padding: 10px; background: #0d1117; color: #fff; border: 1px solid #30363d; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="color: #ccc;">Tanggal Pinjam:</label>
            <input type="date" name="tgl_pinjam" required 
                   style="width: 100%; padding: 10px; background: #0d1117; color: #fff; border: 1px solid #30363d; border-radius: 5px;">
        </div>
        <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: bold;"> KONFIRMASI PINJAM </button>
    </form>
</div>
</body>
</html>