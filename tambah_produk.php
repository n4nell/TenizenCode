<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $idproduk = $_POST['id_produk'];
    $namaproduk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $barcodeBase64 = $_POST['barcode'];

    $imageData = base64_decode($barcodeBase64);
    $namafile = $idproduk . "_produk.jpg";
    $filePath = "uploadproduk/" . $namafile;

    if (file_put_contents($filePath, $imageData)) {

        require_once('connect.php');

        $sql = "INSERT INTO produk(idproduk, namaproduk, jumlah, harga, barcode) 
                VALUES ('$idproduk', '$namaproduk', '$jumlah', '$harga', '$namafile')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode([
                "status" => "success",
                "message" => "Data produk berhasil disimpan"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal menyimpan data produk"
            ]);
        }

        mysqli_close($conn);

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyimpan barcode"
        ]);
    }
}
?>
