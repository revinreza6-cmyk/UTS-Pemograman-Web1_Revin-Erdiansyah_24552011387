<?php
require_once 'koneksi.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $cek = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($cek, "ss", $username, $email);
    mysqli_stmt_execute($cek);
    mysqli_stmt_store_result($cek);

    if (mysqli_stmt_num_rows($cek) > 0) {
        $error = "Username atau Email sudah terdaftar! Gunakan yang lain.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (nama, email, username, password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $username, $password);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php?status=registered");
            exit;
        } else {
            $error = "Terjadi kesalahan saat menyimpan data.";
        }
    }
}

include 'includes/header.php';
?>

  <main class="container my-auto py-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm auth-card">
          <div class="card-body p-4">
            <h4 class="fw-bold text-center mb-1">Registrasi Pelanggan</h4>
            <p class="text-muted text-center small mb-4">Buat akun baru untuk berbelanja di NusaMart</p>

            <?php if ($error !== ""): ?>
              <div class="alert alert-danger py-2 small"><?= $error ?></div>
            <?php endif; ?>

            <div id="regError" class="alert alert-danger py-2 small d-none"></div>

            <form method="POST" action="register.php" onsubmit="return validasiRegister()">
              <div class="mb-3">
                <label for="regNama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="regNama" name="nama" placeholder="Contoh: Revin Erdiansyah">
              </div>
              <div class="mb-3">
                <label for="regEmail" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="regEmail" name="email" placeholder="nama@email.com">
              </div>
              <div class="mb-3">
                <label for="regUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="regUsername" name="username" placeholder="Buat username">
              </div>
              <div class="mb-3">
                <label for="regPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="regPassword" name="password" placeholder="Buat password">
              </div>
              <button type="submit" class="btn btn-success w-100 fw-semibold">Daftar Sekarang</button>
            </form>

            <p class="text-center small mt-3 mb-0">
              Sudah punya akun? <a href="login.php">Login di sini</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>
