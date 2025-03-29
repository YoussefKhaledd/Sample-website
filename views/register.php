<?php
$errorType = $_GET['error'] ?? '';
$values = [
    'username' => $_GET['username'] ?? '',
    'firstName' => $_GET['firstName'] ?? '',
    'lastName' => $_GET['lastName'] ?? '',
    'email' => $_GET['email'] ?? ''
];

$errorMessage = '';
if ($errorType === 'email') {
    $errorMessage = 'Email already exists.';
} elseif ($errorType === 'username') {
    $errorMessage = 'Username is already taken.';
} elseif ($errorType === 'server') {
    $errorMessage = 'Registration failed. Please try again.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center bg-light vh-100">

  <div class="card p-4 shadow" style="max-width: 500px; width: 100%;">
    <h3 class="mb-4 text-center">Create Account</h3>

    <?php if (!empty($errorMessage)): ?>
      <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="/register">
    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required value="<?= htmlspecialchars($values['username']) ?>">
      <input type="text" name="firstName" class="form-control mb-3" placeholder="First Name" required value="<?= htmlspecialchars($values['firstName']) ?>">
      <input type="text" name="lastName" class="form-control mb-3" placeholder="Last Name" required value="<?= htmlspecialchars($values['lastName']) ?>">
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" required value="<?= htmlspecialchars($values['email']) ?>">
      <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>

      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
      <p class="text-center mt-3 mb-0">Already have an account? <a href="/login">Sign in</a></p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
