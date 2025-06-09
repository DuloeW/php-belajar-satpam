<?php 
include '../auth/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $email = $_POST['email'];

    if(isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi password
        if($password !== $confirm_password) {
            echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href = '../pages/profile-view.php';</script>";
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update password di database
        $query = "UPDATE admin SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', email = '$email', password = '$hashed_password' WHERE email = '$email'";
    } else {
        // Jika password tidak diubah, hanya update nama dan email
        $query = "UPDATE admin SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', email = '$email' WHERE email = '$email'";
    }
    
    if(mysqli_query($koneksi, $query)) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location.href = '../pages/profile-view.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil: " . mysqli_error($koneksi) . "'); window.location.href = '../pages/profile-view.php';</script>";
    }
} else {
    echo "<script>alert('Metode permintaan tidak valid!'); window.location.href = '../pages/profile-view.php';</script>";
}


?>