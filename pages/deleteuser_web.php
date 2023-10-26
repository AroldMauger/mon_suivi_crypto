<?php
require '../utils/user_functions.php';

// Initialisez la session si elle n'est pas déjà démarrée.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $api_response = deleteUser($_POST['username']);

    // Stockez le message dans la session pour l'afficher sur la page.
    $_SESSION['message'] = $api_response['message'];
    
    // Redirigez vers deleteuser_web.php pour éviter les soumissions multiples du formulaire.
    header("Location: deleteuser_web.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon suivi crypto</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="nav-bar-signup-page">
        <a href="/index.php" class="returntomain-button">Accueil</a>
    </nav>  
    <div class="signup-confirmation-message-container">
    <p class="signup-confirmation-message confirmation-message">
    <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </p>
</div>
</body>
</html>