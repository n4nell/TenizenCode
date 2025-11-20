<?php
require_once 'connect.php';
if ($server['REQUEST_METHOD']=="POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5(string: $_POST['password']);

    $check = mysqli_query(mysql: $conn, query: "SELECT * FROM user WHERE email='$email'");

    if (mysqli_num_rows(result: $check) > 0){
        echo "email sudah terdaftar";
    }else {
        $sql = "INSERT INTO user(username, email, password) values('$username', '$email', '$password')";
        if(mysqli_query(mysql: $conn, query: $sql)){
            echo "user berhasil dibuat";
        }else {
            echo "user gagal dibuat";
        }
    }
}else{
    echo "Invalid request";
}
?>