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
    
</body>
</html>