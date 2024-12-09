<?php
require_once 'Barang.php';
require_once 'BarangManager.php';

$barangManager = new BarangManager();

// Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: index.php'); // Redirect untuk mencegah resubmission
}

// Menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php'); // Redirect setelah menghapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Loading Screen -->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>

    <div class="container">
        <h1>Selamat Datang di Toko Online</h1>
        <div class="menu-container">
            <div class="menu-card">
                <h2>Admin</h2>
                <p>Kelola barang dan customer</p>
                <a href="admin.php" class="button">Masuk sebagai Admin</a>
            </div>
            <div class="menu-card">
                <h2>Customer</h2>
                <p>Lihat daftar barang tersedia</p>
                <a href="customer.php" class="button">Lihat Barang</a>
            </div>
        </div>
    </div>
</body>
<script src="js/main.js"></script>
</html>