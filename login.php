<?php
include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT *FROM user WHERE email='$email' AND password='$password' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    echo json_encode(
        [
            "status" => "success",
            "message" => "login berhasil",
            "otp" => $user['otp'],
            "data" => [
                "iduser" => $user['id_user'],
                "username" => $user['username'],
                "email" => $user['email'],
            ]
        ]
    );
} else {
    echo json_encode([
        "status" => "error",
        "message" => "email atau password salah"
    ]);
}
?>