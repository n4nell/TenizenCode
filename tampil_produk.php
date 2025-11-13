<?php
require_once('connect.php');
if (isset($_GET['id_produk'])) {
    $idproduk = ($_GET['id_produk']);
}

$result = array();
$query = mysqli_query($conn, "SELECT *FROM produk ORDER BY idproduk DESC");

while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}

echo json_encode(array('result' => $result));
?>