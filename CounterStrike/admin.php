<?php

session_start();


if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}


include 'koneksi.php'; 

if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']); 
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $tanggal = date('Y-m-d H:i:s'); 


    $gambar = "default_news.jpg"; 
    
    if (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        $file_info = $_FILES['gambar_file'];
        $file_name = basename($file_info['name']);
        $file_tmp = $file_info['tmp_name'];
        $target_dir = "asset/"; 
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $gambar = mysqli_real_escape_string($conn, $file_name);
        } else {
            echo "<script>alert('Gagal mengunggah file gambar!');</script>";
        }
    }

 
    $sql = "INSERT INTO news (judul, deskripsi, kategori, gambar, tanggal) VALUES ('$judul', '$deskripsi', '$kategori', '$gambar', '$tanggal')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php");
    } else {
        echo "<script>alert('Gagal menambahkan berita: " . mysqli_error($conn) . "');</script>";
    }
    exit();
}


if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM news WHERE id='$id'"));
    if ($data && $data['gambar'] != "default_news.jpg" && file_exists("asset/" . $data['gambar'])) {
        unlink("asset/" . $data['gambar']);
    }
    
    mysqli_query($conn, "DELETE FROM news WHERE id='$id'");
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Berita</title>
    
    <style>
        /* Variabel CSS */
        :root {
            --primary-color: #f5c518; 
            --danger-color: #ff4444; /* Merah untuk Hapus/Logout */
            --info-color: #007bff; /* Biru untuk Navigasi/Link */
            --dark-color: #333;
            --light-bg: #f4f4f4;
            --box-bg: #ffffff;
            --border-color: #ddd;
        }

        /* Global Style */
        body { 
            font-family: 'Poppins', sans-serif;
            padding: 20px; 
            background: var(--light-bg); 
            color: var(--dark-color);
        }
        
        /* Container Utama */
        .admin-container { 
            max-width: 900px; 
            margin: auto; 
            background: var(--box-bg); 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        
        /* Header Admin (Selamat Datang/Logout) */
        .header-admin-nav {
            text-align: right;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .header-admin-nav strong {
            color: var(--primary-color); 
            font-weight: bold;
            margin-right: 15px; /* Memberi jarak dari link navigasi */
        }
        
        /* Gaya untuk Link Navigasi (Kelola Tim) */
        .header-admin-nav .nav-link {
            color: var(--info-color); /* Warna Biru */
            text-decoration: none;
            font-weight: bold;
            margin-left: 10px;
            transition: color 0.2s;
        }
        .header-admin-nav .nav-link:hover {
            color: #0056b3;
        }

        /* Gaya untuk Logout Link */
        .header-admin-nav .logout-link { /* Kelas baru untuk Logout */
            margin-left: 15px;
            color: var(--danger-color); 
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }
        .header-admin-nav .logout-link:hover {
            color: darkred;
        }

        /* Header dan Judul CRUD */
        h2 { 
            border-bottom: 3px solid var(--primary-color); 
            padding-bottom: 10px; 
            margin-bottom: 20px;
        }

        /* Style Form */
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
        
        /* Button */
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

        /* Style Tabel */
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
        
        /* Aksi Link */
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
    </style>
</head>
<body>

<div class="admin-container">
    
    <div class="header-admin-nav">
        
        <a href="index.php" class="nav-link" style="color: #00b3ffff; padding-right: 10px;">Website</a>
        Selamat Datang, **<?= htmlspecialchars($_SESSION['username']) ?>**!
        <a href="admin_team.php" class="nav-link" style="color: #4444ff;">Kelola Tim</a>
        
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
    <h2>Tambah Berita Baru</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Judul Berita</label>
        <input type="text" name="judul" required placeholder="Contoh: CS2 Patch Notes Terbaru">

        <label>Kategori</label>
        <input type="text" name="kategori" required placeholder="Contoh: Update, Esports, Partnership">

        <label>Upload Gambar Utama Berita</label>
        <input type="file" name="gambar_file" accept="image/*" required>

        <label>Deskripsi/Konten Berita</label>
        <textarea name="deskripsi" rows="8" required placeholder="Tulis konten berita di sini..."></textarea>

        <button type="submit" name="tambah">Terbitkan Berita</button>
    </form>

    <h2 style="margin-top: 40px;">Daftar Berita </h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Gambar File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tampil = mysqli_query($conn, "SELECT * FROM news ORDER BY id DESC");
            while($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
                <td><?= $data['id'] ?></td>
                <td><?= htmlspecialchars($data['judul']) ?></td>
                <td><?= htmlspecialchars($data['kategori']) ?></td>
                <td><?= htmlspecialchars($data['gambar']) ?></td>
                <td>
                    <a href="edit_news.php?id=<?= $data['id'] ?>" class="btn-edit">Edit</a>
                    <a href="admin.php?hapus=<?= $data['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin hapus berita ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>