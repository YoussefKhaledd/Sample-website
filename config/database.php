<?php
$host = '127.0.0.1';
$username = 'phpuser';
$password = 'strongpassword';
$database = 'sign_up';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
