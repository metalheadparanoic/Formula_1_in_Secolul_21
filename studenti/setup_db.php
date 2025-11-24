<?php
require 'db.php';

try {
    echo "Conectare reușită!<br>";

    // 1. Creăm tabelul users dacă nu există
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Tabelul 'users' este pregătit.<br>";

    // 2. Creăm utilizatorul admin
    $username = 'admin';
    $password = 'f12025'; // Parola simplă
    
    // O criptăm pentru securitate
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verificăm dacă există deja ca să nu-l dublăm
    $stmt = $pdo->prepare("SELECT count(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    
    if ($stmt->fetchColumn() == 0) {
        $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->execute([$username, $hashed_password]);
        echo "Utilizatorul <b>admin</b> a fost creat cu parola <b>f12025</b>.";
    } else {
        echo "Utilizatorul admin există deja.";
    }

} catch (PDOException $e) {
    echo "Eroare: " . $e->getMessage();
}
?>