<?php
// BARIS WAJIB: Selalu mulai session
session_start(); 
// include 'koneksi.php'; // Tambahkan jika ada query database di halaman ini
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About | CounterStrike Studios</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <nav class="navbar">
      <div class="logo">CounterStrike<span> Studios</span></div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php" class="active">About</a></li>
        <li><a href="games.php">Games</a></li>
        <li><a href="team.php">Team</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      
        <div class="auth-buttons">
            <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                <span style="color:#f5c518; margin-right:10px;">Hi <b><?= htmlspecialchars($_SESSION['username']) ?></b></span>
                
                <a href="logout.php" class="btn-logout">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
            </nav>
  </header>


  <section class="subpage-hero about-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>About CounterStrike Studios</h1>
      <p>Where Tactical Precision Meets Creative Excellence</p>
    </div>
  </section>


  <section class="company-story">
    <div class="story-container">
      <div class="story-text">
        <h2>Our Story</h2>
        <p>
          Founded in 2023 by a team of former esports players and developers, CounterStrike Studios was built
          on one mission — to redefine tactical gaming through authenticity and innovation.
        </p>
        <p>
          We combine technical expertise with competitive insight to deliver FPS titles that feel as intense
          and satisfying as real combat scenarios. Every map, weapon, and mechanic is designed with balance,
          strategy, and adrenaline in mind.
        </p>
        <p>
          What began as a small team working out of a single studio has now evolved into a global company
          with a community-driven approach, focused on delivering high-performance gaming experiences to
          players worldwide.
        </p>
      </div>
      <div class="story-image">
        <img src="asset/cara-membuat-game.jpg" alt="CounterStrike Office">
      </div>
    </div>
  </section>

  
  <section class="mission-vision">
    <h2>Our Mission & Vision</h2>
    <div class="mv-container">
      <div class="mv-card">
        <h3>🎯 Mission</h3>
        <p>
          To craft the most immersive and strategic first-person shooter experiences — connecting players
          through skill, teamwork, and competition.
        </p>
      </div>
      <div class="mv-card">
        <h3>🚀 Vision</h3>
        <p>
          To become the global benchmark in tactical game design by merging innovation, performance,
          and player-driven development.
        </p>
      </div>
    </div>
  </section>

  
  <section class="studio-section">
    <div class="studio-container">
      <div class="studio-text">
        <h2>Inside the Studio</h2>
        <p>
          Our creative hub is where ideas turn into gameplay. From art direction to motion capture,
          every department collaborates seamlessly to build experiences that feel alive and dynamic.
        </p>
        <p>
          We believe in passion-driven creation — empowering our developers, artists, and designers to
          constantly innovate and challenge what’s possible.
        </p>
      </div>
      <div class="studio-gallery">
        <img src="" alt="">
        <img src="" alt="">
        <img src="" alt="">
      </div>
    </div>
  </section>

  
  <section class="core-values">
    <h2>Core Values That Drive Us</h2>
    <div class="values-list">
      <div class="value">
        <h3>Integrity</h3>
        <p>We stay true to our players, building games that are fair, challenging, and rewarding.</p>
      </div>
      <div class="value">
        <h3>Collaboration</h3>
        <p>Our strength lies in teamwork — both inside our studio and across our global community.</p>
      </div>
      <div class="value">
        <h3>Innovation</h3>
        <p>Every title we build pushes the boundaries of design, technology, and realism.</p>
      </div>
      <div class="value">
        <h3>Excellence</h3>
        <p>We never settle for “good enough.” Every release is refined to perfection.</p>
      </div>
    </div>
  </section>

  
  <footer>
    <div class="footer-container">
      <div class="footer-about">
        <h3>CounterStrike Studios</h3>
        <p>Dedicated to pushing the limits of tactical realism in FPS gaming since 2023.</p>
      </div>

      <div class="footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="games.php">Games</a></li>
          <li><a href="team.php">Team</a></li>
          <li><a href="news.php">News</a></li>
        </ul>
      </div>

      <div class="footer-socials">
        <h4>Follow Us</h4>
        <ul>
          <li><a href="https://www.youtube.com/@ESLCS">YouTube</a></li>
          <li><a href="https://x.com/ESLCS?s=20">Twitter</a></li>
          <li><a href="https://discord.com/invite/counterstrike">Discord</a></li>
        </ul>
      </div>
    </div>

    <p class="copyright">© 2025 CounterStrike Studios. All Rights Reserved.</p>
  </footer>
</body>
</html>