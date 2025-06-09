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
    <title>Buat Catatan Baru</title>
    <link rel="stylesheet" href="../assets/output.css">
</head>
<body class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <?php include '../components/sidebar.php'; ?>  
    
    <div class="flex-1 p-4 sm:p-6 lg:p-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-6 sm:mb-8">Buat Catatan Baru</h2>
            
            <form action="../handlers/tambah_catatan_handler.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div class="mb-4 sm:mb-6">
                        <label for="nama_mhs" class="block mb-2 font-semibold text-gray-700">Nama Mahasiswa:</label>
                        <input type="text" id="nama_mhs" name="nama_mhs" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label for="no_telp_mhs" class="block mb-2 font-semibold text-gray-700">No. Telepon:</label>
                        <input type="tel" id="no_telp_mhs" name="no_telp_mhs" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label for="tempat_ditemukan" class="block mb-2 font-semibold text-gray-700">Tempat Ditemukan:</label>
                        <input type="text" id="tempat_ditemukan" name="tempat_ditemukan" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label for="jenis_kendaraan" class="block mb-2 font-semibold text-gray-700">Jenis Kendaraan:</label>
                        <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Contoh: Honda Vario, Yamaha NMAX, dll" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label for="nomer_plat" class="block mb-2 font-semibold text-gray-700">Nomor Plat:</label>
                        <input type="text" id="nomer_plat" name="nomer_plat" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label for="tgl_pencatatan" class="block mb-2 font-semibold text-gray-700">Tanggal Pencatatan:</label>
                        <input type="date" id="tgl_pencatatan" name="tgl_pencatatan" required 
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base">
                    </div>
                </div>

                <div class="mb-6 sm:mb-8 col-span-full">
                    <label for="foto_bukti" class="block mb-2 font-semibold text-gray-700">Foto Bukti:</label>
                    <input type="file" id="foto_bukti" name="foto_bukti" accept="image/*" required 
                           class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <button type="submit" 
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 sm:px-8 rounded-md transition duration-200 text-sm sm:text-base">
                        Simpan Catatan
                    </button>
                    <button type="reset" 
                            class="w-full sm:w-auto bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 sm:px-8 rounded-md transition duration-200 text-sm sm:text-base">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>