<?php

try {
    $databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
 
    $query = "SELECT username, email, datenaissance, fav1, fav2, fav3 FROM user WHERE id ='64'";
    $statement = $databaseHandler->prepare($query);
    $statement->execute();
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);


     $favorites = [];
     for ($i = 1; $i <= 3; $i++) {
     $favorites["fav$i"] = json_decode($userInfo["fav$i"], true);
     }

} catch (Exception $e) {
    echo $e->getMessage();  
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon suivi crypto</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="script.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Manrope:wght@400;500;700&family=Noto+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/70fabb1b7e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="body-cryptopage">
     <div id="database-container"></div>

    <header class="header-in-cryptopage">
        <div class="logo-and-title-in-cryptopage">
          <a href="index.html">
               <img class="logo-in-cryptopage" src="assets/logo-crypto.png">
          </a>
          <h1 class="main-title-in-cryptopage">MON SUIVI CRYPTO</h1>
        </div>
        <nav class="nav-bar-cryptopage">
            <a href="#user-container-id" class="nav-button">Profil</a>
            <a class="nav-button">Log out</a>
            <a href="#user-container-id" class="nav-icone-mobile">
               <i class="fa-solid fa-user icone-nav-bar"></i>
            </a>
            <a class="nav-icone-mobile">
               <i class="fa-solid fa-right-from-bracket icone-nav-bar"></i>
            </a>
        </nav>  
    </header>
   <div class="user-container" id="user-container-id">
        <div class="avatar-container">
            <img src="/assets/avatar.png" class="avatar" alt="un exemple d'avatar">
            <button type="submit" class="button-in-user-container" id="update-profile-button">Modifier profil</button>
            <button type="submit" class="button-in-user-container" id="validate-update-button">Valider</button>
            <form action="deleteuser.php" method="post">
               <button type="submit" class="button-in-user-container" id="delete-profile-button">Supprimer profil</button>
               <input type="hidden" name="username" value="<?php echo isset($userInfo['username']) ? $userInfo['username'] : ''; ?>">
            </form>
               <button type="submit" class="fa-solid fa-user-pen" id="update-profile-button-mobile"></button>
               <button type="submit" class="fa-solid fa-check" id="validate-profile-button-mobile"></button>
        </div>

        <div class="user-info-container">

        <span class="user-info" id="username-from-db"><?php echo isset($userInfo['username']) ? htmlspecialchars($userInfo['username']) : ''; ?></span>
        <span class="user-info" id="email-from-db"><?php echo isset($userInfo['email']) ? htmlspecialchars($userInfo['email']) : ''; ?></span>
        <span class="user-info" id="date-from-db"><?php echo isset($userInfo['datenaissance']) ? htmlspecialchars($userInfo['datenaissance']) : ''; ?></span>

        </div>
        <div class="favorite-cryptos-container">
               <?php for ($i = 1; $i <= 3; $i++): ?>
               <div class="fav-crypto">
                    <i class="fa-solid fa-star"></i>
                    <span class="fav-crypto-name"><?php echo $favorites["fav$i"]['name'] ?? ''; ?></span>
                    <span><?php echo $favorites["fav$i"]['price'] ?? ''; ?></span>
                    <span><?php echo $favorites["fav$i"]['percent'] ?? ''; ?></span>
                    <i class="fa-solid fa-trash-can delete-fav" data-favnum="<?php echo $i; ?>"></i>
               </div>
               <?php endfor; ?>
        </div>
   </div>
   <form action="deleteuser.php" method="post" class="delete-container">
        <button type="submit" class="fa-solid fa-trash-can" id="delete-profile-button-mobile"></button>
   </form>

   <div class="favorite-cryptos-container-mobile">
               <?php for ($i = 1; $i <= 3; $i++): ?>
               <div class="fav-crypto">
                    <i class="fa-solid fa-star"></i>
                    <span class="fav-crypto-name"><?php echo $favorites["fav$i"]['name'] ?? ''; ?></span>
                    <span><?php echo $favorites["fav$i"]['price'] ?? ''; ?></span>
                    <span><?php echo $favorites["fav$i"]['percent'] ?? ''; ?></span>
                    <i class="fa-solid fa-trash-can delete-fav" data-favnum="<?php echo $i; ?>"></i>
               </div>
               <?php endfor; ?>
   </div>
   <div class="header-table-mobile">
        <span class="title-column crypt-title">Crypto</span>
        <span class="title-column val-title">Valeur</span>
        <span class="title-column fav-title">Favoris</span>
   </div>
   <div class="header-table-desktop">
     <div class="column-table-desktop border-on-right-side">
          <span class="title-column crypt-title">Crypto</span>
          <span class="title-column val-title">Valeur</span>
          <span class="title-column fav-title">Favoris</span>
     </div>
     <div class="column-table-desktop">
          <span class="title-column crypt-title">Crypto</span>
          <span class="title-column val-title">Valeur</span>
          <span class="title-column fav-title">Favoris</span>
     </div>
   </div>
   <div class="cryptos">
        <div id="crypto-container">

        </div>
   </div>
   <footer class="footer-in-cryptopage">
        <img class="logo-in-footer" src="/assets/logo-crypto.png" alt="logo du site">
        <a>Mentions légales</a>
        <a href="mailto:monsuivicrypto@projet.fr" class="contact">Contactez-nous</a>
   </footer>
   <script src="update_profile.js"></script>

</body>
</html>

