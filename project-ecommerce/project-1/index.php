<?php
require_once 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id ASC");

include 'includes/header.php';
?>

  <!-- Informasi Perusahaan -->
  <header class="hero-company py-5">
    <div class="container">
      <span class="badge bg-primary-subtle text-primary mb-2">Profil Perusahaan</span>
      <h1 class="display-6 fw-bold">PT. NusaMart Digital Nusantara</h1>
      <p class="lead text-muted col-lg-8">
        Platform E-Commerce terpercaya penyedia perangkat teknologi, aksesoris pintar, dan solusi pengadaan perangkat IT resmi untuk kebutuhan individu maupun korporasi di seluruh Indonesia.
      </p>
      <div class="d-flex flex-wrap gap-3 text-muted small">
        <span><strong>Alamat:</strong> Jl. Jenderal Sudirman Kav. 45, Jakarta</span>
        <span>|</span>
        <span><strong>Email:</strong> cs@nusamart.co.id</span>
      </div>
    </div>
  </header>

  <!-- Kumpulan Informasi / Katalog Produk -->
  <main class="container my-5 flex-grow-1">
    <div class="mb-4">
      <h3 class="fw-bold mb-0">Katalog Produk & Informasi Perusahaan</h3>
      <small class="text-muted">Pilih salah satu informasi di bawah untuk membuka Halaman Detail Informasi</small>
    </div>

    <div class="row g-4">
      <?php while ($item = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm border-0 product-card">
            <img src="<?= htmlspecialchars($item['gambar']) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($item['judul']) ?>">
            <div class="card-body d-flex flex-column">
              <span class="badge bg-primary-subtle text-primary mb-2 align-self-start"><?= htmlspecialchars($item['kategori']) ?></span>
              <h5 class="card-title fw-bold"><?= htmlspecialchars($item['judul']) ?></h5>
              <p class="text-success fw-semibold mb-2"><?= htmlspecialchars($item['harga']) ?></p>
              <p class="card-text text-muted small flex-grow-1"><?= htmlspecialchars($item['ringkasan']) ?></p>
              <a href="detail.php?id=<?= $item['id'] ?>" class="btn btn-primary w-100 mt-3">
                Lihat Detail Informasi
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>

<?php include 'includes/footer.php'; ?>
