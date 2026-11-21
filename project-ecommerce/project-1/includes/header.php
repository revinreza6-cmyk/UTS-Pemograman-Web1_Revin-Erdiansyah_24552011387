<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NusaMart E-Commerce</title>
  <!-- Framework CSS Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- File CSS Terpisah -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">NusaMart E-Commerce</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-2 align-items-lg-center">
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'index.php') ? 'active fw-semibold' : '' ?>" href="index.php">Halaman Utama</a>
          </li>
          <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
            <li class="nav-item">
              <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active fw-semibold' : '' ?>" href="dashboard.php">Menu Utama</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="btn btn-outline-light btn-sm <?= ($current_page == 'login.php') ? 'active' : '' ?>" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-warning btn-sm fw-semibold" href="register.php">Registrasi</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
