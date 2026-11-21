<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Tangani preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Hubungkan ke file koneksi database Project 1
require_once '../koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Ambil data JSON dari body request (untuk POST dan PUT)
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    // =========================================================================
    // 1. READ (GET) - Mengambil semua produk atau 1 produk berdasarkan ID
    // =========================================================================
    case 'GET':
        if ($id) {
            $stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($result);

            if ($data) {
                http_response_code(200);
                echo json_encode([
                    "status" => true,
                    "message" => "Detail produk ditemukan",
                    "data" => $data
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    "status" => false,
                    "message" => "Produk dengan ID $id tidak ditemukan"
                ]);
            }
        } else {
            $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id ASC");
            $list_produk = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $list_produk[] = $row;
            }

            http_response_code(200);
            echo json_encode([
                "status" => true,
                "message" => "Berhasil mengambil daftar produk",
                "total_data" => count($list_produk),
                "data" => $list_produk
            ]);
        }
        break;

    // =========================================================================
    // 2. CREATE (POST) - Menambahkan data produk baru
    // =========================================================================
    case 'POST':
        if (!isset($input['kategori'], $input['judul'], $input['harga'], $input['stok'], $input['ringkasan'], $input['deskripsi'])) {
            http_response_code(400);
            echo json_encode([
                "status" => false,
                "message" => "Data tidak lengkap! Wajib mengisi: kategori, judul, harga, stok, ringkasan, deskripsi"
            ]);
            exit;
        }

        $kategori    = trim($input['kategori']);
        $judul       = trim($input['judul']);
        $harga       = trim($input['harga']);
        $harga_angka = isset($input['harga_angka']) ? (int)$input['harga_angka'] : 0;
        $stok        = trim($input['stok']);
        $gambar      = isset($input['gambar']) && !empty(trim($input['gambar']))
                       ? trim($input['gambar'])
                       : "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=800&q=80";
        $ringkasan   = trim($input['ringkasan']);
        $deskripsi   = trim($input['deskripsi']);

        $stmt = mysqli_prepare($conn, "INSERT INTO produk (kategori, judul, harga, harga_angka, stok, gambar, ringkasan, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssissss", $kategori, $judul, $harga, $harga_angka, $stok, $gambar, $ringkasan, $deskripsi);

        if (mysqli_stmt_execute($stmt)) {
            $new_id = mysqli_insert_id($conn);
            http_response_code(201);
            echo json_encode([
                "status" => true,
                "message" => "Produk baru berhasil ditambahkan",
                "data" => [
                    "id" => $new_id,
                    "kategori" => $kategori,
                    "judul" => $judul,
                    "harga" => $harga,
                    "harga_angka" => $harga_angka,
                    "stok" => $stok,
                    "gambar" => $gambar,
                    "ringkasan" => $ringkasan,
                    "deskripsi" => $deskripsi
                ]
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => false,
                "message" => "Gagal menambahkan produk: " . mysqli_error($conn)
            ]);
        }
        break;

    // =========================================================================
    // 3. UPDATE (PUT) - Mengubah data produk berdasarkan ID
    // =========================================================================
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode([
                "status" => false,
                "message" => "Parameter ?id= wajib disertakan pada URL untuk update data"
            ]);
            exit;
        }

        // Cek apakah ID produk ada di database
        $cek = mysqli_prepare($conn, "SELECT * FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($cek, "i", $id);
        mysqli_stmt_execute($cek);
        $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($cek));

        if (!$existing) {
            http_response_code(404);
            echo json_encode([
                "status" => false,
                "message" => "Produk dengan ID $id tidak ditemukan"
            ]);
            exit;
        }

        $kategori    = isset($input['kategori']) ? trim($input['kategori']) : $existing['kategori'];
        $judul       = isset($input['judul']) ? trim($input['judul']) : $existing['judul'];
        $harga       = isset($input['harga']) ? trim($input['harga']) : $existing['harga'];
        $harga_angka = isset($input['harga_angka']) ? (int)$input['harga_angka'] : $existing['harga_angka'];
        $stok        = isset($input['stok']) ? trim($input['stok']) : $existing['stok'];
        $gambar      = isset($input['gambar']) ? trim($input['gambar']) : $existing['gambar'];
        $ringkasan   = isset($input['ringkasan']) ? trim($input['ringkasan']) : $existing['ringkasan'];
        $deskripsi   = isset($input['deskripsi']) ? trim($input['deskripsi']) : $existing['deskripsi'];

        $stmt = mysqli_prepare($conn, "UPDATE produk SET kategori=?, judul=?, harga=?, harga_angka=?, stok=?, gambar=?, ringkasan=?, deskripsi=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssissssi", $kategori, $judul, $harga, $harga_angka, $stok, $gambar, $ringkasan, $deskripsi, $id);

        if (mysqli_stmt_execute($stmt)) {
            http_response_code(200);
            echo json_encode([
                "status" => true,
                "message" => "Data produk ID $id berhasil diperbarui",
                "data" => [
                    "id" => $id,
                    "kategori" => $kategori,
                    "judul" => $judul,
                    "harga" => $harga,
                    "harga_angka" => $harga_angka,
                    "stok" => $stok,
                    "gambar" => $gambar,
                    "ringkasan" => $ringkasan,
                    "deskripsi" => $deskripsi
                ]
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => false,
                "message" => "Gagal memperbarui produk: " . mysqli_error($conn)
            ]);
        }
        break;

    // =========================================================================
    // 4. DELETE (DELETE) - Menghapus data produk berdasarkan ID
    // =========================================================================
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode([
                "status" => false,
                "message" => "Parameter ?id= wajib disertakan pada URL untuk menghapus data"
            ]);
            exit;
        }

        $cek = mysqli_prepare($conn, "SELECT id FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($cek, "i", $id);
        mysqli_stmt_execute($cek);
        mysqli_stmt_store_result($cek);

        if (mysqli_stmt_num_rows($cek) === 0) {
            http_response_code(404);
            echo json_encode([
                "status" => false,
                "message" => "Produk dengan ID $id tidak ditemukan"
            ]);
            exit;
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            http_response_code(200);
            echo json_encode([
                "status" => true,
                "message" => "Produk dengan ID $id berhasil dihapus"
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => false,
                "message" => "Gagal menghapus produk: " . mysqli_error($conn)
            ]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode([
            "status" => false,
            "message" => "Metode HTTP $method tidak diizinkan"
        ]);
        break;
}
?>