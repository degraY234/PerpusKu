<?php 
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("location:index.php");
    exit();
}
include 'proses.php'; 
$db = new Proses();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><a href="index.php">DASHBOARD</a></nav>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; padding: 20px;">
        <div style="background: #161b22; padding: 40px; border: 1px solid #00d4ff; border-radius: 15px; width: 100%; max-width: 500px;">
            <h2 style="color: #00d4ff; text-align: center; margin-bottom: 30px;">Tambah Koleksi Buku</h2>
            <form action="proses.php?aksi=tambah_buku" method="post">
                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Judul Buku:</label>
                    <input type="text" name="judul" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Pengarang:</label>
                    <input type="text" name="pengarang" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Stok Buku:</label>
                    <input type="number" name="stok" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff;">
                </div>
                <div style="margin-bottom: 30px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Kategori:</label>
                    <select name="id_kategori" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff;">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($db->tampil_kategori() as $k) { echo "<option value='$k[id_kategori]'>$k[nama_kategori]</option>"; } ?>
                    </select>
                </div>
                <button type="submit" class="btn" style="width: 100%; padding: 15px;">SIMPAN BUKU BARU</button>
            </form>
        </div>
    </div>
</body>
</html>