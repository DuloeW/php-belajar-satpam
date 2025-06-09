<?php
include '../auth/koneksi.php';
$id_pencatatan = $_GET['id'];

if (isset($id_pencatatan)) {
    $data = mysqli_query($koneksi, "DELETE FROM pencatatan where id_pencatatan = '$id_pencatatan'");
    if ($data) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='../pages/dashboard-view.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location.href='../pages/dashboard-view.php';</script>";
    }
} 

?>