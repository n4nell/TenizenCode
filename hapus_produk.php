<?php
error_reporting(0);
header('Content-Type: application/json');

require_once('connect.php');

if (isset($_POST['id_produk'])) {

    $idproduk = $_POST['id_produk'];

    $check = $conn->prepare("SELECT id_produk FROM produk WHERE id_produk = ?");
    $check->bind_param("s", $idproduk);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM produk WHERE id_produk = ?");
    $stmt->bind_param("s", $idproduk);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data produk berhasil dihapus"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus data produk"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Parameter id_produk tidak ada"]);
}
?>
