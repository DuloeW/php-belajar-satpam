<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../pages/login-view.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="../assets/output.css">
</head>
<body class="bg-gray-50 min-h-screen flex">
    <?php include '../components/sidebar.php'; ?>

    <main class="flex-1 flex items-center justify-center p-4">
        <?php
        include '../auth/koneksi.php';
        // Ambil data berdasarkan id dari parameter GET
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $query = mysqli_query($koneksi, "SELECT * FROM pencatatan WHERE id_pencatatan = $id");
        $data = mysqli_fetch_assoc($query);

        if (!$data) {
            echo "<div class='bg-white p-6 rounded shadow text-center'>Data tidak ditemukan.</div>";
        } else {
        ?>
        <form action="../handlers/edit_catatan_handler.php" method="POST" class="bg-white rounded-xl shadow-lg p-8 w-full max-w-4xl">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Catatan</h2>
            <input type="hidden" name="id_pencatatan" value="<?= htmlspecialchars($data['id_pencatatan']) ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom kiri -->
                <div class="space-y-4">
                    <div>
                        <p class="block text-sm font-medium text-gray-700 mb-1">Nomer Pencatatan</p>
                        <p class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50"><?= htmlspecialchars($data['no_pencatatan']) ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" maxlength="60" value="<?= htmlspecialchars($data['nama_mhs']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomer HP</label>
                        <input 
                            type="text" 
                            name="no_telp_mhs" 
                            maxlength="12"
                            value="<?= htmlspecialchars($data['no_telp_mhs']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tgl_pencatatan" value="<?= htmlspecialchars($data['tgl_pencatatan']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                            <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Belum Diambil</option>
                            <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Sudah Diambil</option>
                        </select>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="tempat_ditemukan" maxlength="60" value="<?= htmlspecialchars($data['tempat_ditemukan']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kendaraan</label>
                        <input type="text" maxlength="60" name="jenis_kendaraan" value="<?= htmlspecialchars($data['jenis_kendaraan']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomer Plat</label>
                        <input type="text" maxlength="10" name="nomer_plat" value="<?= htmlspecialchars($data['nomer_plat']) ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
                        <?php if (!empty($data['foto_bukti'])): ?>
                            <div class="mb-2">
                                <img src="../uploads/<?= htmlspecialchars($data['foto_bukti']) ?>" alt="Foto saat ini" class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-sm mb-2">Tidak ada foto</p>
                        <?php endif; ?>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto</label>
                        <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <a href="dashboard-view.php" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition font-semibold">Simpan Perubahan</button>
            </div>
        </form>
        <?php } ?>
    </main>
</body>
</html>