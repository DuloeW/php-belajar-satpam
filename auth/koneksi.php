<?php
$env = parse_ini_file(__DIR__ . '/../.env');

$host = $env['HOST'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$database = $env['DATABASE'];

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>