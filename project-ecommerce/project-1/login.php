<?php
session_start();
require_once 'koneksi.php';

$login_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = mysqli_prepare($conn, "SELECT id, nama, username, password FROM users WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id']      = $user['id'];
        $_SESSION['active_user']  = $user['nama'];
        header("Location: dashboard.php");
        exit;
    } else {
        $login_error = "Login Gagal! Username atau Password salah.";
    }
}

include 'includes/header.php';
?>

  <main class="container my-auto py-5">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm auth-card">
          <div class="card-body p-4">
            <h4 class="fw-bold text-center mb-1">Login Akun</h4>
            <p class="text-muted text-center small mb-4">Masuk ke Menu Utama NusaMart</p>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'registered'): ?>
              <div class="alert alert-success py-2 small">
                Registrasi berhasil! Silakan login dengan akun Anda.
              </div>
            <?php endif; ?>

            <?php if ($login_error !== ""): ?>
              <div class="alert alert-danger py-2 small"><?= $login_error ?></div>
            <?php endif; ?>

            <!-- Alert Error dari Validasi JavaScript -->
            <div id="pesanError" class="alert alert-danger py-2 small d-none"></div>

            <form method="POST" action="login.php" onsubmit="return validasiLogin()">
              <div class="mb-3">
                <label for="loginUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="loginUsername" name="username" placeholder="Masukkan username">
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Masukkan password">
              </div>
              <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
            </form>

            <div class="alert alert-info mt-3 mb-0 py-2 small">
              <strong>Akun Demo:</strong><br>
              Username: <code>admin</code> | Password: <code>123456</code>
            </div>

            <p class="text-center small mt-3 mb-0">
              Belum punya akun? <a href="register.php">Registrasi di sini</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>
