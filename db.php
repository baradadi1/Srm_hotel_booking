<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "myside";

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    include ('Location: custom_helper.php');
    
?>