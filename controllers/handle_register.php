<?php
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = $_POST['username'] ?? '';
    $firstName  = $_POST['firstName'] ?? '';
    $lastName   = $_POST['lastName'] ?? '';
    $email      = $_POST['email'] ?? '';
    $password   = $_POST['password'] ?? '';

    // Escape values for redirect
    $query = http_build_query([
        'username' => $username,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email
    ]);

    if (User::isEmailTaken($conn, $email)) {
        header("Location: /register?error=email&$query");
        exit;
    }

    if (User::isUsernameTaken($conn, $username)) {
        header("Location: /register?error=username&$query");
        exit;
    }

    $user = new User($username, $firstName, $lastName, $email, $password);
    if ($user->save($conn)) {
        header("Location: /login");
        exit;
    } else {
        header("Location: /register?error=server&$query");
        exit;
    }
}
?>
