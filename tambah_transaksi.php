<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['idproduk'], $_POST['jumlahbeli'], $_POST['total'], $_POST['bayar'], $_POST['kembalian'])) {
            echo 'Data tidak lengkap';
            exit;
        }

    $idproduk = $_POST['idproduk'];
    $jumlahbeli = $_POST['jumlahbeli'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $tanggaltransaksi = !empty($_POST['tanggaltransaksi']) ? $_POST['tanggaltransaksi'] : date("Y-m-d H:i:s");
    
    require_once('connect.php');

    $checkStmt = $conn->prepare("SELECT idproduk FROM produk WHERE idproduk = ?");
    $checkStmt->bind_param("s", $idproduk);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows == 0) {
        echo "Produk dengan ID $idproduk tidak ditemukan.";
        exit;
    }
    $checkStmt->close();

    $stmt = $conn->prepare("INSERT INTO transaksi (idproduk, jumlahbeli, total, bayar, kembalian, tanggaltransaksi) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Gagal mempersiapkan statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssss", $idproduk, $jumlahbeli, $total, $bayar, $kembalian, $tanggaltransaksi);
    if ($stmt->execute()) {
        echo 'Berhasil Menambahkan Transaksi';
    } else {
        echo 'Gagal Menambahkan Transaksi: ' . $stmt->error;
    }
    
    $stmt->close();
    mysqli_close($conn);
    }
?>