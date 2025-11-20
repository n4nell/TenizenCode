<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_POST['nis'];
    $namasiswa = $_POST['nama_siswa'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $tgllahir = $_POST['tanggal_lahir']; 

    $sql = "UPDATE siswa SET nama_siswa='$namasiswa', jk='$jk', alamat='$alamat', tanggal_lahir='$tgllahir' WHERE nis='$nis'";
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}