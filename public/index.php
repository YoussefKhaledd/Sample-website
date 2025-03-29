<?php
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$route = trim($request, '/');

switch ($route) {
    case 'register':
        if ($method === 'POST') {
            require_once '../controllers/handle_register.php';
        } else {
            require_once '../views/register.php';
        }
        break;

    case 'login':
        if ($method === 'POST') {
            require_once '../controllers/handle_login.php';
        } else {
            require_once '../views/login.php';
        }
        break;

    case 'dashboard':
        require_once '../home/dashboard.php';
        break;

    case '':
        header("Location: /register");
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}
