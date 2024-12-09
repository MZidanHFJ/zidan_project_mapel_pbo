<?php
require_once 'Barang.php';
require_once 'BarangManager.php';

$barangManager = new BarangManager();
$barang = $barangManager->getBarang();

// Hitung statistik
$totalBarang = count($barang);
$totalStok = array_sum(array_column($barang, 'stok'));
$totalNilai = array_sum(array_map(function($item) {
    return $item['harga'] * $item['stok'];
}, $barang));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                Customer Panel
            </div>
            <nav class="admin-menu">
                <a href="index.php">Home</a>
                <a href="customer.php" class="active">Customer Panel</a>
            </nav>
        </aside>

        <main class="admin-content">
            <h1>Daftar Barang</h1>

            <div class="product-grid">
                <?php foreach ($barang as $item): ?>
                    <div class="product-card">
                        <div class="product-header">
                            <h3><?= htmlspecialchars($item['nama']) ?></h3>
                        </div>
                        <div class="product-info">
                            <div class="price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                            <div class="stock">Stok: <?= $item['stok'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
<script src="js/main.js"></script>
</html>
