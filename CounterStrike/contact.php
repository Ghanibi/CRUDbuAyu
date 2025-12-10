<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact | CounterStrike Studios</title>
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
        <li><a href="team.php">Team</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
      </ul>
        
        <div class="auth-buttons">
            <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                <span style="color:#f5c518; margin-right:10px;">Hi, <b><?= htmlspecialchars($_SESSION['username']) ?></b></span>
                
                <a href="logout.php" class="btn-logout">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
            </nav>
  </header>

  
  <section class="contact-section" style="padding:8rem 10%; text-align:center;">
    <h2 style="color: var(--primary); font-size:2.2rem; margin-bottom:1rem;">
      Contact Us
    </h2>
    <p style="color:#ccc; max-width:700px; margin:0 auto 2rem;">
      Have questions, partnership opportunities, or feedback?  
      Reach out to our team — we’re always ready to connect!
    </p>

    <div class="contact-box" 
      style="
        background-color: #111;
        padding: 2rem;
        max-width: 550px;
        margin: auto;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(245, 197, 24, 0.1);
    ">
      <p><strong>Email:</strong> 
        <a href="mailto:kucingputih1708@gmail.com" style="color:var(--primary);">CounterStrike@email.com</a>
      </p>

      <p><strong>WhatsApp:</strong>
        <a href="tel:+62857-7304-4321" style="color:var(--primary);">+62 812-3456-7890</a>
      </p>

      
          </div>
  </section>

  
  <footer>
    <div class="footer-container">
      <div class="footer-about">
        <h3>StrikeCore Studios</h3>
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