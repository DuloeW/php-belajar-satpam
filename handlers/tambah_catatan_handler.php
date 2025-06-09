<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Letakkan session_start() di bagian paling atas script untuk memastikan sesi dimulai dengan benar.
session_start();
include '../auth/koneksi.php';

// Fungsi ini tidak perlu diubah, sudah baik.
function generateRandomIdInt() {
    return rand(100000, 999999);
}

function getidAdmin() {
    global $koneksi;
    // Panggil session_start() di awal script, bukan di dalam fungsi.
    if (!isset($_SESSION['username'])) {
        // Jika tidak ada sesi username, kembalikan null atau handle error
        return null;
    }
    $email = $_SESSION['username'];
    $data = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE email = '$email'");
    if ($data && mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);
        return $row['id_admin'];
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $no_telp_mhs = mysqli_real_escape_string($koneksi, $_POST['no_telp_mhs']);
    $tempat_ditemukan = mysqli_real_escape_string($koneksi, $_POST['tempat_ditemukan']);
    $jenis_kendaraan = mysqli_real_escape_string($koneksi, $_POST['jenis_kendaraan']);
    $nomer_plat = mysqli_real_escape_string($koneksi, $_POST['nomer_plat']);
    $tgl_pencatatan = mysqli_real_escape_string($koneksi, $_POST['tgl_pencatatan']);
    $id_pencatatan = generateRandomIdInt();
    $nomer_pencatatan = substr(uniqid('', true), 0, 15); // Generate unique ID dengan panjang 15 karakter
    $id_admin = getidAdmin();
    $status = 0;

    // Pastikan admin ditemukan sebelum melanjutkan
    if ($id_admin === null) {
        echo "<script>alert('Sesi admin tidak valid atau telah berakhir. Silakan login kembali.'); window.history.back();</script>";
        exit;
    }
    
    // Handle file upload
    if (isset($_FILES['foto_bukti']) && $_FILES['foto_bukti']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 10 * 1024 * 1024; // 10MB
        
        $file_tmp = $_FILES['foto_bukti']['tmp_name'];
        $file_info = new finfo(FILEINFO_MIME_TYPE);
        $file_type = $file_info->file($file_tmp); // Verifikasi tipe MIME dari konten file, lebih aman
        $file_size = $_FILES['foto_bukti']['size'];
        
        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Hanya file gambar (JPEG, PNG, GIF) yang diizinkan.'); window.history.back();</script>";
            exit;
        }
        
        if ($file_size > $max_size) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 10MB.'); window.history.back();</script>";
            exit;
        }
        
        $file_extension = pathinfo($_FILES['foto_bukti']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $file_extension;
        
        $target_dir = '../uploads/';
        $target_file = $target_dir . $unique_name;
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        if (move_uploaded_file($file_tmp, $target_file)) {
            // PERBAIKAN UTAMA ADA DI SINI
            // 1. Nama kolom di query (no_pencatatan) harus sesuai dengan variabel.
            // 2. Jumlah tipe data di bind_param harus sesuai dengan jumlah variabel (10).
            // 3. Tipe data harus benar (i untuk integer, s untuk string).
            
            $query = "INSERT INTO pencatatan (id_pencatatan, no_pencatatan, nama_mhs, no_telp_mhs, tempat_ditemukan, jenis_kendaraan, nomer_plat, foto_bukti, tgl_pencatatan, status,  id_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "issssssssii", $id_pencatatan, $nomer_pencatatan, $nama_mhs, $no_telp_mhs, $tempat_ditemukan, $jenis_kendaraan, $nomer_plat, $unique_name, $tgl_pencatatan, $status, $id_admin);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Catatan berhasil disimpan!'); window.location.href='../pages/dashboard-view.php';</script>";
                } else {
                    unlink($target_file); // Hapus file jika insert ke DB gagal
                    // Tambahkan mysqli_stmt_error untuk melihat error spesifik dari database
                    echo "<script>alert('Error: Gagal menyimpan data ke database. " . mysqli_stmt_error($stmt) . "'); window.history.back();</script>";
                }
                mysqli_stmt_close($stmt);
            } else {
                unlink($target_file); // Hapus file jika prepare query gagal
                // Tambahkan mysqli_error untuk melihat error spesifik dari koneksi
                echo "<script>alert('Error: Gagal mempersiapkan query. " . mysqli_error($koneksi) . "'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah foto bukti. Periksa hak akses folder `uploads`.'); window.history.back();</script>";
        }
    } else {
        $error_message = "Foto bukti tidak ditemukan atau terjadi error saat unggah.";
        if (isset($_FILES['foto_bukti']['error'])) {
            switch ($_FILES['foto_bukti']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $error_message = "Ukuran file yang diunggah melebihi batas yang diizinkan.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $error_message = "Tidak ada file yang dipilih untuk diunggah.";
                    break;
                default:
                    $error_message = "Terjadi error yang tidak diketahui saat mengunggah file.";
                    break;
            }
        }
        echo "<script>alert('$error_message'); window.history.back();</script>";
    }
}
?>