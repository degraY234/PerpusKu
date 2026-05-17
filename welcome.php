<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'proses.php';
$db = new Proses();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di PerpusKu </title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            /* MENGGUNAKAN BACKGROUND GAMBAR PERPUSTAKAAN DIGITAL SAMA SEPERTI MOCKUP LU */
            background: linear-gradient(rgba(13, 17, 23, 0.85), rgba(13, 17, 23, 0.95)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1600&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* TOP NAVIGATION BAR */
        header {
            background: rgba(22, 27, 34, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 212, 255, 0.2);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo {
            font-size: 1.6rem;
            font-weight: bold;
            color: #00d4ff;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }
        nav a {
            color: #8b949e;
            text-decoration: none;
            margin-left: 25px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.3s;
        }
        nav a:hover, nav a.active {
            color: #00d4ff;
            text-shadow: 0 0 8px rgba(0, 212, 255, 0.6);
        }

        /* MAIN CONTAINER */
        .wrapper {
            max-width: 1300px;
            width: 95%;
            margin: 40px auto;
            padding-bottom: 50px;
        }

        /* ROW 1: GRID 3 KOLOM */
        .grid-top {
            display: grid;
            grid-template-columns: 1fr 1.8fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 992px) {
            .grid-top {
                grid-template-columns: 1fr;
            }
        }

        /* CARD STYLE BASE */
        .card {
            background: rgba(22, 27, 34, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(48, 54, 61, 0.7);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: transform 0.3s, border-color 0.3s;
        }
        .card:hover {
            border-color: rgba(0, 212, 255, 0.5);
            transform: translateY(-2px);
        }
        .card-title {
            color: #00d4ff;
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* KOLOM LEFT: FASILITAS */
        .facility-item {
            margin-bottom: 20px;
            padding-left: 10px;
            border-left: 3px solid rgba(0, 212, 255, 0.4);
        }
        .facility-item h4 {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 5px;
        }
        .facility-item p {
            color: #8b949e;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        /* KOLOM CENTER: HERO BOX */
        .hero-card {
            text-align: center;
            border: 1px solid rgba(0, 212, 255, 0.4);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .hero-card h1 {
            color: #00d4ff;
            font-size: 2.3rem;
            margin-bottom: 15px;
            text-shadow: 0 0 12px rgba(0, 212, 255, 0.4);
        }
        .hero-card .tagline {
            color: #c9d1d9;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .hero-card .desc {
            color: #8b949e;
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 550px;
            margin-bottom: 35px;
        }
        .cta-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-neon {
            padding: 12px 24px;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        .btn-login {
            background: #00d4ff;
            color: #0d1117;
            border: 1px solid #00d4ff;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }
        .btn-login:hover {
            background: transparent;
            color: #00d4ff;
            box-shadow: 0 0 20px #00d4ff;
        }
        .btn-register {
            background: transparent;
            color: #28a745;
            border: 1px solid #28a745;
        }
        .btn-register:hover {
            background: #28a745;
            color: #fff;
            box-shadow: 0 0 15px #28a745;
        }
        .btn-guest {
            background: transparent;
            color: #ff9f43;
            border: 1px solid #ff9f43;
        }
        .btn-guest:hover {
            background: #ff9f43;
            color: #0d1117;
            box-shadow: 0 0 15px #ff9f43;
        }

        /* KOLOM RIGHT: STATISTIK */
        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(33, 38, 45, 0.5);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 12px;
            border: 1px solid rgba(48, 54, 61, 0.5);
        }
        .stat-info h4 {
            font-size: 1.1rem;
            color: #fff;
        }
        .stat-info p {
            font-size: 0.8rem;
            color: #8b949e;
        }
        .sparkline {
            font-size: 1.5rem;
            color: #00d4ff;
            font-weight: bold;
        }

        /* ROW 2: GRID 2 KOLOM (BOTTOM) */
        .grid-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        @media (max-width: 768px) {
            .grid-bottom {
                grid-template-columns: 1fr;
            }
        }

        .instruction-list {
            list-style: none;
        }
        .instruction-list li {
            font-size: 0.9rem;
            color: #c9d1d9;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        .instruction-list b {
            color: #00d4ff;
        }

        .kategori-badge {
            display: inline-block;
            background: rgba(5, 59, 135, 0.8);
            color: #58a6ff;
            padding: 6px 14px;
            margin: 6px;
            border-radius: 4px;
            border: 1px solid rgba(48, 54, 61, 0.8);
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        .kategori-badge:hover {
            background: #00d4ff;
            color: #0d1117;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
            border-color: #00d4ff;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<header>
    <div class="logo">PerpusKu</div>
    <nav>
        <a href="#" class="active">Home</a>
        <a href="login.php">Penggunaan</a>
        <a href="daftar.php">Sign In</a>
        <a href="index.php?mode=guest">Guest</a>
    </nav>
</header>

<div class="wrapper">

    <div class="grid-top">
        
        <div class="card">
            <div class="card-title">Fasilitas & Layanan</div>
            
            <div class="facility-item">
                <h4>Katalog Digital Luas</h4>
                <p>Silakan akses secara online dan telusuri koleksi buku berbobot kami.</p>
            </div>
            
            <div class="facility-item">
                <h4>Peminjaman Instan</h4>
                <p>Peminjaman instan, aman, cepat, tanpa antre panjang di meja admin.</p>
            </div>
            
            <div class="facility-item">
                <h4>Akses Multi-perangkat</h4>
                <p>Akses katalog kapan saja melalui laptop, smartphone, atau tablet Anda.</p>
            </div>
        </div>

        <div class="card hero-card">
            <h1>Selamat Datang di PerpusKu</h1>
            <p class="tagline">Platform Digital Membaca, Meminjam, dan Menjelajahi Pengetahuan tanpa Batas Ingin Melihat Koleksi Buku Kami? Kalau Begitu Segera Daftar!</p>
            <p class="desc">
                PerpusKu adalah prototype sistem informasi perpustakaan modern berbasis web yang dirancang khusus untuk memudahkan civitas akademika dalam mengelola transaksi peminjaman buku secara digital, cepat, dan terintegrasi langsung dengan ketersediaan stok fisik di rak.
            </p>
            
            <div class="cta-group">
                <a href="login.php" class="btn-neon btn-login">Login Pengguna</a>
                <a href="daftar.php" class="btn-neon btn-register">Daftar Akun Baru</a>
                <a href="index.php?mode=guest" class="btn-neon btn-guest">Masuk sebagai Guest</a>
            </div>
        </div>

        <div class="card">
            <div class="card-title">Statistik Hari Ini</div>
            
            <div class="stat-item">
                <div class="stat-info">
                    <h4>15 Buku</h4>
                    <p>Dipinjam Hari Ini</p>
                </div>
                <div class="sparkline">📈</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-info">
                    <h4>3 Buku</h4>
                    <p>Baru Ditambahkan</p>
                </div>
                <div class="sparkline">📊</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-info">
                    <h4>2 Anggota</h4>
                    <p>Baru Mendaftar</p>
                </div>
                <div class="sparkline">📉</div>
            </div>
        </div>

    </div>

    <div class="grid-bottom">
        
        <div class="card">
            <div class="card-title">Cara Meminjam Buku</div>
            <ul class="instruction-list">
                <li>1. Silakan buat akun melalui menu <b>Daftar Akun Baru</b>.</li>
                <li>2. Masuk menggunakan akun yang telah berhasil dibuat.</li>
                <li>3. Pilih buku favorit di Katalog Utama, masukkan NIM verifikasi Anda, dan buku langsung siap dibawa.</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-title">Kategori Tersedia</div>
            <p style="color: #8b949e; font-size: 0.9rem; margin-bottom: 15px;">
                Kami menyediakan berbagai literatur berbobot. Kategori di bawah ini ditarik secara dinamis dari database:
            </p>
            <div>
                <?php 
                $kat = $db->tampil_kategori();
                if(!empty($kat)) {
                    foreach($kat as $k) {
                        echo "<span class='kategori-badge'>".htmlspecialchars($k['nama_kategori'])."</span>";
                    }
                } else {
                    echo "<span class='kategori-badge' style='color: #ff7675;'>Belum ada kategori</span>";
                }
                ?>
            </div>
        </div>

    </div>

</div>

</body>
</html>