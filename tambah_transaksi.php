<?php
error_reporting(0);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $required = ['id_produk', 'jumlah_beli', 'total', 'bayar', 'kembalian'];
    foreach ($required as $field) {
        if (!isset($_POST[$field])) {
            echo json_encode(["status" => "error", "message" => "Data $field tidak lengkap"]);
            exit;
        }
    }

    $idproduk       = $_POST['id_produk'];
    $jumlahbeli     = $_POST['jumlah_beli'];
    $total          = $_POST['total'];
    $bayar          = $_POST['bayar'];
    $kembalian      = $_POST['kembalian'];
    $tanggal        = !empty($_POST['tanggal_transaksi']) 
                        ? $_POST['tanggal_transaksi'] 
                        : date("Y-m-d H:i:s");

    require_once('connect.php');

    $check = $conn->prepare("SELECT idproduk FROM produk WHERE idproduk = ?");
    $check->bind_param("s", $idproduk);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "ID produk tidak ditemukan"]);
        exit;
    }
    $check->close();

    $stmt = $conn->prepare("
        INSERT INTO transaksi (id_produk, jumlah_beli, total, bayar, kembalian, tanggal_transaksi)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => $conn->error]);
        exit;
    }

    $stmt->bind_param(
        "siiiss",
        $idproduk,
        $jumlahbeli,
        $total,
        $bayar,
        $kembalian,
        $tanggal
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Transaksi berhasil ditambahkan"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    mysqli_close($conn);
}
?>
