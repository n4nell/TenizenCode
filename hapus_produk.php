<?php
require_once('connect.php');

if (isset($_POST['idproduk'])) {
    $idproduk = $_POST['idproduk'];
    $query = mysqli_query($con, "DELETE FROM produk WHERE idproduk='$idproduk'");

    if ($query) {
        echo "Data produk berhasil dihapus";
    } else {
        echo "Gagal menghapus data produk";
    }
} else {
    echo "Parameter idproduk tidak ada";
}