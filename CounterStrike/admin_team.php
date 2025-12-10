<?php

session_start();


if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}


include 'koneksi.php'; 


if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_tim']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    
    $logo = "default_logo.jpg"; 
    
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] == 0) {
        $file_info = $_FILES['logo_file'];
        $file_name = basename($file_info['name']);
        $file_tmp = $file_info['tmp_name'];
        $target_dir = "asset/"; 

        if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {
            $logo = mysqli_real_escape_string($conn, $file_name); 
        } else {
            echo "<script>alert('Gagal memindahkan file logo.');</script>";
        }
    }
    

    $sql = "INSERT INTO teams (nama_tim, deskripsi, logo_file) VALUES ('$nama', '$deskripsi', '$logo')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_team.php");
    } else {
        echo "<script>alert('Gagal menambahkan tim: " . mysqli_error($conn) . "');</script>";
    }
    exit();
}


if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    $query_logo = mysqli_query($conn, "SELECT logo_file FROM teams WHERE id='$id'");
    $data_logo = mysqli_fetch_assoc($query_logo);
    
    if ($data_logo) {
        $logo_to_delete = $data_logo['logo_file'];
        $target_dir = "asset/";
        
        if ($logo_to_delete != "default_logo.jpg" && file_exists($target_dir . $logo_to_delete)) {
            if (!unlink($target_dir . $logo_to_delete)) {
                 echo "<script>alert('Peringatan: Gagal menghapus file fisik: " . $logo_to_delete . "');</script>";
            }
        }
    }
    
    $delete_sql = "DELETE FROM teams WHERE id='$id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: admin_team.php");
    } else {
        echo "<script>alert('Gagal menghapus data tim: " . mysqli_error($conn) . "');</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Kelola Tim</title>
    <style>
        
        :root {
            --primary-color: #f5c518; 
            --danger-color: #ff4444; 
            --dark-color: #333;
            --light-bg: #f4f4f4;
            --box-bg: #ffffff;
            --border-color: #ddd;
        }

        
        body { 
            font-family: sans-serif; 
            padding: 20px; 
            background: var(--light-bg); 
            color: var(--dark-color);
        }
        
        
        .container { 
            max-width: 900px; 
            margin: auto; 
            background: var(--box-bg); 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        
        
        h2 { 
            border-bottom: 3px solid var(--primary-color); 
            padding-bottom: 10px; 
            margin-bottom: 20px;
        }

        
        label { 
            display: block; 
            margin-top: 10px; 
            font-weight: bold;
        }
        input[type=text], input[type=file], textarea { 
            width: 100%; 
            padding: 10px; 
            margin: 5px 0 15px; 
            border: 1px solid var(--border-color); 
            border-radius: 4px; 
            box-sizing: border-box;
        }
        
        
        button { 
            background: var(--primary-color); 
            border: none; 
            padding: 10px 20px; 
            cursor: pointer; 
            font-weight: bold; 
            color: var(--dark-color);
            border-radius: 4px;
        }
        button:hover { 
            background: #ffd700; 
        }

        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid var(--border-color); 
            padding: 10px; 
            text-align: left; 
        }
        th { 
            background: var(--dark-color); 
            color: white; 
        }
        tr:nth-child(even) { 
            background: #f2f2f2; 
        }
        
        
        .btn-delete, .btn-edit {
            text-decoration: none; 
            padding: 5px 10px; 
            border-radius: 4px; 
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-block;
        }
        .btn-delete { 
            background: var(--danger-color); 
            color: white; 
        }
        .btn-edit { 
            background: #4444ff; 
            color: white; 
        }

        
        .header-admin-nav {
            text-align: right;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .header-admin-nav strong {
            color: var(--primary-color); 
            font-weight: bold;
        }
        .header-admin-nav a {
            margin-left: 15px;
            color: var(--danger-color); 
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }
        .header-admin-nav a:hover {
            color: darkred;
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="header-admin-nav">
        <a href="index.php" class="nav-link" style="color: #00b3ffff; padding-right: 10px;">Website</a>
        Selamat Datang, **<?= htmlspecialchars($_SESSION['username']) ?>**!
            <a href="admin.php" class="nav-link" style="color: #4444ff;">Kelola Berita</a>
            
        <a href="logout.php">Logout</a>
    </div>
    <h2>Tambah Tim Esports Baru</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama Tim</label>
        <input type="text" name="nama_tim" required placeholder="Contoh: FaZe Clan">

        <label>Upload Logo Tim Baru</label>
        <input type="file" name="logo_file" accept="image/*" required> 
        
        <label>Deskripsi Singkat</label>
        <textarea name="deskripsi" rows="3" required placeholder="Contoh: Global superstars, Major champions..."></textarea>

        <button type="submit" name="tambah">Tambah Tim</button>
    </form>

    <h2 style="margin-top: 40px;">Daftar Tim Esports</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Tim</th>
                <th>Logo File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tampil = mysqli_query($conn, "SELECT * FROM teams ORDER BY id DESC");
            
            if (!$tampil) {
                 echo "<tr><td colspan='4'>Error: " . mysqli_error($conn) . "</td></tr>";
            } else {
                 while($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
                <td><?= htmlspecialchars($data['id']) ?></td>
                <td><?= htmlspecialchars($data['nama_tim']) ?></td>
                <td><?= htmlspecialchars($data['logo_file']) ?></td>
                <td>
                    <a href="edit_team.php?id=<?= $data['id'] ?>" class="btn-edit">Edit</a>
                    <a href="admin_team.php?hapus=<?= $data['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin hapus tim <?= htmlspecialchars($data['nama_tim']) ?>?')">Hapus</a>
                </td>
            </tr>
            <?php 
                 endwhile; 
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>