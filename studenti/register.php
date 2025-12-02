<?php
require 'db.php';

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validări simple
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Toate câmpurile sunt obligatorii!";
    } elseif ($password !== $confirm_password) {
        $error = "Parolele nu coincid!";
    } else {
        // Verificăm dacă userul există deja
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Acest nume de utilizator este deja luat.";
        } else {
            // Totul e OK, creăm contul
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            
            if ($insert->execute([$username, $hashed_password])) {
                $message = "Cont creat cu succes! <a href='login.php' style='color: white; text-decoration: underline;'>Loghează-te acum</a>";
            } else {
                $error = "A apărut o eroare la salvare.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - F1 Paddock</title>
    <link rel="stylesheet" href="f1_style.css"> 
    <link rel="icon" type="image/png" href="imagini/favicon.png">
</head>
<body>

    <div style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
        
        <div class="login-container">
            <h2>📝 Înregistrare Pilot</h2>
            <h3>Alătură-te Grilei</h3>
            
            <?php if($error): ?>
                <p style="color: #ffcccc; background: rgba(255,0,0,0.3); padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

            <?php if($message): ?>
                <p style="color: #ccffcc; background: rgba(0,255,0,0.2); padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $message; ?>
                </p>
            <?php else: ?>

            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">Nume Utilizator</label>
                    <input type="text" id="username" name="username" placeholder="Alege un nume" required>
                </div>

                <div class="input-group">
                    <label for="password">Parolă</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <div class="input-group">
                    <label for="confirm_password">Confirmă Parola</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="********" required>
                </div>

                <button type="submit">Creează Cont</button>
            </form>
            
            <?php endif; ?>

            <div class="extra-links" style="margin-top: 20px;">
                Ai deja cont? <a href="login.php" style="color: #ff0000; font-weight:bold;">Loghează-te aici</a>
            </div>
        </div>
        
    </div>

</body>
</html>