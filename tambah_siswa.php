<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nis = $_POST['nis'];
    $namasiswa = $_POST['namasiswa'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $tanggallahir = $_POST['tanggallahir'];
    $foto_base64 = $_POST['foto'];

    $imageData = base64_decode($foto_base64);

    $namafile = $nis . "_siswa.jpg";

    $filePath = "upload/" . $namafile;

    if (file_put_contents($filePath, $imageData)) {
        require_once('connect.php');

        $sql = "INSERT INTO siswa(nis, namasiswa, jk, alamat, tanggallahir, foto) 
                VALUES ('$nis','$namasiswa','$jk','$alamat','$tanggallahir','$namafile')";

        if (mysqli_query($conn, $sql)) {
            echo "berhasil menyimpan data";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Gagal menyimpan foto";
    }
}
?>