<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menangani mode Guest dari login.php
if (isset($_GET['mode']) && $_GET['mode'] == 'guest') {
    $_SESSION['level'] = 'guest';
}

if (!isset($_SESSION['level'])) { 
    header("location:login.php"); 
    exit();
}

include_once 'proses.php'; // Gunakan include_once agar tidak bentrok class
$db = new Proses(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Neon Library System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <a href="index.php">DASHBOARD</a>
    <?php if($_SESSION['level'] == 'admin'): ?>
        <a href="mhs_index.php">MASTER MAHASISWA</a>
        <a href="kat_index.php">MASTER KATEGORI</a>
    <?php endif; ?>
    <a href="logout.php" style="color: #ff4500;">LOGOUT</a>
</nav>

<div style="padding: 20px;">
    <h1>Katalog Buku Perpustakaan</h1>
    <?php if($_SESSION['level'] == 'admin'): ?>
    <a href="create.php" class="btn" style="margin-bottom: 20px; display: inline-block;">+ TAMBAH DATA BUKU BARU</a>
<?php endif; ?>
    
    <form method="get" action="index.php" style="margin-bottom: 20px;">
        <select name="filter_kategori" style="padding: 5px; background: #161b22; color: #00d4ff; border: 1px solid #00d4ff;">
            <option value="">-- Semua Kategori --</option>
            <?php 
            $kat = $db->tampil_kategori();
            foreach($kat as $k) {
                $selected = (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] == $k['id_kategori']) ? 'selected' : '';
                echo "<option value='".$k['id_kategori']."' $selected>".$k['nama_kategori']."</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn" style="padding: 5px 15px;">Cari</button>
        <a href="index.php" class="btn" style="padding: 5px 15px; text-decoration: none;">Reset</a>
    </form>

    <table border="1">
        <?php
         $id_kat = isset($_GET['filter_kategori']) ? $_GET['filter_kategori'] : "";
         $tampil = $db->tampil_buku_filter($id_kat);; // Panggil fungsi yang baru kita buat di atas
        if(!empty($tampil)){
            echo "<tr><th>No</th><th>Judul Buku</th><th>Stok</th><th>Aksi</th></tr>";
            $no = 1;
            foreach($tampil as $row){
                echo "<tr>
                        <td>".$no++."</td>
                        <td>".$row['judul_buku']."</td>
                        <td>".$row['stok']."</td>
                        <td>";
                if($_SESSION['level'] == 'admin') {
                    echo "<a href='proses.php?id=".$row['id_buku']."&aksi=hapus' style='color: #ff4b2b;'>Hapus</a>";
                } else {
                    echo "<a href='pinjam.php?id=".$row['id_buku']."' class='btn' style='padding: 5px 10px;'>Pinjam</a>";
                }
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Data Kosong</td></tr>";
        }
        ?>
    </table>
    <table>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </table>
</div>
</body>
</html>