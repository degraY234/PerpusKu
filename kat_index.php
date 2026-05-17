<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Jika tidak login atau bukan admin, tendang ke index.php
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("location:index.php");
    exit();
}
include_once 'proses.php'; 
$db = new Proses(); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Daftar Kategori Buku</h1>
<a href="kat_create.php" class="btn" style="display: inline-block; margin-bottom: 20px;">+ TAMBAH KATEGORI BARU</a> | <a href="index.php" class="btn" style="display: inline-block;">Kembali</a>
<table>
    <tr style="background-color: #00d4ff; color: black;">
        <th style="width: 50px;">No</th>
        <th>Nama Kategori</th>
        <th style="width: 100px;">Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = $db->tampil_kategori();
    if(!empty($data)){
        foreach($data as $row){
    ?>
    <tr>
        <td style="text-align: center;"><?= $no++; ?></td>
        <td><?= $row['nama_kategori']; ?></td>
        <td style="text-align: center;">
            <a href="proses.php?id=<?= $row['id_kategori']; ?>&aksi=hapus_kat" 
               style="color: #ff4b2b; font-weight: bold; text-decoration: none;"
               onclick="return confirm('Yakin ingin menghapus kategori ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php 
        } 
    } else {
        echo "<tr><td colspan='3' style='text-align:center;'>Belum ada kategori</td></tr>";
    }
    ?>
</table>
</body>
</html>