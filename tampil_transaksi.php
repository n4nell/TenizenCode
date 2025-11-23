<?php 
error_reporting(0);
header('Content-Type: application/json');

require_once('connect.php');

$result = array();

if (isset($_GET['id_transaksi'])) {
    $idtransaksi = $_GET['id_transaksi'];
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$idtransaksi'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
}

while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}

echo json_encode(array('result' => $result));
?>
