<?php 
session_start();
include '../auth/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = mysqli_query($koneksi, "SELECT * FROM admin WHERE email = '$email'");

    $validasi = mysqli_num_rows($data);

    if($validasi > 0) {
        $row = mysqli_fetch_assoc($data);
        if(password_verify($password, $row['password'])) {
            $_SESSION['username'] = $email;
            $_SESSION['status'] = "login";
            echo "<script>alert('Login berhasil!'); window.location.href = '../pages/dashboard-view.php';</script>";
        } else {
            echo "<script>alert('Login gagal! Password salah!'); window.location.href = '../pages/login-view.php';</script>";
        }
    } else {
        echo "<script>alert('Login gagal! Email tidak ditemukan.'); window.location.href = '../pages/login-view.php';</script>";
    }
}