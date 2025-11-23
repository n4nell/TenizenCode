<?php
header('Content-Type: application/json');

require_once("connect.php");

$sql = "SELECT * FROM siswa";
$res = mysqli_query($conn, $sql);

$result = array();

while ($row = mysqli_fetch_assoc($res)) {

    $foto_path = "upload/" . $row["foto"];
    if (file_exists($foto_path)) {
        $foto_base64 = base64_encode(@file_get_contents($foto_path));
    } else {
        $foto_base64 = ""; 
    }

    $result[] = array(
        "nis" => $row["nis"],
        "namasiswa" => $row["nama_siswa"],    
        "jk" => $row["jk"],
        "alamat" => $row["alamat"],
        "tanggallahir" => $row["tanggal_lahir"],
        "foto" => $foto_base64
    );
}

echo json_encode(array("result" => $result), JSON_UNESCAPED_UNICODE);
?>
