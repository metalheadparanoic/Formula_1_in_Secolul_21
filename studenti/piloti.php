<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piloți - F1 în Secolul 21</title>

    <link rel="stylesheet" href="stil_general.css">

    <link rel="stylesheet" href="style_piloti.css">

    <link rel="icon" type="image/png" href="imagini/favicon.png">
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="page-title">
            <h2>Piloții Sezonului 2025</h2>
            <p>Descoperă protagoniștii de pe grila de start.</p>
        </div>

        <div class="search-container">
            <input type="text" id="driverSearch" placeholder="Caută pilot sau echipă... (ex: Lewis, Ferrari)">
        </div>

        <div class="drivers-grid">

            <div class="driver-card team-mclaren">
                <div class="driver-image">
                    <img src="imagini/Oscar-Piastri-2025-suit-1500x1080.jpg" alt="Oscar Piastri">
                </div>
                <div class="driver-info">
                    <span class="driver-number">81</span>
                    <h3>Oscar Piastri</h3>
                    <p class="driver-team">McLaren</p>
                </div>
            </div>

            <div class="driver-card team-mclaren">
                <div class="driver-image">
                    <img src="imagini/250306-lando-norris-ew-800p-37be18.webp" alt="Lando Norris">
                </div>
                <div class="driver-info">
                    <span class="driver-number">4</span>
                    <h3>Lando Norris</h3>
                    <p class="driver-team">McLaren</p>
                </div>
            </div>

            <div class="driver-card team-ferrari">
                <div class="driver-image">
                    <img src="imagini/GettyImages-2236088703.avif" alt="Lewis Hamilton">
                </div>
                <div class="driver-info">
                    <span class="driver-number">44</span>
                    <h3>Lewis Hamilton</h3>
                    <p class="driver-team">Scuderia Ferrari</p>
                </div>
            </div>

            <div class="driver-card team-ferrari">
                <div class="driver-image">
                    <img src="imagini/r1459773_1296x729_16-9.jpg" alt="Charles Leclerc">
                </div>
                <div class="driver-info">
                    <span class="driver-number">16</span>
                    <h3>Charles Leclerc</h3>
                    <p class="driver-team">Scuderia Ferrari</p>
                </div>
            </div>

            <div class="driver-card team-mercedes">
                <div class="driver-image">
                    <img src="imagini/GettyImages-2236564680.avif" alt="George Russell">
                </div>
                <div class="driver-info">
                    <span class="driver-number">63</span>
                    <h3>George Russell</h3>
                    <p class="driver-team">Mercedes</p>
                </div>
            </div>

            <div class="driver-card team-mercedes">
                <div class="driver-image">
                    <img src="imagini/kimi_antonelli.avif" alt="Kimi Antonelli">
                </div>
                <div class="driver-info">
                    <span class="driver-number">12</span>
                    <h3>Kimi Antonelli</h3>
                    <p class="driver-team">Mercedes</p>
                </div>
            </div>

                <div class="driver-card team-redbull">
                    <div class="driver-image">
                        <img src="imagini/Verstappen_Redbull.jpg" alt="Max Verstappen">
                    </div>
                    <div class="driver-info">
                        <span class="driver-number">1</span>
                        <h3>Max Verstappen</h3>
                        <p class="driver-team">Red Bull Racing</p>
                    </div>
                </div>

            <div class="driver-card team-redbull">
                <div class="driver-image">
                    <img src="imagini/yuki_tsunoda.jpg" alt="Yuki Tsunoda">
                </div>
                <div class="driver-info">
                    <span class="driver-number">22</span>
                    <h3>Yuki Tsunoda</h3>
                    <p class="driver-team">Red Bull Racing</p>
                </div>
            </div>

            <div class="driver-card team-williams">
                <div class="driver-image">
                    <img src="imagini/alex_albon.jpg" alt="Alexander Albon">
                </div>
                <div class="driver-info">
                    <span class="driver-number">23</span>
                    <h3>Alexander Albon</h3>
                    <p class="driver-team">Williams</p>
                </div>
            </div>

            <div class="driver-card team-williams">
                <div class="driver-image">
                    <img src="imagini/carlos_sainz.avif" alt="Carlos Sainz">
                </div>
                <div class="driver-info">
                    <span class="driver-number">55</span>
                    <h3>Carlos Sainz</h3>
                    <p class="driver-team">Williams</p>
                </div>
            </div>

            <div class="driver-card team-racingbulls">
                <div class="driver-image">
                    <img src="imagini/liam_lawson.jpg" alt="Liam Lawson">
                </div>
                <div class="driver-info">
                    <span class="driver-number">30</span>
                    <h3>Liam Lawson</h3>
                    <p class="driver-team">Racing Bulls</p>
                </div>
            </div>

            <div class="driver-card team-racingbulls">
                <div class="driver-image">
                    <img src="imagini/isack_hadjar.jpg" alt="Isack Hadjar">
                </div>
                <div class="driver-info">
                    <span class="driver-number">6</span>
                    <h3>Isack Hadjar</h3>
                    <p class="driver-team">Racing Bulls</p>
                </div>
            </div>

            <div class="driver-card team-astonmartin">
                <div class="driver-image">
                    <img src="imagini/lance_stroll.jpg" alt="Lance Stroll">
                </div>
                <div class="driver-info">
                    <span class="driver-number">18</span>
                    <h3>Lance Stroll</h3>
                    <p class="driver-team">Aston Martin</p>
                </div>
            </div>

            <div class="driver-card team-astonmartin">
                <div class="driver-image">
                    <img src="imagini/fernando_alonso.webp" alt="Fernando Alonso">
                </div>
                <div class="driver-info">
                    <span class="driver-number">14</span>
                    <h3>Fernando Alonso</h3>
                    <p class="driver-team">Aston Martin</p>
                </div>
            </div>

            <div class="driver-card team-haas">
                <div class="driver-image">
                    <img src="imagini/esteban_ocon.jpg" alt="Esteban Ocon">
                </div>
                <div class="driver-info">
                    <span class="driver-number">31</span>
                    <h3>Esteban Ocon</h3>
                    <p class="driver-team">Haas F1 Team</p>
                </div>
            </div>

            <div class="driver-card team-haas">
                <div class="driver-image">
                    <img src="imagini/oliver_bearman.jpg" alt="Oliver Bearman">
                </div>
                <div class="driver-info">
                    <span class="driver-number">87</span>
                    <h3>Oliver Bearman</h3>
                    <p class="driver-team">Haas F1 Team</p>
                </div>
            </div>

            <div class="driver-card team-sauber">
                <div class="driver-image">
                    <img src="imagini/nico_hulkenberg.jpg" alt="Nico Hulkenberg">
                </div>
                <div class="driver-info">
                    <span class="driver-number">27</span>
                    <h3>Nico Hulkenberg</h3>
                    <p class="driver-team">Kick Sauber</p>
                </div>
            </div>

            <div class="driver-card team-sauber">
                <div class="driver-image">
                    <img src="imagini/gabriel_bortoleto.jpg" alt="Gabriel Bortoleto">
                </div>
                <div class="driver-info">
                    <span class="driver-number">5</span>
                    <h3>Gabriel Bortoleto</h3>
                    <p class="driver-team">Kick Sauber</p>
                </div>
            </div>

            <div class="driver-card team-alpine">
                <div class="driver-image">
                    <img src="imagini/pierre_gasly.jpg" alt="Pierre Gasly">
                </div>
                <div class="driver-info">
                    <span class="driver-number">10</span>
                    <h3>Pierre Gasly</h3>
                    <p class="driver-team">Alpine</p>
                </div>
            </div>

            <div class="driver-card team-alpine">
                <div class="driver-image">
                    <img src="imagini/franco_colapinto.webp" alt="Franco Colapinto">
                </div>
                <div class="driver-info">
                    <span class="driver-number">43</span>
                    <h3>Franco Colapinto</h3>
                    <p class="driver-team">Alpine</p>
                </div>
            </div>
        </div>

    </main>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>

</body>

</html>