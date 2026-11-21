// Validasi Login menggunakan Struktur Percabangan IF sesuai instruksi soal
function validasiLogin() {
  const username = document.getElementById("loginUsername").value.trim();
  const password = document.getElementById("loginPassword").value.trim();
  const pesanError = document.getElementById("pesanError");

  if (username === "" && password === "") {
    pesanError.textContent = "Username dan Password tidak boleh kosong!";
    pesanError.classList.remove("d-none");
    return false;
  } else if (username === "") {
    pesanError.textContent = "Username wajib diisi!";
    pesanError.classList.remove("d-none");
    return false;
  } else if (password === "") {
    pesanError.textContent = "Password wajib diisi!";
    pesanError.classList.remove("d-none");
    return false;
  } else if (password.length < 4) {
    pesanError.textContent = "Password minimal 4 karakter!";
    pesanError.classList.remove("d-none");
    return false;
  } else {
    // Jika input sesuai kriteria, sembunyikan error dan lanjutkan proses login
    pesanError.classList.add("d-none");
    return true;
  }
}

// Validasi Form Registrasi
function validasiRegister() {
  const nama = document.getElementById("regNama").value.trim();
  const email = document.getElementById("regEmail").value.trim();
  const username = document.getElementById("regUsername").value.trim();
  const password = document.getElementById("regPassword").value.trim();
  const errorBox = document.getElementById("regError");

  if (nama === "" || email === "" || username === "" || password === "") {
    errorBox.textContent = "Semua kolom registrasi wajib diisi!";
    errorBox.classList.remove("d-none");
    return false;
  } else if (password.length < 4) {
    errorBox.textContent = "Password minimal 4 karakter!";
    errorBox.classList.remove("d-none");
    return false;
  } else {
    errorBox.classList.add("d-none");
    return true;
  }
}

// Notifikasi tambah ke keranjang di Halaman Menu Utama
function tambahKeranjang(namaProduk) {
  alert("Produk \"" + namaProduk + "\" berhasil ditambahkan ke keranjang belanja!");
}
