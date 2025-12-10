<?php

session_start();


if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}


include 'koneksi.php'; 




if (!isset($_GET['id'])) {
    header("Location: admin_team.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query_data = mysqli_query($conn, "SELECT * FROM teams WHERE id='$id'");
$data = mysqli_fetch_assoc($query_data);


if (!$data) {
    echo "Data Tim tidak ditemukan!";
    exit();
}


if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_tim']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $logo = mysqli_real_escape_string($conn, $_POST['logo_file']);

    $sql = "UPDATE teams SET nama_tim='$nama', deskripsi='$deskripsi', logo_file='$logo' WHERE id='$id'";
    mysqli_query($conn, $sql);
    header("Location: admin_team.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tim Esports</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #eee; }
        .box { background: white; padding: 20px; max-width: 600px; margin: auto; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border:1px solid #ccc;}
        button { background: #f5c518; border: none; padding: 10px 20px; cursor: pointer; font-weight: bold;}
    </style>
</head>
<body>
    <div class="box">
        <h2>Edit Tim: <?= $data['nama_tim'] ?></h2>
        <form method="POST">
            <label>Nama Tim</label>
            <input type="text" name="nama_tim" value="<?= $data['nama_tim'] ?>">
            
            <label>Nama File Logo</label>
            <input type="text" name="logo_file" value="<?= $data['logo_file'] ?>">

            <label>Deskripsi Singkat</label>
            <textarea name="deskripsi" rows="5"><?= $data['deskripsi'] ?></textarea>

            <button type="submit" name="update">Update Tim</button>
            <a href="admin_team.php">Batal</a>
        </form>
    </div>
</body>
</html>