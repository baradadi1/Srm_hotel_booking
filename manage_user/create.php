<?php 

$file_name = "Create Manage User";
include("../templates/header.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold">Create User</h5>
                <a href="index.php" type="button" class="btn btn-outline-danger m-1"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="add.php" method="post">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your username" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="usertype" class="form-label">User Type</label>
                        <select name="usertype" id="usertype" class="form-control my-select" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="Admin">Admin <b>(Master)</b></option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="c_password" placeholder="Retype Password" autocomplete="off" required>
                        <p id="message"></p>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="user_status" class="form-label">User Status</label>
                        <select name="user_status" id="user_status" class="form-control my-select" required>
                            <option value="Active">Active</option>
                            <option value="Suspended">Suspend</option> 
                        </select>
                    </div>
                </div>
                <button type="submit" name="Submit" id="sub_btn" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
    $(document).ready(function(){
        $('#password, #c_password').on('input', function () {
            if ($('#password').val() != '' && $('#c_password').val() != ''){
                if ($('#password').val() == $('#c_password').val()) {
                    $('#message').html('Passwords match').css('color', 'green');
                    $("#sub_btn").attr("disabled", false);
                } else {
                    $('#message').html('Passwords do not match').css('color', 'red');
                    $("#sub_btn").attr("disabled", true);
                }
            }else{
                $("#sub_btn").attr("disabled", true);
            }
        });
        $('#name').on('input', function () {
            var name = $(this).val();
            var words = name.split(' ');
            for (var i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
            }
            $(this).val(words.join(' '));
        });
        $('#username').on('input', function () {
            var username = $(this).val();
            // Remove any whitespace from the username
            username = username.replace(/\s/g, '');
            // Convert username to lowercase
            username = username.toLowerCase();
            $(this).val(username);
        });
    });
</script>
<?php
include("../templates/footer.php");
?>