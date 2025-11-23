<?php
error_reporting(0);
header('Content-Type: application/json');

include 'connect.php';

if (isset($_GET['nis'])) {
    $nis = mysqli_real_escape_string($conn, $_GET['nis']);

    $sql = "SELECT * FROM siswa WHERE nis='$nis'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $foto_path = "upload/" . $data["foto"];
        if (file_exists($foto_path)) {
            $fotoBase64 = base64_encode(file_get_contents($foto_path));
        } else {
            $fotoBase64 = null;
        }

        $response = array(
            "nis" => $data['nis'],
            "nama_siswa" => $data['nama_siswa'],
            "jk" => $data['jk'],
            "alamat" => $data['alamat'],
            "tanggal_lahir" => $data['tanggal_lahir'],
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
