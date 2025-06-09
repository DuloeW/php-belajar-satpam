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
    
    <!-- Search Form -->
    <div class="flex justify-center items-center mt-8 px-4">
        <div class="w-full max-w-2xl">
            <form method="GET" action="" class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <input class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base"
                       type="text"
                       name="search"
                       id="search"
                       maxlength="10"
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                       placeholder="Nomor Polisi Motor Anda">
                
                <div class="flex gap-2 sm:gap-3">
                    <button type="submit" class="flex-1 sm:flex-none px-4 sm:px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm sm:text-base font-medium">
                        Cari
                    </button>
                    
                    <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                        <a href="?" class="flex-1 sm:flex-none px-4 sm:px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 text-sm sm:text-base font-medium text-center">
                            Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results Info -->
    <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
        <div class="text-center mt-4">
            <p class="text-gray-600">Hasil pencarian untuk: "<strong><?php echo htmlspecialchars($_GET['search']); ?></strong>"</p>
        </div>
    <?php endif; ?>

    <main class="max-w-7xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <?php
        include './auth/koneksi.php';
        
        // Base query
        $query = "SELECT * FROM pencatatan WHERE status = 0";
        
        // Add search condition if search parameter exists
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = mysqli_real_escape_string($koneksi, $_GET['search']);
            $query .= " AND nomer_plat LIKE '%$search%'";
        }
        
        // Order by latest first
        $query .= " ORDER BY tgl_pencatatan DESC";
        
        $data = mysqli_query($koneksi, $query);
        $total_results = mysqli_num_rows($data);
        
        if($total_results > 0) {
            while($row = mysqli_fetch_array($data)) {
                $nomer_plat = $row['nomer_plat'];
                $jenis_kendaraan = $row['jenis_kendaraan'];
                $lokasi = $row['tempat_ditemukan'];
                $tgl = $row['tgl_pencatatan'];
                include './components/card.php';
            }
        } else {
            echo '<div class="col-span-full text-center py-8">';
            if(isset($_GET['search']) && !empty($_GET['search'])) {
                echo '<p class="text-gray-500 text-lg">Tidak ada kendaraan dengan nomor plat "' . htmlspecialchars($_GET['search']) . '" yang ditemukan.</p>';
                echo '<p class="text-gray-400 mt-2">Coba periksa kembali ejaan nomor plat atau gunakan kata kunci yang berbeda.</p>';
            } else {
                echo '<p class="text-gray-500 text-lg">Belum ada data kendaraan yang tercatat.</p>';
            }
            echo '</div>';
        }
        ?>
    </main>

    <!-- Results Summary -->
    <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
        <div class="text-center py-4">
            <p class="text-sm text-gray-500">
                Menampilkan <?php echo $total_results; ?> hasil
                <?php if($total_results > 0): ?>
                    dari pencarian "<?php echo htmlspecialchars($_GET['search']); ?>"
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
</body>
</html>