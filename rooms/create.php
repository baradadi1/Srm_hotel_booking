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

<style>
    .room_image{
        border:1px solid #5D87FF;
        background-color : #fff;
        width: 100%;
        max-widht: 34.37em;
        position: relative;
        margin: 3.12em auto;
        padding: 3.12em 1.25em;
        border-radius : 0.43em;
        /* box-shadow:0.5em 0.5em 0.5em #5d87FF; */
    }
    input[type="file"]{
        display:none;
    }
    .image_label{
        margin: auto;
        display:block;
        padding: 1.12em;
        position: relative;
        background-color : #5d87FF;
        color:#fff;
        font-size:1.12em;
        font-weight:400px;
        text-align:center;
        width:18.75em;
        cursor:pointer;
        border-radius : 0.31em;
    }
    #no-of-files{
        font-weight:400;
        text-align:center;
        margin:1.25em 0 1.87em 0;
    }
</style>
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
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <label for="room_num" class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="room_num" name="room_num" placeholder="Enter Room Number" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
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
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
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
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <label for="cancel_charges" class="form-label">Cancellation Charges</label>
                        <select name="cancel_charges" id="cancel_charges" class="form-control my-select" required>
                            <option value="" disabled selected>Select Cancellation Charges</option>
                            <option value="1">Free Cancellation</option>
                            <option value="2">10% Before 24 Hours</option>
                            <option value="3">No Cancellation Allow</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <label for="tele_no" class="form-label">Telephone Number</label>
                        <input type="text" class="form-control" id="tele_no" name="tele_no" placeholder="Enter Room Telephone Number" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <label for="rent" class="form-label">Rent Per Night</label>
                        <input type="text" class="form-control" id="rent" placeholder="Enter Room Rend Per Night" autocomplete="off" required>
                        <p id="message"></p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <label for="user_status" class="form-label">User Status</label>
                        <select name="user_status" id="user_status" class="form-control my-select" required>
                            <option value="Active">Active</option>
                            <option value="Suspended">Suspend</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3 room_image">
                        <input type="file" name="room_img" id="room_img" multiple>
                        <label for="room_img" class="image_label">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            &nbsp; Choose File To Upload
                        </label>
                        <div id="no-of-files">
                            No Files Choosen
                        </div>
                        <ul id="file-list">

                        </ul>
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
    $(document).ready(function() {
        $('#room_img').change(function() {
            var fileNames = []; 
            for (var i = 0; i < this.files.length; i++) { 
                var fileName = this.files[i].name;
                fileNames.push(fileName);
            } 
            console.log("Uploaded files: " + fileNames.join(', '));
        });
    });
</script>
<?php
include("../templates/footer.php");
?>