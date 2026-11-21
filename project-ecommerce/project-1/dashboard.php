<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$query_produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id ASC");
$total_produk = mysqli_num_rows($query_produk);

include 'includes/header.php';
?>

  <main class="container my-5 flex-grow-1">
    <div class="alert alert-success d-flex justify-content-between align-items-center">
      <div>
        <h5 class="alert-heading fw-bold mb-1">Selamat Datang, <?= htmlspecialchars($_SESSION['active_user']) ?>!</h5>
        <p class="mb-0 small">Anda telah berhasil login ke Halaman Menu Utama PT. NusaMart Digital Nusantara.</p>
      </div>
      <a href="index.php" class="btn btn-outline-success btn-sm">Lihat Halaman Utama</a>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm stat-card">
          <div class="card-body">
            <h6 class="text-muted">Total Produk di Database</h6>
            <h3 class="fw-bold text-primary mb-0"><?= $total_produk ?> Item</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm stat-card success">
          <div class="card-body">
            <h6 class="text-muted">Status Keanggotaan</h6>
            <h3 class="fw-bold text-success mb-0">Aktif (Verified)</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm stat-card warning">
          <div class="card-body">
            <h6 class="text-muted">Voucher Belanja</h6>
            <h3 class="fw-bold text-warning mb-0">Rp 250.000</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white fw-bold py-3">Daftar Produk Siap Pesan</div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($item = mysqli_fetch_assoc($query_produk)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td class="fw-semibold"><?= htmlspecialchars($item['judul']) ?></td>
                <td><span class="badge bg-secondary"><?= htmlspecialchars($item['kategori']) ?></span></td>
                <td class="text-success fw-bold"><?= htmlspecialchars($item['harga']) ?></td>
                <td><?= htmlspecialchars($item['stok']) ?></td>
                <td>
                  <button class="btn btn-sm btn-success" onclick="tambahKeranjang('<?= htmlspecialchars($item['judul']) ?>')">
                    + Pesan
                  </button>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>
