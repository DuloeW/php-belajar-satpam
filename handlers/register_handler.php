<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../auth/koneksi.php';

$env = parse_ini_file(__DIR__ . '/../.env');

function generateRandomIdInt() {
    return rand(100000, 999999);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $email = $_POST['email'];
    $password = hashPassword($_POST['password']);
    $id_admin = generateRandomIdInt();
    $register_key = $_POST['register_key'];

    if($register_key !== $env['KEY_REGISTER']) {
        echo "<script>alert('Security key tidak valid!'); window.location.href = '../pages/register-view.php';</script>";
        exit();
    }

    if(isEmailRegistered($email)) {
        echo "<script>alert('Email sudah terdaftar!'); window.location.href = '../pages/register-view.php';</script>";
        exit();
    }

    mysqli_query($koneksi, "INSERT INTO admin (id_admin, nama_depan, nama_belakang, email, password) VALUES ('$id_admin', '$nama_depan', '$nama_belakang', '$email', '$password')");

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href = '../pages/login-view.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.location.href = '../pages/register-view.php';</script>";
    }
}

function isEmailRegistered($email) {
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE email = '$email'");
    return mysqli_num_rows($query) > 0;
}


function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
