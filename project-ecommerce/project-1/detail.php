<?php
require_once 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$detail = mysqli_fetch_assoc($result);

if (!$detail) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

  <main class="container my-5 flex-grow-1">
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Halaman Utama</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Informasi</li>
      </ol>
    </nav>

    <div class="card shadow-sm border-0 overflow-hidden">
      <div class="row g-0">
        <div class="col-md-5">
          <img src="<?= htmlspecialchars($detail['gambar']) ?>" class="detail-img" alt="<?= htmlspecialchars($detail['judul']) ?>">
        </div>
        <div class="col-md-7">
          <div class="card-body p-4 p-lg-5">
            <span class="badge bg-primary mb-2"><?= htmlspecialchars($detail['kategori']) ?></span>
            <h2 class="fw-bold mb-2"><?= htmlspecialchars($detail['judul']) ?></h2>
            <h4 class="text-success fw-bold mb-3"><?= htmlspecialchars($detail['harga']) ?></h4>
            <p class="mb-3"><strong>Status Ketersediaan:</strong> <span class="badge bg-success-subtle text-success"><?= htmlspecialchars($detail['stok']) ?></span></p>
            <hr>
            <h6 class="fw-bold">Deskripsi & Spesifikasi Lengkap:</h6>
            <p class="text-muted lh-lg"><?= htmlspecialchars($detail['deskripsi']) ?></p>
            <div class="d-flex gap-2 mt-4">
              <a href="index.php" class="btn btn-outline-secondary">← Kembali ke Halaman Utama</a>
              <a href="login.php" class="btn btn-primary">Login untuk Memesan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>
