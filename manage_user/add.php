<?php 

session_start();
require_once('../db.php');
if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $usertype = $_POST['usertype'];
    $user_status = $_POST['user_status'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    date_default_timezone_set('Asia/Kolkata');
    $timestamp=date("Y-m-d H:i:s");
    if(!isset($errorMsg)){
        $sql = "insert into users(name,email,username,user_type,user_status,password,created_at,updated_at)
                values('".$name."','".$email."','".$username."','".$usertype."','".$user_status."','".$password."', '".$timestamp."', '".$timestamp."')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $successMsg = 'New record added successfully';
            header('Location: index.php');
        }else{
            $errorMsg = 'Error '.mysqli_error($conn);
            echo $errorMsg;
        }
    }
}

?>

