<?php
error_reporting(0);
header('Content-Type: application/json');
require_once('connect.php');

$result = [];

if (isset($_GET['id_produk']) && !empty($_GET['id_produk'])) {
    $idproduk = mysqli_real_escape_string($conn, $_GET['id_produk']);
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk = '$idproduk'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY idproduk DESC");
}

while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}

echo json_encode(["result" => $result]);
?>
