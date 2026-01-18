<?php
session_start();

// --- POARTA DE SECURITATE ---
// Verificăm dacă utilizatorul NU este logat (nu există user_id în sesiune)
if (!isset($_SESSION['user_id'])) {
    // Îl trimitem forțat la login
    header("Location: login.php");
    exit; // Oprim execuția scriptului ca să nu vadă nimic din pagina de mai jos
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paddock Club - VIP Access</title>
    
    <link rel="stylesheet" href="stil_general.css">
    <link rel="stylesheet" href="style_homepage.css"> <link rel="stylesheet" href="style_echipe.css">   <style>
        /* Un mic stil extra pentru a face pagina să pară "Premium" */
        .vip-badge {
            background-color: #FFD700; /* Auriu */
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.8em;
            vertical-align: middle;
            margin-left: 10px;
        }
        .download-btn {
            display: block;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            text-decoration: none;
            margin-top: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .download-btn:hover {
            background-color: #ff0000;
        }
    </style>

    <link rel="icon" type="image/png" href="imagini/favicon.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="hero" style="height: 40vh; background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('imagini/2053163352_16by9Centre.avif');">
            <div class="hero-text">
                <h2 style="color: #FFD700;">F1 Paddock Club <span class="vip-badge">VIP ONLY</span></h2>
                <p>Bun venit în zona exclusivistă, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>.</p>
                <p>Aici ai acces la conținut care nu este disponibil publicului larg.</p>
            </div>
        </section>

        <section class="archive-section" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); padding: 40px 20px; margin: 40px 0; border-radius: 10px;">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
                    
                    <div>
                        <h1 style="color: #FFD700; font-size: 3em; margin-bottom: 20px;">
                            Istoria Formulei 1
                        </h1>

                        <p style="font-size: 1.2em; line-height: 1.6; color: #ddd; margin-bottom: 30px;">
                            Explorează istoria unuia dintre cele mai prestigioase sporturi din lume. 
                            De la debutul erei moderne în 2000 până la zilele noastre, urmărește evoluția 
                            piloților legendari, echipelor iconice și momentele care au marcat pentru 
                            totdeauna Formula 1.
                        </p>
                        
                        <a href="arhiva.php" style="display: inline-block; background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); 
                           color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-weight: bold; 
                           margin-top: 20px; transition: transform 0.3s, box-shadow 0.3s;" 
                           onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(255,0,0,0.4)';"
                           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                            Intră în Arhivă
                        </a>
                    </div>

                    <div style="text-align: center;">
                        <div style="background: rgba(255,215,0,0.1); border: 2px solid #FFD700; border-radius: 10px; padding: 30px;">
                            <h3 style="color: #FFD700; font-size: 3em; margin: 0;">25</h3>
                            <p style="color: #ddd; font-size: 1.2em; margin-top: 10px;">Sezoane Complete</p>
                            <hr style="border: none; border-top: 1px solid #FFD700; margin: 20px 0;">
                            <p style="color: #bbb; font-size: 0.9em;">2000 - 2024</p>
                            <p style="color: #999; font-size: 0.85em; margin-top: 15px;">
                                Clasamente piloți<br>
                                Clasamente constructori<br>
                                Calendare curse<br>
                                Rezultate complete
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="features">
            <h2 style="color: #FFD700;">Wallpapers 4K Exclusive</h2>
            
            <div class="teams-grid">
                
                <div class="team-card" style="border-color: #FFD700;">
                    <div class="team-car">
                        <img src="imagini/ferrari_2025.jpg" alt="Ferrari Wallpaper">
                    </div>
                    <div class="team-info">
                        <h3>Scuderia Ferrari</h3>
                        <a href="imagini/ferrari_2025.jpg" download class="download-btn">Descărcare 4K</a>
                    </div>
                </div>

                <div class="team-card" style="border-color: #FFD700;">
                    <div class="team-car">
                        <img src="imagini/mercedes_2025.webp" alt="Mercedes Wallpaper">
                    </div>
                    <div class="team-info">
                        <h3>Mercedes-AMG</h3>
                        <a href="imagini/mercedes_2025.webp" download class="download-btn">Descărcare 4K</a>
                    </div>
                </div>

                <div class="team-card" style="border-color: #FFD700;">
                    <div class="team-car">
                        <img src="imagini/redbull_2025.webp" alt="Red Bull Wallpaper">
                    </div>
                    <div class="team-info">
                        <h3>Red Bull Racing</h3>
                        <a href="imagini/redbull_2025.webp" download class="download-btn">Descărcare 4K</a>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>