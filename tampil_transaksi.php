<?php 
    require_once('connect.php');

    if (isset($_GET['id_transaksi'])) {
        $idtransaksi = $_GET['id_transaksi'];
    }
    $result = array();

    $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    echo json_encode(array('result' => $result));
?>