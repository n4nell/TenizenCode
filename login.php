<?php
error_reporting(0);
header('Content-Type: application/json');

require_once('connect.php');

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Parameter tidak lengkap"
    ]);
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id_user, username, email, otp FROM user WHERE email = ? AND password = ? LIMIT 1");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    echo json_encode([
        "status" => "success",
        "message" => "login berhasil",
        "otp" => $user['otp'],
        "data" => [
            "iduser" => $user['id_user'],
            "username" => $user['username'],
            "email" => $user['email']
        ]
    ]);

} else {
    echo json_encode([
        "status" => "error",
        "message" => "email atau password salah"
    ]);
}

$stmt->close();
$conn->close();
?>
