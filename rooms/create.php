<?php 
    require_once('../db.php');
    $room_type = array();
    $air_conditioner = array();
    $room_t_sql = "SELECT * FROM room_type WHERE `status` = 1";
    $result_room_type = mysqli_query($conn, $room_t_sql);
    while($row = mysqli_fetch_assoc($result_room_type)){
        $room_type[] = $row;
    }
    $air_conditioner_sql = "SELECT * FROM air_conditioner WHERE `status` = 1";
    $result_air_conditioner = mysqli_query($conn, $air_conditioner_sql);
    while($row = mysqli_fetch_assoc($result_air_conditioner)){
        $air_conditioner[] = $row;
    }
?>
<?php 
$file_name = "Add Room Details";
include("../templates/header.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold"><?=$file_name ?></h5>
                <a href="index.php" type="button" class="btn btn-outline-danger m-1"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="add.php" method="post">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="room_num" class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="room_num" name="room_num" placeholder="Enter Room Number" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="room_type" class="form-label">Room Type</label>
                        <select name="room_type" id="room_type" class="form-control my-select" required>
                            <option value="" disabled selected>Select Room Type</option>
                            <?php
                                foreach ($room_type as $key => $value) {
                                    echo "<option value='".$value['id']."'>".$value['category']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="air_conditioner" class="form-label">AC/Non AC</label>
                        <select name="air_conditioner" id="air_conditioner" class="form-control my-select" required>
                            <option value="" disabled selected>Select AC/Non AC</option>
                            <?php
                                foreach ($air_conditioner as $key => $value) {
                                    echo "<option value='".$value['id']."'>".$value['category']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="cancel_charges" class="form-label">Cancellation Charges</label>
                        <select name="cancel_charges" id="cancel_charges" class="form-control my-select" required>
                            <option value="" disabled selected>Select Cancellation Charges</option>
                            <option value="1">Free Cancellation</option>
                            <option value="2">10% Before 24 Hours</option>
                            <option value="3">No Cancellation Allow</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="tele_no" class="form-label">Telephone Number</label>
                        <input type="text" class="form-control" id="tele_no" name="tele_no" placeholder="Enter Room Telephone Number" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6 mb-3">
                        <label for="rent" class="form-label">Rent Per Night</label>
                        <input type="text" class="form-control" id="rent" placeholder="Enter Room Rend Per Night" autocomplete="off" required>
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