<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi: Hanya Admin yang bisa kelola data mahasiswa
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location='index.php';</script>";
    exit();
}

include_once 'proses.php'; 
$db = new Proses(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Master Mahasiswa - Neon System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <a href="index.php">DASHBOARD</a>
    <a href="mhs_index.php">MASTER MAHASISWA</a>
    <a href="kat_index.php">MASTER KATEGORI</a>
    <a href="logout.php" style="color: #ff4500;">LOGOUT</a>
</nav>

<div style="padding: 20px;">
    <h1 style="color: #fff; text-shadow: 0 0 10px #00d4ff;">Manajemen Data Mahasiswa</h1>
    
    <a href="mhs_create.php" class="btn" style="margin-bottom: 20px;"> + TAMBAH MAHASISWA</a>

    <table>
    <tr style="background-color: #00d4ff; color: black;">
        <th>No</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = $db->tampil_mahasiswa();
    if(!empty($data)){
        foreach($data as $row){
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nim']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['kelas']; ?></td> <td style="text-align: center;">
            <a href="proses.php?id=<?= $row['id_mhs']; ?>&aksi=hapus_mhs" 
               style="color: #ff4b2b; font-weight: bold; text-decoration: none;"
               onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php 
        } 
    } else {
        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data mahasiswa</td></tr>";
    }
    ?>
</table>

</div>
</body>
</html>