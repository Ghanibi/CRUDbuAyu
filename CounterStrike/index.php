<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>counterStrike Studios | Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">CounterStrike<span> Studios</span></div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li> 
                <li><a href="about.php">About</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="team.php">Team</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contact.php">Contact</a></li>
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

    <section class="hero">
        <video autoplay loop playsinline class="hero-video">
            <source src="asset/CS.mp4" type="video/mp4">
        </video>

        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Build. Compete. Dominate.</h1>
            <p>
                Where tactical precision meets next-gen creativity. CounterStrike Studios redefines the future of FPS gaming.
            </p>
            <a href="games.php" class="btn">Explore Our Games</a>
        </div>
    </section>

    <section class="about-preview">
        <div class="about-container">
            <div class="about-text">
                <h2>About CounterStrike</h2>
                <p>
                    Founded by passionate FPS veterans, CounterStrike Studios is dedicated to crafting realistic, 
                    competitive, and immersive experiences that capture the spirit of modern tactical combat.
                </p>
                <p>
                    From level design to weapon mechanics, we bring real-world physics, strategy, 
                    and teamwork into every title we develop.
                </p>
                <a href="about.html" class="btn-outline">Learn More</a>
            </div>
            <div class="about-image">
                <img src="asset/FEATURES_170129955_AR_0_ORKFXJQLGETS.webp" alt="Studio workspace">
            </div>
        </div>
    </section>

    <section class="featured-game">
        <h2>Featured Game: Operation Nexus</h2>
        <div class="game-container">
            <img src="asset/Counter-Strike 2 09_11_2025 21.43.20.png" alt="Operation Nexus Screenshot">
            <div class="game-info">
                <p>
                    Operation Nexus is CounterStrike’s latest tactical shooter — built with advanced engine tech 
                    and competitive realism at its core. Engage in lifelike firefights, strategic objectives, 
                    and next-level environmental destruction.
                </p>
                <ul>
                    <li>🟡 4K-ready visual fidelity</li>
                    <li>🟡 Dynamic lighting & smoke physics</li>
                    <li>🟡 Competitive-ranked matchmaking</li>
                </ul>
                <a href="games.php" class="btn">View Game Details</a>
            </div>
        </div>
    </section>

    <section class="news-section">
        <h2>Latest News</h2>
        <div class="news-grid">
            <article class="news-card">
                <img src="asset/Captures - File Explorer 09_11_2025 21.40.44.png" alt="Devlog Update">
                <h3>Developer Update #5: Realism Redefined</h3>
                <p>Our team dives deep into how weapon physics and recoil have been enhanced for a more authentic FPS experience.</p>
                <a href="news.php" class="read-more">Read More →</a>
            </article>

            <article class="news-card">
                <img src="asset/FURIA WINNER.jpg" alt="Event Announcement">
                <h3>Join the ConterStrike Esports Invitational</h3>
                <p>Registrations are now open for our global CS2-inspired tournament — compete with elite squads worldwide.</p>
                <a href="news.php" class="read-more">Read More →</a>
            </article>

            <article class="news-card">
                <img src="asset/Mouse.png" alt="Partnership">
                <h3>CounterStrike x ProTech Hardware</h3>
                <p>We’re proud to announce our partnership with ProTech Hardware to enhance next-level gaming experiences.</p>
                <a href="news.php" class="read-more">Read More →</a>
            </article>
        </div>
    </section>

    <section class="join-community">
        <div class="community-content">
            <h2>Join Our Community</h2>
            <p>Be part of a growing community of gamers, developers, and esports enthusiasts. 
                Connect, share feedback, and shape the next evolution of CounterStrike games.</p>
            <a href="contact.html" class="btn">Join Now</a>
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
                    <li><a href="about.html">About</a></li>
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

        <p class="copyright">© 2025 counterStrike Studios. All Rights Reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.querySelector(".hero-video");
            let isVideoInView = false; 

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    isVideoInView = entry.isIntersecting;
                    if (isVideoInView && !document.hidden) {
                        video.play();
                    } else {
                        video.pause();
                    }
                });
            }, { threshold: 0.10 });

            observer.observe(video);

            document.addEventListener("visibilitychange", () => {
                if (document.hidden) {
                    video.pause();
                } else {
                    if (isVideoInView) {
                        video.play();
                    }
                }
            });
        });
    </script>
</body>
</html>