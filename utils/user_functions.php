<?php
include_once '../api/config.php';

// FONCTION POUR SUPPRIMER UN COMPTE UTILISATEUR
function deleteUser($username) {
    try {
        $databaseHandler = getDatabaseConnection();
        
        $sql = "DELETE FROM user WHERE username = :username";
        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':username', $username);

        $statement->execute();

        if($statement->rowCount() > 0) {
            return [
                'success' => true,
                'message' => "Le compte : {$username} a bien été supprimé!"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Aucun compte trouvé avec le nom d'utilisateur : {$username}."
            ];
        }

    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Erreur lors de la suppression du compte. Probleme : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR AJOUTER UN COMPTE UTILISATEUR  - SIGNUP

function addUser($prenom, $nom, $datenaissance, $email, $username, $motdepasse) {
    try {
        $databaseHandler = getDatabaseConnection();

        $sql = "INSERT INTO user (prenom, nom, datenaissance, email, username, motdepasse)
                VALUES (:prenom, :nom, :datenaissance, :email, :username, :motdepasse)";
        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':datenaissance', $datenaissance);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':motdepasse', $motdepasse);
        $statement->execute();

        return [
            'success' => true,
            'message' => "Merci ! Votre compte : {$username} a bien été créé!"
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Erreur lors de la création du compte. Probleme : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR SE CONNECTER - LOGIN

function loginUser($username, $password) {
    try {
        $pdo = getDatabaseConnection();

        if ($username == "admincrypto" && $password == "Studi20@") {
            return [
                'success' => true,
                'message' => "Connexion réussie en tant qu'administrateur",
                'role' => "administrateur"
            ];
        }

        $stmt = $pdo->prepare('SELECT id, username, motdepasse FROM user WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['motdepasse']) {
            return [
                'success' => true,
                'message' => "Connexion réussie",
                'user_id' => $user['id']
            ];
        } else {
            return [
                'success' => false,
                'message' => "Informations d'identification incorrectes."
            ];
        }

    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => "Erreur : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR RECUPERER TOUS LES UTILISATEURS ENREGISTRÉS AU MOMENT DE LA SESSION ADMIN
function getAllUsers() {
    $databaseHandler = new PDO('mysql:host=127.0.0.1;dbname=monsuivicryptodb;port=3307;charset=utf8mb4', 'monsuivicrypto', 'mystudiproject');
    
    $query = "SELECT id, username, email, datenaissance FROM user";
    $statement = $databaseHandler->prepare($query);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// FONCTION POUR SUPPRIMER UN COMPTE UTILISATEUR DEPUIS LA SESSION ADMIN

function deleteUserById($id) {
    try {
        $databaseHandler = getDatabaseConnection();
        
        $sql = "DELETE FROM user WHERE id = :id";
        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return [
                'success' => true,
                'message' => "L'utilisateur avec l'ID : {$id} a bien été supprimé!"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Aucun utilisateur trouvé avec l'ID : {$id}."
            ];
        }

    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Erreur lors de la suppression de l'utilisateur. Probleme : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR METTRE A JOUR LE PROFIL UTILISATEUR

function updateUserProfile($userId, $username, $email, $datenaissance) {
    try {
        $databaseHandler = getDatabaseConnection();
        
        $sql = "UPDATE user SET username = :username, email = :email, datenaissance = :datenaissance WHERE id = :id";
        $statement = $databaseHandler->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':datenaissance', $datenaissance);
        $statement->bindParam(':id', $userId); 

        $success = $statement->execute();

        if ($success) {
            return [
                'success' => true
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Erreur lors de la mise à jour'
            ];
        }

    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Erreur lors de la mise à jour du profil. Probleme : " . $e->getMessage()
        ];
    }
}

// FONCTION POUR METTRE A JOUR La PHOTO DE PROFIL

function updateUserPhoto($userId, $photoPath) {
    $databaseHandler = getDatabaseConnection();
    $query = "UPDATE user SET photo = :photo WHERE id = :id";
    $statement = $databaseHandler->prepare($query);
    $statement->bindParam(':photo', $photoPath);
    $statement->bindParam(':id', $userId);

    return $statement->execute();
}

// FONCTION POUR SAUVEGARDER LA NOUVELLE PHOTO DE PROFIL
function uploadProfileImage($imageData) {
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024;

    if (!in_array($imageData['type'], $allowedMimeTypes)) {
        return "Type de fichier non autorisé.";
    }

    if ($imageData['size'] > $maxFileSize) {
        return "Le fichier est trop volumineux. Taille max : 5MB.";
    }

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/photos/";
    $filename = uniqid() . "-" . basename($imageData["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($imageData["tmp_name"], $target_file)) {
        return "/photos/" . $filename; 
    }

    return "Erreur lors du téléchargement du fichier.";
}

// FONCTION POUR AFFICHER LES CRYPTO FAVORITES

function getFavorites($userId) {
    $databaseHandler = getDatabaseConnection();
    $stmt = $databaseHandler->prepare("SELECT fav1, fav2, fav3 FROM user WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch();
}

// FONCTION POUR AJOUTER UNE CRYPTO FAVORITE

function addFavorite($userId, $favData) {
    $databaseHandler = getDatabaseConnection();
    $currentFavorites = getFavorites($userId);
    
    for ($i = 1; $i <= 3; $i++) {
        if (!$currentFavorites["fav$i"]) {
            $stmt = $databaseHandler->prepare("UPDATE user SET fav$i = :favData WHERE id = :id");
            $stmt->execute(['favData' => $favData, 'id' => $userId]);
            error_log("Favorite added successfully for user $userId at position $i.");
            return true; 
        }
    }

    error_log("All favorite slots are occupied for user $userId.");
    return false; 
}


// FONCTION POUR SUPPRIMER UNE CRYPTO FAVORITE
function deleteFavorite($userId, $favColumn) {
    $databaseHandler = getDatabaseConnection();

    $allowedColumns = ['fav1', 'fav2', 'fav3'];
    if (!in_array($favColumn, $allowedColumns)) {
        return ['success' => false, 'message' => 'Invalid column name.'];
    }

    $stmt = $databaseHandler->prepare("UPDATE user SET $favColumn = NULL WHERE id = :id");
    $success = $stmt->execute(['id' => $userId]);

    if (!$success) {
        $errorInfo = $stmt->errorInfo();
        return ['success' => false, 'message' => "Database error: " . $errorInfo[2]];
    } elseif ($stmt->rowCount() === 0) {
        return ['success' => false, 'message' => "No rows were affected. User ID might not exist or favorite was already NULL."];
    }

    return ['success' => $success];
}



?>

