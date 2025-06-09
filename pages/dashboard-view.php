<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['usernmae'])) {
    header('Location: ./pages/login-view.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/output.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="flex flex-col lg:flex-row">
        <?php include '../components/sidebar.php'; ?>
        
        <main class="flex-1 p-4 lg:p-8 lg:ml-3">
            <!-- Header -->
            <div class="mb-6 lg:mb-8">
                <h1 class="text-2xl lg:text-4xl font-bold text-gray-800 mb-2">Dashboard</h1>
                <p class="text-gray-600 text-base lg:text-lg">Pencatatan Kehilangan Kunci</p>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 lg:px-6 py-4 border-b">
                    <h2 class="text-lg lg:text-xl font-bold text-gray-800">Pencatatan Terbaru</h2>
                    <p class="text-gray-600 text-xs lg:text-sm">Data kunci yang di temukan</p>
                </div>
                
                <!-- Mobile Cards View -->
                <div class="block lg:hidden">
                    <?php
                    include '../auth/koneksi.php';
                    $data = mysqli_query($koneksi, "SELECT * FROM pencatatan ORDER BY id_pencatatan DESC LIMIT 10");
                    if (!$data) {
                        die("Query Error: " . mysqli_error($koneksi));
                    }
                    $data = mysqli_fetch_all($data, MYSQLI_ASSOC);
                    
                    foreach($data as $index => $row): ?>
                    <div class="border-b border-gray-100 p-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-start">
                                <span class="text-sm font-medium text-gray-500">No. <?= $index + 1 ?></span>
                                <?php 
                                    $status_text = $row['status'] == 0 ? 'Belum Diambil' : 'Sudah Diambil';
                                    $status_color = $row['status'] == 0 ? 'bg-red-800' : 'bg-green-800';
                                ?>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full text-white <?= $status_color ?>">
                                    <?= $status_text ?>
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <span class="text-gray-500">Tanggal:</span>
                                    <span class="block font-medium"><?= $row['tgl_pencatatan'] ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Lokasi:</span>
                                    <span class="block font-medium"><?= $row['tempat_ditemukan'] ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Jenis:</span>
                                    <span class="block font-medium"><?= $row['jenis_kendaraan'] ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Plat:</span>
                                    <span class="block font-medium"><?= $row['nomer_plat'] ?></span>
                                </div>
                            </div>
                            <div class="flex space-x-2 pt-2">
                                <a href="edit-catatan-view.php?id=<?= $row['id_pencatatan'] ?>" class="flex-1 text-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?= $row['id_pencatatan'] ?>" class="flex-1 text-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-xs font-medium" onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Lokasi</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Jenis Kendaraan</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Nomer Plat</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php
                            foreach($data as $index => $row): ?>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= $index + 1 ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row['tgl_pencatatan'] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row['tempat_ditemukan'] ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= $row['jenis_kendaraan'] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row['nomer_plat'] ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <?php 
                                        $status_text = $row['status'] == 0 ? 'Belum Diambil' : 'Sudah Diambil';
                                        $status_color = $row['status'] == 0 ? 'bg-red-800' : 'bg-green-800';
                                    ?>
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full text-white <?= $status_color ?>">
                                        <?= $status_text ?>
                                    </span>
                                </td>
                                <td class="flex px-6 py-4 text-sm space-x-2">
                                    <a href="edit-catatan-view.php?id=<?= $row['id_pencatatan'] ?>" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium">
                                        Edit
                                    </a>
                                    <a href="delete.php?id=<?= $row['id_pencatatan'] ?>" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-xs font-medium" onclick="return confirm('Yakin hapus data ini?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>