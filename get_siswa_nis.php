<?php
include 'connect.php';

if (isset($_GET['nis'])) {
    $nis = mysqli_real_escape_string($conn, $_GET['nis']);

    $sql = "SELECT * FROM siswa WHERE nis='$nis'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $fotoBase64 = $data['foto'];

        $response = array(
            "nis" => $data['nis'],
            "namasiswa" => $data['namasiswa'],
            "jk" => $data['jk'],
            "alamat" => $data['alamat'],
            "tgllahir" => $data['tanggallahir'],
            "foto" => $fotoBase64
        );
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "Data tidak ditemukan"]);
    }
} else {
    echo json_encode(["error" => "Parameter NIS tidak dikirim"]);
}
?>