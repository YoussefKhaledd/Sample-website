<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$userId = $_SESSION['user_id'];
$data = User::getProfile($conn, $userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settings</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      padding-top: 70px;
    }
    .card {
      max-width: 600px;
      margin: auto;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/home">MyApp</a>
    <div class="d-flex">
      <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="card shadow p-4 mt-5">
  <h4 class="text-center mb-4">Settings</h4>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">✅ Profile updated successfully.</div>
  <?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger">❌ Failed to update profile.</div>
  <?php endif; ?>

  <form method="POST" action="/update_settings">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($userId) ?>">

    <div class="mb-3">
      <label class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control" required value="<?= htmlspecialchars($data['first_name']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control" required value="<?= htmlspecialchars($data['last_name']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">New Password <small>(leave blank to keep current)</small></label>
      <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary w-100" type="submit">Update Settings</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
