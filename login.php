<?php
header(header: 'Content-Type: application/json');
error_reporting(0);
include 'connect.php';
$email = $_POST['email'];
$pasword = password_hash($_POST['password']);

$sql = "SELECT * FROM user WHERE email='$email'AND password='$pasword'LIMIT 1";
$result = mysqli_query(mysql: $conn, query: $sql);

if (mysqli_num_rows($result) >0 ){
    echo json_encode(
        value: [
            "status" => "success",
            "message" => "login berhasil",
            "data" => [
                "data" => $user ['id'],
                "username" => $user ['username'],
                "email" => $user ['email'],
            ]
        ]    
            );
}else {
    echo json_encode(
        value: [
            "status" => "error",
            "message" => "login gagal, periksa email dan password anda"
        ]
    );
}