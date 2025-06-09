<?php 
include '../auth/koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_pencatatan = intval($_POST['id_pencatatan']);
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $no_telp_mhs = mysqli_real_escape_string($koneksi, $_POST['no_telp_mhs']);
    $tempat_ditemukan = mysqli_real_escape_string($koneksi, $_POST['tempat_ditemukan']);
    $jenis_kendaraan = mysqli_real_escape_string($koneksi, $_POST['jenis_kendaraan']);
    $nomer_plat = mysqli_real_escape_string($koneksi, $_POST['nomer_plat']);
    $tgl_pencatatan = mysqli_real_escape_string($koneksi, $_POST['tgl_pencatatan']);
    $status = intval($_POST['status']);

    // Update data di database
    $query = "UPDATE pencatatan SET 
                nama_mhs = '$nama_mhs', 
                no_telp_mhs = '$no_telp_mhs', 
                tempat_ditemukan = '$tempat_ditemukan', 
                jenis_kendaraan = '$jenis_kendaraan', 
                nomer_plat = '$nomer_plat', 
                tgl_pencatatan = '$tgl_pencatatan', 
                status = '$status' 
              WHERE id_pencatatan = $id_pencatatan";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Catatan berhasil diperbarui.'); window.location.href='../pages/dashboard-view.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui catatan: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Metode permintaan tidak valid.'); window.history.back();</script>";
}
?>