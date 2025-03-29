<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Update email
    $stmt1 = $conn->prepare("UPDATE users SET email = ?, password = IF(? != '', ?, password) WHERE id = ?");
    $hashed = !empty($pass) ? password_hash($pass, PASSWORD_BCRYPT) : '';
    $stmt1->bind_param("ssss", $email, $pass, $hashed, $id);

    // Update names
    $stmt2 = $conn->prepare("UPDATE user_information SET first_name = ?, last_name = ? WHERE user_id = ?");
    $stmt2->bind_param("sss", $first, $last, $id);

    if ($stmt1->execute() && $stmt2->execute()) {
        header("Location: /settings?success=1");
    } else {
        header("Location: /settings?error=1");
    }
    exit;
}
?>
