<?php
// Setările sunt luate direct din fișierul docker-compose.yml
$host = 'mysql'; // Numele serviciului din docker-compose
$db   = 'studenti';
$user = 'roacer';
$pass = 'roacer9053';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Dacă apare o eroare, o afișăm și oprim totul
    die("Eroare la conectarea cu baza de date: " . $e->getMessage());
}
?>