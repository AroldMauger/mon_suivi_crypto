<?php

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case '/login':
        require 'api/login_mob.php';
        break;

    case '/logout':
        require 'api/logout_mob.php';
        break;

    case '/delete':
        require 'api/deleteuser_mob.php';
        break;

    case '/adduser':
        require 'api/adduser_mob.php';
        break;

    case '/update':
        require 'api/update_profile_mob.php';
        break;

    case '/uploadpicture':
        require 'api/upload_mob.php';
        break;

    case '/addtofavorites':
        require 'api/addtofavorites_mob.php';
        break;

    case '/deletefavorite':
        require 'api/deletefavorite_mob.php';
        break;

    case '/admin':
        require 'api/admin_mob.php';
        break;

    case '/admin_deleteuser':
        require 'api/admin_deleteuser_mob.php';
        break;

     
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}

?>
