<?php
session_start();
session_destroy(); // Menghapus semua data login
header("location:login.php"); // Melempar user kembali ke halaman login
?>