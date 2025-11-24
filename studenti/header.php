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
                <li style="color: #ff0000; font-weight: bold; display: flex; align-items: center;">
                    Salut, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </li>
                <li><a href="logout.php" class="login-btn" style="background-color: #333; border: 1px solid #555;">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="login-btn">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>