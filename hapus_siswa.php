<?php
error_reporting(0);
header('Content-Type: application/json');

require_once('connect.php');

if (isset($_POST['nis'])) {

    $nis = $_POST['nis'];

    $check = $conn->prepare("SELECT nis FROM siswa WHERE nis = ?");
    $check->bind_param("s", $nis);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "Data siswa tidak ditemukan"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM siswa WHERE nis = ?");
    $stmt->bind_param("s", $nis);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus data"]);
    }

    $stmt->close();

} else {
    echo json_encode(["status" => "error", "message" => "Parameter NIS tidak ada"]);
}
?>
