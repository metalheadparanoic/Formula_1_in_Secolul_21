<?php
session_start(); // Pornim sesiunea pentru a ține minte utilizatorul
require 'db.php';

$error = '';

// Verificăm dacă s-a apăsat butonul de Login (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Căutăm utilizatorul în baza de date
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Verificăm dacă userul există și dacă parola se potrivește
        if ($user && password_verify($password, $user['password'])) {
            // LOGIN REUȘIT!
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Îl trimitem pe pagina principală
            header("Location: index.php");
            exit;
        } else {
            $error = "Date de conectare incorecte!";
        }
    } else {
        $error = "Completează ambele câmpuri.";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pit Stop! Loghează-te</title>
    <link rel="stylesheet" href="f1_style.css"> 
    <link rel="stylesheet" href="stil_general.css">
</head>
<body>

    <div style="display:flex; justify-content:center; align-items:center; height:80vh;">
        <div class="login-container">
            <h2>🏎️ Pit Stop Login</h2>
            <h3>World Championship Access</h3>
            
            <?php if($error): ?>
                <p style="color: #ffcccc; background: rgba(255,0,0,0.3); padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">Nume Utilizator</label>
                    <input type="text" id="username" name="username" placeholder="admin" required>
                </div>

                <div class="input-group">
                    <label for="password">Parolă / Cod Boxe</label>
                    <input type="password" id="password" name="password" placeholder="f12025" required>
                </div>

                <button type="submit">Start Race (Login)</button>
            </form>

            <div class="extra-links">
                <a href="#">Ai uitat Codul de Boxe?</a>
            </div>
        </div>
    </div>

</body>
</html>