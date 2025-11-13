<?php 
    require_once('connect.php');

    if (isset($_GET['idtransaksi'])) {
        $idtransaksi = $_GET['idtransaksi'];
    }
    $result = array();

    $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY idtransaksi DESC");
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    echo json_encode(array('result' => $result));
?>