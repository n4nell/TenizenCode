<?php
require_once('connect.php');

if (isset($_POST['nis'])) {
    $nis = $_POST['nis'];

    $query = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");

    if ($query) {
        echo "Data berhasil dihapus";
    } else {
        echo "Gagal menghapus data";
    }
} else {
    echo "Parameter NIS tidak ada";
}
?>