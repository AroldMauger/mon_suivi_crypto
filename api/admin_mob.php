<?php

include_once '../utils/user_functions.php';  

$users = getAllUsers();

header('Content-Type: application/json');
echo json_encode($users);
?>
