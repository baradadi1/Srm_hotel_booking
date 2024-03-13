<?php

require_once('../db.php');
if(isset($_POST['submit'])){
    $username = $password = "";
    $username_err = $password_err = "";

    $suspend_err="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["username"])){
            $username_err = "Please enter username.";
        } else{
            $username = $_POST["username"];
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = $_POST["password"];
        }
        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT id, username, password,name,email,user_type,user_status FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password,$name,$email,$user_type,$user_status);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password))
                            {
    
                                //check is user is suspend or not
                                if($user_status=='Active') // if not suspend
                                {
                                        // Password is correct, so start a new session
                                        session_start();
                                        
                                        // Store data in session variables
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
    
                                        
                                       //this variables have user id to store in all table when create & update record
                                        $_SESSION["username"] = $id;
    
                                        //this variblae have username
                                        $_SESSION["user_name"] = $username;
    
    
                                         //this users details
                                        $_SESSION["name"] = $name;
                                        $_SESSION["email"] = $email;
                                        $_SESSION["user_type"] = $user_type;
                                        
                                        
                                        // Redirect user to welcome page
                                        header("location: ../pages/index.php");
                                }
                                else // if suspend
                                {
                                    $suspend_err = "This Account is Suspended...";
                                }
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{ 
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    mysqli_close($conn);
}
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="container">
            <div class="row justify-content-center w-100">
                <div class="col-sm-4 col-sm-4 col-lg-6">
                    <div class="card mb-0">
                    <div class="card-body">
                        <a href="../pages/index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                        </a>
                        <p class="text-center">Your Social Campaigns</p>
                        <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="sumbit" name="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                            <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>