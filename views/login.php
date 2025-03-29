<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="/Sample-website/public/favicon.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center bg-light vh-100">
  <form method="POST" action="/login" class="card p-4 shadow" style="max-width: 500px; width: 100%;">
    <h3 class="mb-4 text-center">Sign In</h3>

    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>

    <button type="submit" class="btn btn-primary w-100">Login</button>
    <p class="text-center mt-3">Don't have an account? <a href="/register">Register</a></p>
  </form>
</body>
</html>
