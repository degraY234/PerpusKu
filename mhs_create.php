<?php 
session_start();
// Cek login admin agar tidak sembarang orang bisa akses
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("location:index.php");
    exit();
}
include 'proses.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Mahasiswa - Neon System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">DASHBOARD</a>
        <a href="mhs_index.php">DATA MAHASISWA</a>
    </nav>

    <div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; padding: 20px;">
        <div style="background: #161b22; padding: 40px; border: 1px solid #00d4ff; border-radius: 15px; box-shadow: 0 0 25px rgba(0, 212, 255, 0.2); width: 100%; max-width: 500px;">
            
            <h2 style="color: #00d4ff; text-align: center; margin-bottom: 30px; text-shadow: 0 0 10px #00d4ff; font-family: sans-serif;">
                Input Data Mahasiswa
            </h2>

            <form action="proses.php?aksi=tambah_mhs" method="post">
                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Nama Lengkap:</label>
                    <input type="text" name="nama" required placeholder="Masukkan nama mahasiswa..."
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">NIM:</label>
                    <input type="number" name="nim" required placeholder="Contoh: 220510..."
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">Kelas:</label>
                    <input type="text" name="kelas" required placeholder="Contoh: TK-4A"
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="color: #fff; display: block; margin-bottom: 8px;">No. HP:</label>
                    <input type="text" name="no_hp" required placeholder="0812..."
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #30363d; background: #0d1117; color: #fff; box-sizing: border-box;">
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 15px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    SIMPAN DATA MAHASISWA
                </button>
                
                <a href="mhs_index.php" style="display: block; text-align: center; margin-top: 20px; color: #8b949e; text-decoration: none; font-size: 14px;">
                    ← Kembali ke Manajemen Mahasiswa
                </a>
            </form>
        </div>
    </div>
</body>
</html>