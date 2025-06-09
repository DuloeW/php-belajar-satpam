<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../pages/login-view.php');
    exit();
}


include '../auth/koneksi.php';
$email = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE email = '$email'");
$user_data = mysqli_fetch_assoc($query);

// Jika tidak ada data, gunakan default
if (!$user_data) {
    $user_data = [
        'nama_depan' => 'John',
        'nama_belakang' => 'Doe',
        'email' => 'john.doe@example.com'
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/output.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col lg:flex-row">
        <?php include '../components/sidebar.php'; ?>
        
        <main class="flex-1 p-4 md:p-6 lg:p-8">
            <!-- Header -->
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800">
                    Profile Saya
                </h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Kelola informasi akun Anda.</p>
            </div>

            <div class="max-w-6xl mx-auto space-y-6 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8 text-center">
                        <!-- Avatar dengan inisial -->
                        <div class="mx-auto w-20 h-20 md:w-24 md:h-24 mb-4 md:mb-6 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-2xl md:text-3xl font-bold text-white">
                                <?= strtoupper(substr($user_data['nama_depan'], 0, 1) . substr($user_data['nama_belakang'], 0, 1)) ?>
                            </span>
                        </div>
                        
                        <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-1">
                            <?= htmlspecialchars($user_data['nama_depan'] . ' ' . $user_data['nama_belakang']) ?>
                        </h2>
                        <p class="text-gray-500 text-sm break-all"><?= htmlspecialchars($user_data['email']) ?></p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                        <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-4 md:mb-6">Informasi Personal</h3>
                        
                        <form action="../handlers/update_profile_handler.php" method="POST" class="space-y-4 md:space-y-5">
                            <!-- Nama Depan & Belakang -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5">
                                <div>
                                    <label for="nama_depan" class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                                    <input type="text" 
                                           id="nama_depan"
                                           name="nama_depan" 
                                           maxlength="30"
                                           value="<?= htmlspecialchars($user_data['nama_depan']) ?>"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           required>
                                </div>
                                
                                <div>
                                    <label for="nama_belakang" class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                                    <input type="text" 
                                           id="nama_belakang"
                                           name="nama_belakang" 
                                           maxlength="30"
                                           value="<?= htmlspecialchars($user_data['nama_belakang']) ?>"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" 
                                       id="email"
                                       name="email" 
                                       value="<?= htmlspecialchars($user_data['email']) ?>"
                                       class="w-full border text-gray-500 border-gray-500 rounded-lg px-3 py-2 text-sm md:text-base"
                                       readonly>
                                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" 
                                       id="password"
                                       name="password" 
                                       maxlength="8"
                                       placeholder="Kosongkan jika tidak ingin mengubah"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                <input type="password" 
                                       id="confirm_password"
                                       name="confirm_password" 
                                       maxlength="8"
                                       placeholder="Konfirmasi password baru"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-col gap-3 pt-4">
                                <button type="submit" 
                                        class="w-full sm:flex-1 lg:flex-none bg-blue-600 text-white py-3 px-5 rounded-lg font-medium text-sm md:text-base hover:bg-blue-700 transition duration-150 ease-in-out">
                                    Simpan Perubahan
                                </button>
                                
                                <button type="button" 
                                        onclick="history.back()"
                                        class="w-full sm:flex-1 lg:flex-none border border-gray-300 text-gray-700 py-2.5 px-5 rounded-lg font-medium text-sm md:text-base hover:bg-gray-50 transition duration-150 ease-in-out">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>