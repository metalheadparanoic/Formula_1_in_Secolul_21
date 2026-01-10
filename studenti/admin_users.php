<?php
session_start();
require 'db.php';

// 1. SECURITATE: Verificăm dacă ești logat ȘI dacă ești 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    // Dacă nu ești admin, te trimitem acasă sau afișăm o eroare
    header("Location: index.php");
    exit;
}

// 2. INTEROGARE: Luăm toți utilizatorii din baza de date
// Nu selectăm parola pentru securitate, doar ID, Nume și Data creării
$sql = "SELECT id, username, created_at FROM users ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou Admin - Lista Utilizatori</title>
    <link rel="stylesheet" href="stil_general.css">
    
    <style>
        /* Stiluri simple pentru tabel */
        .admin-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1a1a1a;
            border-radius: 10px;
            border: 1px solid #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        
        th {
            background-color: #ff0000;
            color: white;
            text-transform: uppercase;
        }
        
        tr:hover {
            background-color: #2c2c2c;
        }
        
        .badge {
            background-color: #333;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8em;
            color: #ccc;
        }
    </style>
    <link rel="icon" type="image/png" href="imagini/favicon.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="admin-container">
            <h2 style="color: #ff0000; border-bottom: 2px solid #ff0000; padding-bottom: 10px;">
                Lista Utilizatori Înregistrați
            </h2>
            
            <p>Total utilizatori: <strong><?php echo count($users); ?></strong></p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nume Utilizator</th>
                        <th>Data Înregistrării</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td>
                            <?php echo htmlspecialchars($user['username']); ?>
                            <?php if($user['username'] === 'admin'): ?>
                                <span class="badge" style="background: gold; color: black; font-weight: bold;">ADMIN</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td>Pilot</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>