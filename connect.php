<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "tenizencode";
    $conn = mysqli_connect($server, $user, $pass, $db);

    if(mysqli_connect_error()){
        die("Connection failed: " . mysqli_connect_error());
    }
?>