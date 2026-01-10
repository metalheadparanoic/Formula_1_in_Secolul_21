<header>
    <div class="logo">
        <h1><a href="index.php">F1: Secolul 21</a></h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Acasă</a></li>
            <li><a href="piloti.php">Piloți</a></li>
            <li><a href="echipe.php">Echipe</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                
                <li><a href="paddock.php" style="color: #FFD700; border-bottom: 1px solid #FFD700;">Paddock Club</a></li>

                <li style="color: #ff0000; font-weight: bold; display: flex; align-items: center;">
                    Salut, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </li>
                
                <?php if ($_SESSION['username'] === 'admin'): ?>
                    <li><a href="admin.php" style="color: #00FF00; border-bottom: 1px solid #00FF00;">Admin Curse</a></li>
                    <li><a href="admin_users.php" style="color: #00FFFF; border-bottom: 1px solid #00FFFF;">Admin Utilizatori</a></li>
                <?php endif; ?>

                <li><a href="logout.php" class="login-btn" style="background-color: #333; border: 1px solid #555;">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="login-btn">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>