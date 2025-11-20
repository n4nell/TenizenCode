<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "tenizencode";
$conn = mysqli_connect(hostname: $server, username: $user, password: $password, database: $database);

if (mysqli_connect_errno()){
    echo "Gagal terhubung ke database: " .mysqli_connect_error();
}
?>