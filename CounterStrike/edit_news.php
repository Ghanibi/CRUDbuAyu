<?php
session_start();
include 'koneksi.php';

// =======================================================
// PROTEKSI HALAMAN ADMIN: Cek Login dan Role
// =======================================================
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin')) {
    header('Location: login.php');
    exit();
}

// =======================================================
// LOGIKA HAPUS DATA BERITA (Delete Operation)
// =======================================================
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    // Catatan: Asumsi tabel 'news' tidak menggunakan upload gambar.
    // Jika 'news' memiliki kolom gambar, logika penghapusan gambar harus ditambahkan di sini.

    // Hapus data dari database
    $query_delete = "DELETE FROM news WHERE id='$id_hapus'";
    $delete = mysqli_query($conn, $query_delete);

    if ($delete) {
        $pesan = "Berita berhasil dihapus!";
    } else {
        $pesan = "Gagal menghapus berita: " . mysqli_error($conn);
    }
    // Redirect kembali ke halaman ini (admin_news.php)
    header('Location: admin_news.php?status=' . urlencode($pesan));
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Berita</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        /* CSS Khusus Admin (Dapat disatukan dengan style.css jika Anda mau) */
        .admin-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .admin-table th {
            background-color: #f5c518;
            color: black;
        }
        .btn-tambah {
            background-color: #4CAF50; /* Hijau */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-edit, .btn-hapus {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
        }
        .btn-edit { background-color: #2196F3; color: white; } /* Biru */
        .btn-hapus { background-color: #F44336; color: white; } /* Merah */
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
             <div class="logo">CounterStrike<span> Studios</span></div>
             <div class="auth-buttons">
                 <span style="color:#f5c518; margin-right:10px;">Admin: <b><?= htmlspecialchars($_SESSION['username']) ?></b></span>
                 <a href="news.php" class="btn-manage-news" style="background-color: #999; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">Kembali ke Berita</a>
                 <a href="logout.php" class="btn-logout">Logout</a>
             </div>
        </nav>
    </header>

    <div class="admin-container">
        <h1>Kelola Data Berita</h1>
        
        <?php 
        // Tampilkan pesan status (setelah hapus data)
        if (isset($_GET['status'])): ?>
            <p style="padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-left: 5px solid #4CAF50;">
                <?= htmlspecialchars($_GET['status']) ?>
            </p>
        <?php endif; ?>

        <a href="tambah_news.php" class="btn-tambah">Tambah Berita Baru</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Judul Berita</th>
                    <th>Konten Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tampil = mysqli_query($conn, "SELECT id, tanggal, judul, SUBSTRING(konten, 1, 80) as konten_singkat FROM news ORDER BY id DESC");
                
                if (mysqli_num_rows($tampil) > 0) :
                    while($data = mysqli_fetch_array($tampil)) :
                ?>
                <tr>
                    <td><?= htmlspecialchars($data['id']) ?></td>
                    <td><?= htmlspecialchars($data['tanggal']) ?></td>
                    <td><?= htmlspecialchars($data['judul']) ?></td>
                    <td><?= htmlspecialchars($data['konten_singkat']) ?>...</td>
                    <td>
                        <a href="edit_news.php?id=<?= $data['id'] ?>" class="btn-edit">Edit</a>
                        <a href="admin_news.php?hapus=<?= $data['id'] ?>" class="btn-hapus" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else: 
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data berita yang ditambahkan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>