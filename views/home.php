<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    body {
      padding-top: 70px;
    }

    .wrapper {
      height: calc(100% - 70px);
    }

    .card {
      max-width: 600px;
      width: 100%;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/home">MyApp</a>
    <div class="d-flex align-items-center">
      <span class="me-2 fw-semibold"><?= $username ?></span>
      <img src="https://ui-avatars.com/api/?name=<?= urlencode($username) ?>&background=0D8ABC&color=fff"
           alt="User Avatar" class="profile-img">
      <a href="/logout" class="btn btn-outline-danger btn-sm ms-3">Logout</a>
    </div>
  </div>
</nav>

<div class="wrapper d-flex align-items-center justify-content-center">
  <div class="card shadow p-5 text-center">
    <h2 class="mb-3">Welcome, <?= $username ?> 🎉</h2>
    <p class="text-muted mb-4">This is your dashboard. Use the button below to edit your profile.</p>
    
    <a href="/settings" class="btn btn-primary w-100">Go to Settings</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
