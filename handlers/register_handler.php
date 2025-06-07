<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../auth/koneksi.php';

function generateRandomIdInt() {
    return rand(100000, 999999);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id_admin = generateRandomIdInt();

    mysqli_query($koneksi, "INSERT INTO admin (id_admin, nama_depan, nama_belakang, email, password) VALUES ('$id_admin', '$nama_depan', '$nama_belakang', '$email', '$password')");

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href = '../pages/login-view.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.location.href = '../pages/register-view.php';</script>";
    }
}
