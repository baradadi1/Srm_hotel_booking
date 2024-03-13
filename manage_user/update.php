<?php 

    require_once('../db.php');
    if(isset($_POST['Submit'])){
        $id = $_POST['id'];
        $sql = "select * from users where id=".$id;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }else{
            $errorMsg = 'Could not Find Any Record';
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $user_status = $_POST['user_status'];
        $user_type = $_POST['usertype'];
        if($_POST['password']!=''){
          $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
          $password=$row['password'];
        } 
        date_default_timezone_set('Asia/Kolkata');
        $timestamp=date("Y-m-d H:i:s");

        if(!isset($errorMsg)){
            echo $sql = "UPDATE `users` SET `name`='".$name."',`email`='".$email."',`username`='".$username."',`password`='".$password."',`user_status`='".$user_status."',`user_type`='".$user_type."',`updated_at`='".$timestamp."'WHERE id='".$id."'";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $successMsg = 'New record updated successfully';
                header('Location:index.php');
            }else{
                $errorMsg = 'Error '.mysqli_error($conn);
                echo $errorMsg;
            }
        }
    }
?>