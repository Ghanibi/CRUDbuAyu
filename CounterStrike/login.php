<?php
session_start();
include 'koneksi.php'; 

// 1. Cek: Jika sudah login, lakukan redirect sesuai role. (Mencegah WSOD)
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: index.php'); // Redirect ke index.php untuk user biasa
    }
    exit();
}

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        
        // Asumsi: Password disimpan sebagai teks biasa (seperti '123' di database Anda)
        if ($password === $data['password']) {
            
            // --- SET SESSION DENGAN LENGKAP ---
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role']; // SANGAT PENTING: Simpan Role!
            // ----------------------------------
            
            // 2. Redirect setelah login berhasil
            if ($_SESSION['role'] === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <style>
        body { font-family: sans-serif; background: #333; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 8px; width: 300px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        input { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        button { width: 100%; background: #f5c518; border: none; padding: 10px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 style="text-align:center;">Login</h2>
        <?php if($error) echo "<p style='color:red;text-align:center;'>$error</p>"; ?>
        
        <form method="POST">
            <label>Username</label><input type="text" name="username" required>
            <label>Password</label><input type="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p style="text-align:center;">Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>