
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon suivi crypto</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Manrope:wght@400;500;700&family=Noto+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body class="body-landingpage">
    <header class="header-in-landingpage">
        <nav class="nav-bar">
            <a href="/pages/signup.html" class="signup-button">S'INSCRIRE</a>
            <button id="login-button-desktop" class="login-button-desktop">Se connecter</button>
            <button id="retour-button" class="login-button-desktop" style="display: none;">Retour</button>
        </nav>  
        <div class="title-and-logo">
            <h1>MON SUIVI CRYPTO</h1>
            <img class="logo" src="assets/logo-crypto.png">
        </div>
    </header>
    <main class="main-landingpage">
        <div class="descr-and-img-container-landingpage">
            <p class="description-text">Une application <strong>performante</strong> pour suivre les cours des <strong>cryptomonnaies</strong></p>
            <img class="landingpage-image" src="/assets/landingpage-img.jpg" alt="Un ordinateur avec un symbole de cryptomonnaie à l'écran">
        </div>
        <div class="login-form">
            <h2 class="title-login-mobile">Se connecter</h2>
            <form action="login.php" method="post" class="inputs-container-login">
                <input class="input-in-login-form" type="text" name="username" id="username-input-login" placeholder="Nom d'utilisateur" required>
                <input class="input-in-login-form" type="password" name="motdepasse" id="password-input-login" placeholder="Mot de passe" required>
                <button type="submit" id="submit-login">Envoyer</button>
            </form>
       
        </div>
        <div class="signup-button-container">
            <a href="/pages/signup.html" class="signup-button-desktop">Créer un compte</a>

        </div>

    </main>
    <footer class="footer-in-landing">
        <img class="logo-in-footer" src="/assets/logo-crypto.png" alt="logo du site">
        <a>Mentions légales</a>
        <a href="mailto:monsuivicrypto@projet.fr" class="contact">Contactez-nous</a>
   </footer>
   <script src="login.js"></script>

</body>
</html>

