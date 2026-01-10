<?php
require 'db.php';

try {
    echo "<h1>Configurare Bază de Date F1 - Arhiva Master</h1>";
    echo "<p>Se verifică structura tabelelor...</p><hr>";

    // ---------------------------------------------------------
    // 1. Tabelul USERS (Conturile de login)
    // ---------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✅ Tabelul <b>users</b> este pregătit.<br>";
    
    // ---------------------------------------------------------
    // 2. Tabelul HISTORY_SEASONS (Părintele - Informații generale despre an)
    // ---------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS history_seasons (
        year INT PRIMARY KEY,
        description TEXT,
        champion_driver VARCHAR(100),
        champion_team VARCHAR(100),
        car_image VARCHAR(255) DEFAULT 'default_car.png'
    )";
    $pdo->exec($sql);
    echo "✅ Tabelul <b>history_seasons</b> este pregătit.<br>";

    // ---------------------------------------------------------
    // 3. Tabelul HISTORY_RACES (Cursele din acel an)
    // ---------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS history_races (
        id INT AUTO_INCREMENT PRIMARY KEY,
        year INT,
        round INT,
        circuit VARCHAR(100),
        laps INT,                          -- NOU: Număr de tururi
        date VARCHAR(50),
        winner VARCHAR(100),
        team VARCHAR(100),
        time VARCHAR(50),                  -- NOU: Durata cursei
        FOREIGN KEY (year) REFERENCES history_seasons(year) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "✅ Tabelul <b>history_races</b> este pregătit (include tururi și timp).<br>";

    // ---------------------------------------------------------
    // 4. Tabelul HISTORY_STANDINGS (Clasamentul Piloților)
    // ---------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS history_standings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        year INT,
        position INT,
        driver_name VARCHAR(100),
        team_name VARCHAR(100),
        points FLOAT,
        FOREIGN KEY (year) REFERENCES history_seasons(year) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "✅ Tabelul <b>history_standings</b> este pregătit.<br>";

    // ---------------------------------------------------------
    // 5. Tabelul HISTORY_CONSTRUCTORS (NOU: Clasamentul Echipelor)
    // ---------------------------------------------------------
    $sql = "CREATE TABLE IF NOT EXISTS history_constructors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        year INT,
        position INT,
        team_name VARCHAR(100),
        points FLOAT,
        FOREIGN KEY (year) REFERENCES history_seasons(year) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "✅ Tabelul <b>history_constructors</b> este pregătit.<br>";

    // ---------------------------------------------------------
    // 6. Crearea Userului Admin (Doar dacă nu există)
    // ---------------------------------------------------------
    $username = 'admin';
    $stmt = $pdo->prepare("SELECT count(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetchColumn() == 0) {
        $password = password_hash('f12025', PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->execute([$username, $password]);
        echo "Utilizatorul 'admin' a fost creat.<br>";
    }

    echo "<hr><h3 style='color:green'>Structura bazei de date este completă.</h3>";

} catch (PDOException $e) {
    die("Eroare Critică: " . $e->getMessage());
}
?>