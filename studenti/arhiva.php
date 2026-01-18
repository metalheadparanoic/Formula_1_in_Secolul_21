<?php
require 'db.php';

// 1. Determinăm ce an afișăm
$selected_year = isset($_GET['year']) ? intval($_GET['year']) : 2024;

// 2. Luăm lista de ani pentru dropdown
$years_stmt = $pdo->query("SELECT year FROM history_seasons ORDER BY year DESC");
$years = $years_stmt->fetchAll(PDO::FETCH_COLUMN);

// 3. Luăm detaliile sezonului selectat
$season_stmt = $pdo->prepare("SELECT * FROM history_seasons WHERE year = ?");
$season_stmt->execute([$selected_year]);
$season = $season_stmt->fetch(PDO::FETCH_ASSOC);

// 4. Luăm Clasamentul Piloților
$drivers_stmt = $pdo->prepare("SELECT * FROM history_standings WHERE year = ? ORDER BY position ASC");
$drivers_stmt->execute([$selected_year]);
$drivers = $drivers_stmt->fetchAll(PDO::FETCH_ASSOC);

// 5. Luăm Clasamentul Constructorilor
$constructors_stmt = $pdo->prepare("SELECT * FROM history_constructors WHERE year = ? ORDER BY position ASC");
$constructors_stmt->execute([$selected_year]);
$constructors = $constructors_stmt->fetchAll(PDO::FETCH_ASSOC);

// 6. Luăm Calendarul Curselor
$races_stmt = $pdo->prepare("SELECT * FROM history_races WHERE year = ? ORDER BY id ASC");
$races_stmt->execute([$selected_year]);
$races = $races_stmt->fetchAll(PDO::FETCH_ASSOC);

// Funcția pentru imagini a fost eliminată deoarece imaginile piloților nu mai sunt folosite.
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istoria Formulei 1 - Sezonul <?= $selected_year ?></title>
    <link rel="icon" type="image/png" href="imagini/favicon.png">
    <style>
        body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f3f3; margin: 0; padding: 0; }
        .header { background: #e10600; color: white; padding: 20px; text-align: center; position: relative; }
        .header h1 { margin: 0; font-style: italic; }
        .back-button { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: white; color: #e10600; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; transition: all 0.3s; }
        .back-button:hover { background: #333; color: white; }
        .year-selector { margin: 20px auto; text-align: center; }
        select { padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 20px; font-size: 16px; background: #333; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .season-summary { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between; }
        .info h2 { color: #e10600; border-bottom: 2px solid #e10600; display: inline-block; }
        .car-image { max-width: 400px; border-radius: 10px; }
        .grid-container { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: 1 / -1; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .card h3 { border-left: 5px solid #e10600; padding-left: 10px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f8f8; color: #555; }
        .pos-1 { background-color: #fff8e1; font-weight: bold; }
        .pos-2 { background-color: #f5f5f5; }
        .pos-3 { background-color: #fff3e0; }
        
        /* Buton Back to Top */
        #backToTop { display: none; position: fixed; bottom: 30px; right: 30px; z-index: 9999; width: 50px; height: 50px; font-size: 24px; border: none; outline: none; background-color: #ff0000 !important; color: #ffffff !important; cursor: pointer; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.5); transition: background-color 0.3s, transform 0.3s; display: flex; align-items: center; justify-content: center; }
        #backToTop:hover { background-color: #cc0000 !important; transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="header">
    <a href="index.php" class="back-button">← Înapoi la site</a>
    <h1>Istoria Formulei 1</h1>
</div>

<div class="year-selector">
    <form method="GET">
        <label>Alege Sezonul: </label>
        <select name="year">
            <?php foreach($years as $y): ?>
                <option value="<?= $y ?>" <?= $y == $selected_year ? 'selected' : '' ?>>
                    <?= $y ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Vezi Statistici</button>
    </form>
</div>

<div class="container">

    <?php if($season): ?>
    <div class="season-summary">
        <div class="info">
            <h2>Sezonul <?= $season['year'] ?></h2>
            <p><strong>Campion Piloți:</strong> <?= htmlspecialchars($season['champion_driver']) ?></p>
            <p><strong>Campion Constructori:</strong> <?= htmlspecialchars($season['champion_team']) ?></p>
            <p><em><?= htmlspecialchars($season['description']) ?></em></p>
        </div>
        <?php 
            // Detectare automată extensie mașină
            $car_base_name = pathinfo($season['car_image'], PATHINFO_FILENAME);
            $car_files = glob("imagini/" . $car_base_name . ".*");
            $final_car_img = !empty($car_files) ? basename($car_files[0]) : 'default_car.png';
        ?>
        <img src="imagini/<?= $final_car_img ?>" alt="F1 Car <?= $selected_year ?>" class="car-image">
    </div>
    <?php else: ?>
        <h2 style="text-align:center; color:red">Nu există date pentru anul selectat!</h2>
    <?php endif; ?>

    <div class="grid-container">
        
        <div class="card">
            <h3>Clasament Piloți</h3>
            <table>
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Pilot</th>
                        <th>Echipa</th>
                        <th>Pct</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($drivers as $driver): ?>
                    <tr class="<?= $driver['position'] <= 3 ? 'pos-'.$driver['position'] : '' ?>">
                        <td><?= $driver['position'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($driver['driver_name']) ?></strong>
                        </td>
                        <td><?= htmlspecialchars($driver['team_name']) ?></td>
                        <td><?= $driver['points'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Clasament Constructori</h3>
            <table>
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Echipa</th>
                        <th>Pct</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($constructors as $team): ?>
                    <tr class="<?= $team['position'] == 1 ? 'pos-1' : '' ?>">
                        <td><?= $team['position'] ?></td>
                        <td><strong><?= htmlspecialchars($team['team_name']) ?></strong></td>
                        <td><?= $team['points'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card full-width">
            <h3>Calendarul Curselor <?= $selected_year ?></h3>
            <table>
                <thead>
                    <tr>
                        <th>Etapa</th>
                        <th>Data</th>
                        <th>Marele Premiu</th>
                        <th>Câștigător</th>
                        <th>Echipa</th>
                        <th>Tururi</th>
                        <th>Timp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($races as $race): ?>
                    <tr>
                        <td>#<?= $race['round'] ?></td>
                        <td><?= date("d M Y", strtotime($race['date'])) ?></td>
                        <td><strong><?= htmlspecialchars($race['circuit']) ?></strong></td>
                        <td>
                            <strong style="color: #e10600;"><?= htmlspecialchars($race['winner']) ?></strong>
                        </td>
                        <td><?= htmlspecialchars($race['team']) ?></td>
                        <td><?= $race['laps'] ?></td>
                        <td><?= htmlspecialchars($race['time']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<button id="backToTop" title="Înapoi sus">⬆</button>
<script src="script.js"></script>
</body>
</html>