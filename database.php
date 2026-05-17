<?php 
class Database {
    var $host = "127.0.0.1";
    var $uname = "root";
    var $pass = "";
    var $db = "db_perpustakaan"; // Pastikan nama database ini sudah kamu buat di phpMyAdmin
    var $con;

    function __construct() {
        // Membuat koneksi ke MySQL
        $this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
        
        // Cek apakah koneksi berhasil
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }
}
?>