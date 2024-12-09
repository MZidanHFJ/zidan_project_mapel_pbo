<?php
require_once 'Barang.php';
require_once 'BarangManager.php';
require_once 'Customer.class.php';
require_once 'CustomerManager.php';

$barangManager = new BarangManager();
$customerManager = new CustomerManager();

// Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: admin.php');
}

// Menangani form tambah customer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_customer'])) {
    $nama = $_POST['nama_customer'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $customerManager->tambahCustomer($nama, $email, $telepon, $alamat);
    header('Location: admin.php');
}

// Menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: admin.php');
}

// Menangani penghapusan customer
if (isset($_GET['hapus_customer'])) {
    $id = $_GET['hapus_customer'];
    $customerManager->hapusCustomer($id);
    header('Location: admin.php');
}

$barang = $barangManager->getBarang();
$customers = $customerManager->getCustomers();
$totalBarang = count($barang);
$totalCustomers = count($customers);
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
    <title>Admin</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                Admin Panel
            </div>
            <nav class="admin-menu">
                <a href="index.php">Home</a>
                <a href="admin.php" class="active">Admin Panel</a>
            </nav>
        </aside>

        <main class="admin-content">
            <h1>Panel Admin</h1>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value"><?= $totalBarang ?></div>
                    <div class="stat-label">Total Barang</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= $totalStok ?></div>
                    <div class="stat-label">Total Stok</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">Rp <?= number_format($totalNilai, 0, ',', '.') ?></div>
                    <div class="stat-label">Total Nilai</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= $totalCustomers ?></div>
                    <div class="stat-label">Total Customer</div>
                </div>
            </div>

            <div class="admin-sections">
                <!-- Bagian Kelola Barang -->
                <section class="admin-section">
                    <h2>Kelola Barang</h2>
                    <form method="POST" action="" class="admin-form">
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" id="harga" name="harga" required>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" id="stok" name="stok" required>
                        </div>

                        <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
                    </form>
                    
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Total Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= htmlspecialchars($item['nama']) ?></td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td><?= $item['stok'] ?></td>
                                    <td>Rp <?= number_format($item['harga'] * $item['stok'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="?hapus=<?= $item['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>

                <!-- Bagian Kelola Customer -->
                <section class="admin-section">
                    <h2>Kelola Customer</h2>
                    <form method="POST" action="" class="admin-form">
                        <div class="form-group">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" id="nama_customer" name="nama_customer" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="tel" id="telepon" name="telepon" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" required></textarea>
                        </div>

                        <button type="submit" name="tambah_customer" class="btn btn-add">Tambah Customer</button>
                    </form>
                    
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?= $customer['id'] ?></td>
                                    <td><?= htmlspecialchars($customer['nama']) ?></td>
                                    <td><?= htmlspecialchars($customer['email']) ?></td>
                                    <td><?= htmlspecialchars($customer['telepon']) ?></td>
                                    <td><?= htmlspecialchars($customer['alamat']) ?></td>
                                    <td>
                                        <a href="?hapus_customer=<?= $customer['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus customer ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>