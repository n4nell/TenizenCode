<?php
header('Content-Type: application/json');
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        echo json_encode(["status" => "error", "message" => "Email sudah terdaftar"]);
    } else {
        $sql = "INSERT INTO user(username,email,password) VALUES('$username','$email','$password')";
        if(mysqli_query($conn, $sql)){
            echo json_encode(["status" => "success", "message" => "User berhasil dibuat"]);
        } else {
            echo json_encode(["status" => "error", "message" => "User gagal dibuat"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
