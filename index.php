<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <link rel="stylesheet" href="assets/output.css">
</head>
<body>
    <?php include './components/topbar.php' ?>
    <h1 class="text-center mt-15 text-6xl font-bold">Selamat Datang</h1>
    <p class="text-center mt-2 tracking-wider text-lg">Apakah Kunci Anda Hilang Di Motor?</p>

    <div class="flex justify-center items-center mt-8">
        <div class="flex w-full max-w-md gap-2">
            <input class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="search" 
                name="search" 
                id="search" 
                placeholder="Nomor Polisi Motor Anda">
            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Cari
            </button>
        </div>
    </div>

    <main class="max-w-7xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <?php
            include './auth/koneksi.php';
            $data = mysqli_query($koneksi, "SELECT * FROM pencatatan WHERE status = 0");
            while($row = mysqli_fetch_array($data)) {
                $nomer_plat = $row['nomer_plat'];
                $jenis_kendaraan = $row['jenis_kendaraan'];
                $lokasi = $row['tempat_ditemukan'];
                $tgl = $row['tgl_pencatatan'];
                include './components/card.php';
            }
        ?>
    </main>
</body>
</html>