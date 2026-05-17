<link rel="stylesheet" href="style.css">
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
    <div style="background: #161b22; padding: 40px; border: 1px solid #00d4ff; border-radius: 10px; width: 300px;">
        <h2 style="color: #00d4ff; text-align: center;">Login Perpustakaan</h2>
        <form action="cek_login.php" method="post">
            <label style="color: #fff;">Username:</label><br>
            <input type="text" name="username" required style="width: 100%; padding: 8px; margin: 10px 0;"><br>
            <label style="color: #fff;">Password:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 10px 0;"><br>
            <input type="submit" value="Masuk" class="btn" style="width: 100%; padding: 10px; cursor: pointer;">
        </form>
        <p style="color: #ccc; font-size: 12px; margin-top: 20px; text-align: center;">
            Belum punya akun? <a href="daftar.php" style="color: #00d4ff;">Daftar di sini</a><br><br>
            Atau <a href="index.php?mode=guest" style="color: #00d4ff; font-weight: bold;">Masuk sebagai Guest</a><br><br>
            <a href="welcome.php" style="color: #8b949e; text-decoration: none; font-size: 11px;">&larr; Kembali ke Halaman Utama</a>
    </div>
</div>