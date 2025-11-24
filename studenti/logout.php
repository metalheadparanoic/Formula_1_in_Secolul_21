<?php
session_start();
// Ștergem toate datele sesiunii
session_unset();
session_destroy();

// Redirecționăm la pagina de login
header("Location: login.php");
exit;
?>