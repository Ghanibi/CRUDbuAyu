<?php
include 'koneksi.php'; 

$success = '';
$error = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    
    if ($password !== $confirm_password) {
        $error = 'Konfirmasi password tidak cocok.';
    } else {
        
        $query_check = "SELECT username FROM users WHERE username='$username'";
        $result_check = mysqli_query($conn, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            $error = 'Username sudah terdaftar. Gunakan username lain.';
        } else {
            
            $final_password = $password;

            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$final_password')";
            
            if (mysqli_query($conn, $sql)) {
                $success = 'Pendaftaran berhasil! Silakan <a href="login.php">Login</a>.';
            } else {
                $error = 'Pendaftaran gagal: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Admin</title>
    <style>
        body { font-family: sans-serif; background: #333; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .register-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); width: 300px; }
        .register-box h2 { text-align: center; color: #f5c518; margin-bottom: 20px; border-bottom: 2px solid #f5c518; padding-bottom: 10px; }
        .register-box label { display: block; margin-top: 10px; font-weight: bold; }
        .register-box input[type=text], .register-box input[type=password] { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .register-box button { width: 100%; background: #4CAF50;  color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .register-box button:hover { background: #45a049; }
        .message-success { color: green; text-align: center; margin-bottom: 15px; }
        .message-error { color: red; text-align: center; margin-bottom: 15px; }
        .login-link { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register Akun Admin</h2>
        
        <?php if ($error): ?>
            <p class="message-error"><?= $error ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="message-success"><?= $success ?></p>
        <?php endif; ?>
        
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit" name="register">Daftar</button>
        </form>
        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
</body>
</html>