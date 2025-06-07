<?php 
session_start();
include '../auth/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM admin WHERE email = '$email' AND password = '$password'");

    $validasi = mysqli_num_rows($data);

    if($validasi > 0) {
        $_SESSION['usernmae'] = $email;
        $_SESSION['status'] = "login";
        echo "<script>alert('Login berhasil!'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Login gagal! Periksa kembali email dan password Anda.'); window.location.href = '../pages/login-view.php';</script>";
    }
}