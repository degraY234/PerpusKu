<?php 
session_start();
// Proteksi Admin
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
    <title>Tambah Kategori - Neon System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">DASHBOARD</a>
        <a href="kat_index.php">MASTER KATEGORI</a>
    </nav>

    <div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
        <div style="background: #161b22; padding: 30px; border: 1px solid #00d4ff; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 212, 255, 0.3); width: 100%; max-width: 400px;">
            
            <h2 style="color: #00d4ff; text-align: center; margin-bottom: 20px; text-shadow: 0 0 10px #00d4ff;">
                Tambah Kategori Baru
            </h2>

            <form action="proses.php?aksi=tambah_kat" method="post">
                <div style="margin-bottom: 15px;">
                    <label style="color: #fff; display: block; margin-bottom: 5px;">Nama Kategori:</label>
                    <input type="text" name="nama_kategori" required 
                           placeholder="Contoh: Sains, Novel, Teknologi..."
                           style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #30363d; background: #0d1117; color: #fff;">
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 12px; font-weight: bold;">
                    SIMPAN KATEGORI
                </button>
                
                <a href="kat_index.php" style="display: block; text-align: center; margin-top: 15px; color: #8b949e; text-decoration: none; font-size: 0.9em;">
                    ← Kembali ke Daftar
                </a>
            </form>
        </div>
    </div>
</body>
</html>