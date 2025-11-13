<?php
require_once('connect.php');
if (isset($_POST['nis'])) {
    $nis = $_POST['nis'];

    $stmt = mysqli_prepare($conn, "DELETE FROM siswa WHERE nis = ?");
    mysqli_stmt_bind_param($stmt, "s", $nis);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil dihapus";
    } else {
        echo "Gagal menghapus data";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "parameter nis tidak ada";
}
?>