<?php
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(
        $_POST['username'],
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_POST['password']
    );

    if ($user->save($conn)) {
        header("Location: /login");
        exit;
    } else {
        echo "Registration failed.";
    }
}
?>
