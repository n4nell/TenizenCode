<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nis = $_POST['nis'] ?? '';
    $namasiswa = $_POST['nama_siswa'] ?? '';
    $jk = $_POST['jk'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tanggallahir = $_POST['tanggal_lahir'] ?? '';
    $foto = $_POST['foto'] ?? '';

    if (empty($nis) || empty($namasiswa)) {
        echo json_encode([
            "status" => "error",
            "message" => "NIS dan Nama harus diisi"
        ]);
        exit;
    }

    $uploadDir = "upload/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageData = base64_decode($foto);
    $namafile = "siswa" . $nis . ".jpg";
    $filePath = $uploadDir . $namafile;

    if (file_put_contents($filePath, $imageData) === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyimpan foto"
        ]);
        exit;
    }

    require_once('connect.php');

    $nis = mysqli_real_escape_string($conn, $nis);
    $namasiswa = mysqli_real_escape_string($conn, $namasiswa);
    $jk = mysqli_real_escape_string($conn, $jk);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $tanggallahir = mysqli_real_escape_string($conn, $tanggallahir);

    $sql = "INSERT INTO siswa(nis, nama_siswa, jk, alamat, tanggal_lahir, foto) 
            VALUES ('$nis','$namasiswa','$jk','$alamat','$tanggallahir','$namafile')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyimpan data: " . mysqli_error($conn)
        ]);
    }

    mysqli_close($conn);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Metode request harus POST"
    ]);
}
?>
