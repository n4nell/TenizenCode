<?php
require_once('connect.php');

if (isset($_POST['id_produk'])) {
    $idproduk = $_POST['id_produk'];
    $query = mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$idproduk'");
    if ($query) {
    echo "Data produk berhasil dihapus";
    } else {
        echo "Gagal menghapus data produk";
    }
} else {
    echo "Parameter idproduk tidak ada";
}
?>