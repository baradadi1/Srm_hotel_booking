<?php 

require_once('../db.php');

ini_set('memory_limit', '-1');
ini_set("max_execution_time", 0);
ini_set('display_errors', 1);

$encryptionKey = bin2hex(random_bytes(16)); 
function decryptID($encryptedID, $key) {
    return openssl_decrypt(base64_decode($encryptedID), "aes-256-cbc", $key, 0, substr($key, 0, 16));
}

// prexit($_GET);

echo $decryptedID = decryptID($_GET['id'], $encryptionKey);



$data = array();
$sql = "SELECT * FROM users WHERE id".$decryptedID;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }
}
?>
<?php 
    $file_name = "Edit Manage User";
    include("../templates/header.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold">Show User</h5>
                <a href="index.php" type="button" class="btn btn-outline-danger m-1"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="update.php" method="post">
                <div class="row">
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" autocomplete="off" value="<?=$data['name']?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" autocomplete="off" value="<?=$data['email']?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your username" autocomplete="off" value="<?=$data['username']?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="usertype" class="form-label">User Type</label>
                        <select name="usertype" id="usertype" class="form-control my-select" disabled >
                            <option value="" disabled selected>Select User Type</option>
                            <option value="Admin" <?php if($data['user_type'] == 'Admin'){echo "selected";} ?>>Admin <b>(Master)</b></option>
                            <option value="User" <?php if($data['user_type'] == 'User'){echo "selected";} ?>>User</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="user_status" class="form-label">User Status</label>
                        <select name="user_status" id="user_status" class="form-control my-select" disabled>
                            <option value="Active" <?php if($data['user_status'] == 'Active'){echo "selected";} ?>>Active</option>
                            <option value="Suspended" <?php if($data['user_status'] == 'Suspended'){echo "selected";} ?>>Suspend</option> 
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

</script>
<?php
include("../templates/footer.php");
?>