<?php 
session_start();
include 'proses.php'; 
$db = new Proses(); 
?>
<h1>Daftar Kategori Tersedia</h1>
<table border="1">
    <tr><th>No</th><th>Nama Kategori</th></tr>
    <?php
    $no = 1;
    foreach($db->tampil_kategori() as $row){
        echo "<tr><td>$no</td><td>".$row['nama_kategori']."</td></tr>";
        $no++;
    }
    ?>
</table>
<a href="index.php">Kembali ke Katalog</a>