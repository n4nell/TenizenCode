<?php
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nis = $_POST["nis"];
    $namasiswa = $_POST["namasiswa"];
    $jk = $_POST["jk"];
    $alamat = $_POST["alamat"];
    $tanggallahir = $_POST["tanggallahir"];
    $foto_base64 = $_POST["foto"];

    $imageData = base64_decode($foto_base64);
    $namafile = $nis . "_siswa.jpg";
    $filepath = "upload/" . $namafile;

    if (file_put_contents($filepath, $imageData) && isset($foto_base64)) {
        $sql = "UPDATE siswa SET namasiswa='$namasiswa',jk='$jk',alamat='$alamat',tanggallahir='$tanggallahir',foto='$namafile' WHERE nis='$nis'";
    } else {
        $sql = "UPDATE siswa SET namasiswa='$namasiswa',jk='$jk',alamat='$alamat',tanggallahir='$tanggallahir' WHERE nis='$nis'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diubah";
    } else {
        echo "Data gagal diubah";
        mysqli_error($conn);
    }
}
?>