<?php
// BARIS WAJIB: Selalu mulai session
session_start(); 
// include 'koneksi.php'; // Tambahkan jika ada query database di halaman ini
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Games | CounterStrike Studios</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* Tetap pertahankan style CSS yang Anda berikan */
        .features {
            padding: 6rem 10%;
            background: #0f0f0f;
            color: #ddd;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.8rem;
            margin-top: 2rem;
        }
        .feature-card {
            background:#111;
            padding:1.4rem;
            border-radius:10px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.6);
            transition: transform .18s;
        }
        .feature-card:hover { transform: translateY(-6px); }
        .feature-card h3 { color: var(--primary); margin-bottom: .6rem; }
        .feature-card p { color: #cfcfcf; font-size: .98rem; line-height: 1.45; }
        .specs {
            margin-top: 2.4rem;
            display:flex;
            gap:1.2rem;
            flex-wrap:wrap;
        }
        .spec {
            background: #0b0b0b;
            border-radius:8px;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(255,255,255,0.03);
            color: #ddd;
            font-weight:600;
            min-width: 160px;
            text-align:center;
        }
        .hero-small {
            padding: 8rem 10% 3rem;
            text-align:center;
            background: linear-gradient(180deg, rgba(0,0,0,0.6), rgba(0,0,0,0.85));
        }
        .btn-outline-inline { display:inline-block; margin-top:1rem; text-decoration:none; border:2px solid var(--primary); padding:.6rem 1rem; border-radius:30px; color:var(--primary); }
        .video-thumb { width:100%; border-radius:8px; margin-top:1rem; box-shadow: 0 8px 40px rgba(245,197,24,0.06); }
        footer { margin-top:2rem; }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">CounterStrike<span> Studios</span></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="games.php" class="active">Games</a></li>
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

    <section class="hero-small">
        <h1 style="color:var(--primary); font-size:2.6rem;">Counter-Strike 2 — Feature Deep Dive</h1>
        <p style="color:#ccc; max-width:900px; margin: .8rem auto 0;">
            Built on Source 2: photoreal rendering, modern networking, volumetric smoke, and competitive systems tuned for fair and expressive gameplay.
        </p>
        <a class="btn-outline-inline" href="https://store.steampowered.com/app/730/CounterStrike_2/" target="_blank" rel="noopener">Official Steam page</a>
    </section>

    <section class="features">
        <h2 style="color:var(--primary);">Key Technical & Gameplay Features</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <h3>Volumetric Smoke & Dynamic Lighting</h3>
                <p>
                    Smokes are now <strong>volumetric</strong> and behave like 3D objects: they fill spaces, react to lighting, and can be temporarily displaced by bullets, explosions or other forces.
                    This change affects both visibility and strategy — smoke is no longer just a flat sprite but a physics-aware volume that interacts with environment lighting and effects.
                </p>
            </div>
            <div class="feature-card">
                <h3>Source 2 — Physically Based Rendering (PBR)</h3>
                <p>
                    The Source 2 engine brings PBR and improved material systems, giving more realistic surfaces, specular response, and global lighting improvements — which together make map visuals and weapon models appear more lifelike.
                </p>
            </div>
            <div class="feature-card">
                <h3>Sub-tick Server Architecture</h3>
                <p>
                    New networking improvements (often called sub-tick architecture) increase accuracy of hit registration and server-client synchronization. This reduces perceived inconsistencies between what a player sees and what the server resolves.
                </p>
            </div>
            <div class="feature-card">
                <h3>Competitive & Premier Matchmaking</h3>
                <p>
                    Competitive modes have been revamped: map-specific rankings, CS Ratings, Premier mode, and updated matchmaking aim to improve fairness and create meaningful, skill-based progression across maps and regions.
                </p>
            </div>
            <div class="feature-card">
                <h3>TrueView & Improved Demos</h3>
                <p>
                    Demo replay systems have been improved to better match the original client experience (including client-side predictions). This reduces confusing discrepancies in replays and helps with review and adjudication.
                </p>
            </div>
            <div class="feature-card">
                <h3>Workshop & Community Tools</h3>
                <p>
                    Upgraded community tools on Source 2 let creators rebuild maps with better lighting and physics. Expect overhauled classic maps and improved authoring tools for creators.
                </p>
            </div>
        </div>

        <div class="specs" aria-hidden="false">
            <div class="spec">Engine: Source 2</div>
            <div class="spec">Rendering: PBR & Dynamic Lighting</div>
            <div class="spec">Networking: Sub-tick server architecture</div>
            <div class="spec">Smoke: Volumetric, physics-aware</div>
            <div class="spec">Modes: Competitive, Premier, Casual, Workshop</div>
        </div>

        <div style="max-width:1100px; margin:2.6rem auto 0; color:#ddd;">
            <h3 style="color:var(--primary); margin-bottom: .6rem;">Feature details & design implications</h3>
            <p style="margin-bottom:1rem;">
                <strong>Volumetric smoke & lighting:</strong> Because smoke is rendered as a 3D volume that reacts to light and interactions, lines of sight and utility usage (smokes/flashbangs) become more tactical. Bullets and explosions can temporarily clear or push smoke, which opens up new tactical plays and counters.
            </p>
            <p style="margin-bottom:1rem;">
                <strong>Sub-tick & demo accuracy:</strong> The sub-tick model improves the fidelity of server simulation and player inputs. Paired with demo improvements (TrueView-style replay), this makes replays and adjudication far closer to what players actually experienced client-side.
            </p>
            <p style="margin-bottom:1rem;">
                <strong>Competitive progression:</strong> CS2 introduces updated ranking/CS Rating systems (including Premier mode and map-based elements). These changes aim to match players more fairly and add long-term progression and leaderboards.
            </p>
            <p style="margin-bottom:1rem;">
                <strong>Community & mod support:</strong> Source 2’s tooling enables creators to update classic maps with improved lighting, smoke behavior, and destructible elements — an opportunity for rich modded content and competitive map reworks.
            </p>

            <img class="video-thumb" src="asset/Counter-Strike 2 09_11_2025 21.43.20.png" alt="CS2 screenshot — example lighting" />
            <p style="margin-top:.6rem; color:#aaa; font-size:.9rem;">Screenshot: example of new lighting/shadows and volumetric effects.</p>
        </div>

        
        <div style="text-align:center; margin-top:2.2rem;">
            <a class="btn" href="games.php" style="text-decoration:none;">Back to top</a>
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
                    <li><a href="index.php">Home</a></li>
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