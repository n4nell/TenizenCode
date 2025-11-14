<?php
ob_clean();
require_once "connect.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'] ?? '';
    $password = md5($_POST['password'] ?? '');

    if ($email == '' || $password == '') {
        echo json_encode([
            "status" => "error",
            "message" => "Email and password are required"
        ]);
        exit;
    }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Email already exists"
        ]);
        exit;
    }

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $query)) {
        echo json_encode([
            "status" => "success",
            "message" => "Registration successful"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database error"
        ]);
    }

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request"
    ]);
}
?>