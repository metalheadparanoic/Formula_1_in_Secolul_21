<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula 1 în Secolul 21 - Acasă</title>
    
    <link rel="stylesheet" href="stil_general.css">
    <link rel="stylesheet" href="style_homepage.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-text">
                <h2>Viteză. Strategie. Glorie.</h2>

                <div id="countdown-container">
                    <p>Sezonul începe în:</p>
                    <h3 id="countdown-timer">Se încarcă...</h3>
                </div>

                <p>Explorează universul Formulei 1 moderne, de la tehnologia de vârf la rivalitățile de pe circuit.</p>
                <a href="calendar.php" class="cta-button">Descoperă Sezonul 2025</a>
            </div>
        </section>

        <section class="features">
            <h2>Elemente Cheie</h2>
            <div class="features-container">
                <div class="feature-card">
                    <h3>Piloți de Elită</h3>
                    <p>Cunoaște-i pe eroii moderni ai circuitelor, de la campioni mondiali la noile talente.</p>
                </div>
                <div class="feature-card">
                    <h3>Inginerie de Vârf</h3>
                    <p>Descoperă inovațiile tehnologice care împing limitele performanței în fiecare cursă.</p>
                </div>
                <div class="feature-card">
                    <h3>Calendarul Global</h3>
                    <p>Urmărește fiecare Mare Premiu, de la circuitele clasice la cele mai noi adăugiri în calendar.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>

</html>