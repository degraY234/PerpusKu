<?php
session_start();
include 'database.php';
$db = new Database();

$username = mysqli_real_escape_string($db->con, $_POST['username']);
$password = mysqli_real_escape_string($db->con, $_POST['password']);

$query = mysqli_query($db->con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_array($query);

if (mysqli_num_rows($query) > 0) {
    $_SESSION['id_user']  = $data['id_user']; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['level']    = $data['level'];
    $_SESSION['nim']      = $data['nim']; // SIMPAN NIM KE SESSION
    
    header("location:index.php");
    exit();
} else {
    echo "<script>alert('Login Gagal!'); window.location='login.php';</script>";
}
?>