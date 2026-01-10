<?php
session_start();
require 'db.php';

// 1. SECURITATE: Verificăm dacă ești logat ȘI dacă ești 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$message = "";

// --- LOGICA 1: ADĂUGARE / ACTUALIZARE SEZON ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_season'])) {
    $s_year = $_POST['season_year'];
    $s_desc = $_POST['description'];
    $s_car  = $_POST['car_image'];
    $s_driver = $_POST['champion_driver'];
    $s_team = $_POST['champion_team'];

    // Verificăm dacă anul există deja
    $check = $pdo->prepare("SELECT year FROM history_seasons WHERE year = ?");
    $check->execute([$s_year]);

    if ($check->rowCount() > 0) {
        // UPDATE
        $sql = "UPDATE history_seasons SET description=?, car_image=?, champion_driver=?, champion_team=? WHERE year=?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$s_desc, $s_car, $s_driver, $s_team, $s_year])) {
            $message = "<div class='alert success'>Sezonul $s_year a fost actualizat.</div>";
        }
    } else {
        // INSERT (Sezon nou)
        $sql = "INSERT INTO history_seasons (year, description, car_image, champion_driver, champion_team) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$s_year, $s_desc, $s_car, $s_driver, $s_team])) {
            $message = "<div class='alert success'>Sezonul $s_year a fost creat.</div>";
        }
    }
}

// --- LOGICA 2: ADĂUGARE CURSĂ ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_race'])) {
    $year = $_POST['year'];
    $round = $_POST['round'];
    $circuit = $_POST['circuit'];
    $date = $_POST['date'];
    $winner = $_POST['winner'];
    $team = $_POST['team'];
    $laps = $_POST['laps'];
    $time = $_POST['time'];

    if (!empty($year) && !empty($circuit) && !empty($winner)) {
        // Verificăm existența sezonului
        $check = $pdo->prepare("SELECT year FROM history_seasons WHERE year = ?");
        $check->execute([$year]);
        if($check->rowCount() == 0) {
             $message = "<div class='alert error'>Eroare: Sezonul $year nu există. Creează-l mai sus întâi.</div>";
        } else {
            $sql = "INSERT INTO history_races (year, round, circuit, date, winner, team, laps, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$year, $round, $circuit, $date, $winner, $team, $laps, $time])) {
                $message = "<div class='alert success'>Cursa a fost adăugată.</div>";
            } else {
                $message = "<div class='alert error'>Eroare la salvare.</div>";
            }
        }
    } else {
        $message = "<div class='alert error'>Completează toate câmpurile obligatorii.</div>";
    }
}

// --- LOGICA 3: ȘTERGERE CURSĂ ---
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM history_races WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php"); 
    exit;
}

// AFISARE: Ultimele curse
$races_stmt = $pdo->query("SELECT * FROM history_races ORDER BY year DESC, round DESC LIMIT 15");
$races = $races_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Curse F1</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #fff; padding: 20px; color: #333; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        h1 { border-bottom: 3px solid #e10600; padding-bottom: 10px; color: #333; margin-top: 20px; font-size: 28px; }
        
        /* Butoane Navigare Sus */
        .nav-buttons { margin-bottom: 20px; display: flex; gap: 10px; }
        .btn-nav { text-decoration: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-block; }
        .btn-back { background: #ddd; color: #333; }
        .btn-users { background: #333; color: white; }
        .btn-back:hover, .btn-users:hover { opacity: 0.8; }

        /* Formular - Stilul din Screenshot (Gri deschis) */
        .form-box { background: #f9f9f9; padding: 25px; border-radius: 5px; border: 1px solid #eee; margin-bottom: 30px; }
        .form-title { margin-top: 0; color: #e10600; font-size: 18px; margin-bottom: 15px; font-weight: bold; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
        
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit; }
        label { font-weight: bold; font-size: 13px; color: #555; display: block; margin-bottom: 5px; }
        
        /* Buton Roșu Mare */
        button.btn-save { background: #e10600; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; width: 100%; }
        button.btn-save:hover { background: #b30000; }

        /* Buton Albastru (pentru Sezon, ca să le distingem vizual dar păstrând stilul) */
        button.btn-blue { background: #333; }
        button.btn-blue:hover { background: #000; }

        /* Tabel - Stilul Dark Header */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #333; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #fcfcfc; }
        
        /* Buton ștergere */
        .btn-delete { background: #ff4444; color: white; text-decoration: none; padding: 5px 12px; border-radius: 3px; font-size: 12px; }
        .btn-delete:hover { background: #cc0000; }
        
        /* Mesaje */
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; text-align: left; border: 1px solid transparent; }
        .success { background: #d4edda; color: #155724; border-color: #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border-color: #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    
    <div class="nav-buttons">
        <a href="index.php" class="btn-nav btn-back">← Înapoi la Site</a>
        <a href="admin_users.php" class="btn-nav btn-users">Gestioneaza Utilizatorii</a>
    </div>
    
    <h1>Administrare Curse (Database)</h1>
    
    <?= $message ?>

    <div class="form-box">
        <h3 class="form-title">Gestionare Sezon (An & Masina)</h3>
        <form method="POST">
            <div class="form-grid">
                <div>
                    <label>Anul Sezonului</label>
                    <input type="number" name="season_year" value="2025" required>
                </div>
                <div>
                    <label>Fișier Mașină (Folder: imagini/)</label>
                    <input type="text" name="car_image" placeholder="Ex: ferrari_2025.jpg">
                </div>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label>Descriere Sezon</label>
                <textarea name="description" rows="2" placeholder="Descrierea sezonului pentru arhivă..."></textarea>
            </div>

            <div class="form-grid">
                <div>
                    <label>Campion Piloți</label>
                    <input type="text" name="champion_driver">
                </div>
                <div>
                    <label>Campion Constructori</label>
                    <input type="text" name="champion_team">
                </div>
            </div>

            <button type="submit" name="update_season" class="btn-save btn-blue">Salveaza / Actualizeaza Sezonul</button>
        </form>
    </div>

    <div class="form-box">
        <h3 class="form-title">Adaugă Rezultat Nou</h3>
        <form method="POST">
            <div class="form-grid">
                <div>
                    <label>Anul Sezonului</label>
                    <input type="number" name="year" value="2025" required>
                </div>
                <div>
                    <label>Numărul Etapei (Round)</label>
                    <input type="number" name="round" placeholder="Ex: 1" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label>Nume Circuit / Grand Prix</label>
                    <input type="text" name="circuit" placeholder="Ex: Bahrain" required>
                </div>
                <div>
                    <label>Data Cursei</label>
                    <input type="date" name="date" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label>Câștigător (Pilot)</label>
                    <input type="text" name="winner" placeholder="Ex: Lewis Hamilton" required>
                </div>
                <div>
                    <label>Echipa Câștigătoare</label>
                    <input type="text" name="team" placeholder="Ex: Ferrari" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label>Număr Tururi</label>
                    <input type="number" name="laps" placeholder="Ex: 57">
                </div>
                <div>
                    <label>Timp Final</label>
                    <input type="text" name="time" placeholder="Ex: 1:30:22.123">
                </div>
            </div>
            
            <button type="submit" name="add_race" class="btn-save">Salveaza Cursa in Baza de Date</button>
        </form>
    </div>

    <h3>Ultimele modificări în tabelul `history_races`</h3>
    <table>
        <thead>
            <tr>
                <th>An</th>
                <th>Etapa</th>
                <th>Circuit</th>
                <th>Câștigător</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($races as $race): ?>
            <tr>
                <td><?= $race['year'] ?></td>
                <td>#<?= $race['round'] ?></td>
                <td><?= htmlspecialchars($race['circuit']) ?></td>
                <td>
                    <strong><?= htmlspecialchars($race['winner']) ?></strong><br>
                    <span style="font-size: 12px; color: #666;"><?= htmlspecialchars($race['team']) ?></span>
                </td>
                <td>
                    <a href="admin.php?delete_id=<?= $race['id'] ?>" 
                       class="btn-delete"
                       onclick="return confirm('Sigur vrei să ștergi cursa din <?= $race['circuit'] ?>?');">
                       Șterge
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>