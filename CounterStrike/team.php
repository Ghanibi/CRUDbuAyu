<?php
session_start(); 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tim Esports</title>
    <link rel="stylesheet" href="style.css"> 
    
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">CounterStrike<span> Studios</span></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li> 
                <li><a href="about.php">About</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="team.php" class="active">Team</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            
            <div class="auth-buttons">
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                    <span style="color:#f5c518; margin-right:10px;">Hi, <b><?= htmlspecialchars($_SESSION['username']) ?></b></span>
                    
                    <?php 
                    // Pengecekan RBAC yang aman
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
                    ?>
                        <a href="admin_team.php" class="btn-manage-team" style="
                            background-color: yellow; 
                            color: black; 
                            padding: 8px 15px; 
                            border-radius: 5px; 
                            text-decoration: none; 
                            font-weight: bold;
                        ">Kelola Tim</a>
                    <?php endif; ?>
                    
                    <a href="logout.php" class="btn-logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <h1 style="text-align:center; margin-top: 90px;">List Esports Team</h1>

    <div class="team-grid">
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM teams ORDER BY id DESC");
        while($data = mysqli_fetch_array($tampil)) :
        ?>
        <div class="team-card">
            <img src="asset/<?= htmlspecialchars($data['logo_file']) ?>" class="team-img">
            <h3><?= htmlspecialchars($data['nama_tim']) ?></h3>
            <p><?= htmlspecialchars($data['deskripsi']) ?></p>
            
            <?php 
            // Pengecekan RBAC untuk tombol Edit/Hapus
            if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
            ?>
                <div style="margin-top: 15px; border-top:1px solid #ddd; padding-top:10px;">
                    <a href="edit_team.php?id=<?= $data['id'] ?>" class="btn-edit-public">Edit</a>
                    <a href="admin_team.php?hapus=<?= $data['id'] ?>" class="btn-delete-public" onclick="return confirm('Hapus?')">Hapus</a>
                </div>
            <?php endif; ?>
            
        </div>
        <?php endwhile; ?>
    </div>

</body>
</html>