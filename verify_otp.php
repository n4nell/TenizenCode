<?php
error_reporting(0);
header('Content-Type: application/json');
include 'connect.php';

$email = $_POST['email'];
$otp = $_POST['otp'];

$query = "SELECT * FROM user WHERE email='$email' AND otp='$otp'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["status" => "success", "message" => "OTP valid"]);
} else {
    echo json_encode(["status" => "error", "message" => "OTP salah atau sudah kadaluarsa"]);
}
