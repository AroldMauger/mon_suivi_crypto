<?php
session_start();
include_once '../utils/user_functions.php';

if (isset($_POST['username'], $_POST['motdepasse'])) {
    $result = loginUser($_POST['username'], $_POST['motdepasse']);
    
    if ($result['success']) {
        if ($result['role'] == "administrateur") {
            $_SESSION["role"] = "administrateur";
            header("Location: /pages/admin_web.php");
            exit;
        } else {
            $_SESSION['user_id'] = $result['user_id'];
            header('Location: /pages/crypto.php');
            exit;
        }
    } else {
        echo $result['message'];
    }
}
?>
