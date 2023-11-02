<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$base = "/api/api.php";
$requestUri = str_replace($base, "", $_SERVER['REQUEST_URI']);

switch ($requestUri) {
    case '/login':
        require 'login_mob.php';
        break;

    case '/logout':
        require 'logout_mob.php';
        break;

    case '/delete':
        require 'deleteuser_mob.php';
        break;

    case '/adduser':
        require 'adduser_mob.php';
        break;

    case '/update':
        require 'update_profile_mob.php';
        break;

    case '/uploadpicture':
        require 'upload_mob.php';
        break;

    case '/addtofavorites':
        require 'addtofavorites_mob.php';
        break;

    case '/getfavorites':
        require 'getfavorites_mob.php';
        break;

    case '/deletefavorite':
        require 'deletefavorite_mob.php';
        break;

    case '/admin':
        require 'admin_mob.php';
        break;

    case '/admin_deleteuser':
        require 'admin_deleteuser_mob.php';
        break;

     
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}

?>
