<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "myside";

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


   
function pre($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
function prexit($arr){
    echo "<pre>";
    print_r($arr);
    exit;
}


    
?>