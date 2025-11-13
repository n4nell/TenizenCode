<?php
    require_once "connect.php";
    
    if($server['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $check = mysqli_query($conn,  "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "Email already exists";
        } else {
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                echo "Registration successful";
            }
            else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }
    else {
        echo "Invalid request";
    }
?>