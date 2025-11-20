<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['namasiswa'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggallahir'];
    $foto = $_POST['foto'];

    $imageData = base64_decode($foto);

    $namafile = $nis . "_siswa.jpg";

    $filePath = "upload/" . $namafile;

    if (file_put_contents($filePath, $imageData)) {
        require_once('connect.php');

        $sql = "INSERT INTO siswa(nis, namasiswa, jk, alamat, tanggallahir, foto) VALUES ('$nis','$namasiswa','$jk','$alamat','$tanggallahir','$namafile')";

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