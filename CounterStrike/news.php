<?php
session_start(); 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new news list</title>
    <link rel="stylesheet" href="style.css"> 
    
    <style>
        .news-list {
            /* CONTAINER UTAMA: Membuat daftar berita berada di tengah */
            max-width: 900px; /* Lebar maksimum konten */
            margin: 40px auto; /* Margin atas/bawah 40px, auto untuk senter horizontal */
            padding: 0 20px;
        }
        .news-item {
            display: flex; /* Menggunakan Flexbox untuk tata letak gambar dan teks */
            gap: 25px; 
            align-items: flex-start;
            margin-bottom: 30px; /* Jarak antar berita */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            background-color: #222;
        }
        .news-item img {
            width: 250px; /* Lebar gambar yang lebih jelas */
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .news-content {
            flex-grow: 1; /* Konten teks mengambil sisa ruang */
        }
        .news-content h3 {
            margin-top: 0;
            color: #f5c518; /* Warna judul kuning CS */
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }
        .news-content .btn-edit, .news-content .btn-hapus {
            margin-top: 10px;
            display: inline-block;
        }
    </style>
    
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">CounterStrike<span> Studios</span></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li> 
                <li><a href="about.php">About</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="team.php">Team</a></li>
                <li><a href="news.php" class="active">News</a></li> <li><a href="contact.php">Contact</a></li>
            </ul>
            
            <div class="auth-buttons">
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                    <span style="color:#f5c518; margin-right:10px;">Hi, <b><?= htmlspecialchars($_SESSION['username']) ?></b></span>
                    
                    <?php 
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
                    ?>
                        <a href="admin_news.php" class="btn-manage-news" style="
                            background-color: yellow; 
                            color: black; 
                            padding: 8px 15px; 
                            border-radius: 5px; 
                            text-decoration: none; 
                            font-weight: bold;
                        ">Kelola Berita</a>
                    <?php endif; ?>
                
                    <a href="logout.php" class="btn-logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <h1 style="text-align:center; margin-top: 90px;">New news list</h1>

    <div class="news-list">
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM news ORDER BY id DESC");
        if (mysqli_num_rows($tampil) > 0):
            while($data = mysqli_fetch_array($tampil)) :
            ?>
            <div class="news-item">
                
                <?php if (!empty($data['gambar'])): ?>
                    <img src="asset/<?= htmlspecialchars($data['gambar']) ?>" alt="<?= htmlspecialchars($data['judul']) ?>">
                <?php endif; ?>
                
                <div class="news-content">
                    <h3><?= htmlspecialchars($data['judul']) ?></h3>
                    <p style="font-size: small; color: #666;">Dipublikasi pada: <?= htmlspecialchars($data['tanggal']) ?></p>
                    <p><?= substr(htmlspecialchars($data['deskripsi']), 0, 150) ?>...</p> 
                    
                    <?php 
                    if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
                    ?>
                        <div style="margin-top: 10px;">
                            <a href="edit_news.php?id=<?= $data['id'] ?>" class="btn-edit" style="background-color: blue; color: white; padding: 5px 10px; text-decoration: none;">Edit</a>
                            <a href="admin_news.php?hapus=<?= $data['id'] ?>" class="btn-hapus" style="background-color: red; color: white; padding: 5px 10px; text-decoration: none;" onclick="return confirm('Yakin hapus berita ini?')">Hapus</a>
                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
            <?php endwhile;
        else: ?>
            <p style="text-align: center; margin-top: 50px;">Belum ada berita yang tersedia saat ini.</p>
        <?php endif; ?>
    </div>

</body>
</html>