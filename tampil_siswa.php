<?php
require_once("connect.php");

$sql = "SELECT * FROM siswa";
$res = mysqli_query($conn, $sql);
$result = array();

$base_url = "http://localhost/tenizencode/upload/";

while ($row = mysqli_fetch_assoc($res)) {
    $foto_url = !empty($row["foto"]) ? $base_url . $row["foto"] : $base_url . "default.jpg";

    $result[] = array(
        "nis" => $row["nis"],
        "namasiswa" => $row["namasiswa"],
        "jk" => $row["jk"],
        "alamat" => $row["alamat"],
        "tanggallahir" => $row["tanggallahir"],
        "foto" => $foto_url
    );
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(array("result" => $result), JSON_PRETTY_PRINT);
?>