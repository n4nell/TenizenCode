<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idproduk = $_POST['id_produk'];
    $namaproduk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $barcodeBase64 = $_POST['barcode'];
    
    $imageData = base64_decode($barcodeBase64);

    $namafile = $idproduk . "produk.jpg";

    $filePath = "uploadproduk/" . $namafile;

    if (file_put_contents($filePath, $imageData)) {
        require_once('connect.php');

        $sql = "INSERT INTO produk(idproduk, namaproduk, jumlah, harga, barcode) VALUES ('$idproduk','$namaproduk','$jumlah','$harga','$namafile')";

        if (mysqli_query($conn, $sql)) {
            echo "berhasil menyimpan data produk";
        } else {
            echo "Gagal menyimpan data produk: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Gagal menyimpan foto";
    }
}
?>