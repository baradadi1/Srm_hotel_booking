
<?php 

    require_once('../db.php');
    $data = array();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
    }
    $encryptionKey = bin2hex(random_bytes(16));

    // Function to encrypt the ID
    function encryptID($id, $key) {
        return base64_encode(openssl_encrypt($id, "aes-256-cbc", $key, 0, substr($key, 0, 16)));
    }
?>
<?php 
$file_name = "Manage User";
include("../templates/header.php");
?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                    <a href="create.php" class="btn pb-3 btn-primary">Add</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Username</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($data as $key => $value) {
                                      ?>
                                        <tr>
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"><?=$value['name'] ?></h6>
                                                <!-- <span class="fw-normal">Web Designer</span>                           -->
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?=$value['email'] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                <?=$value['username'] ?>
                                                    <!-- <span class="badge bg-primary rounded-3 fw-semibold">Low</span> -->
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?=$value['user_status'] ?><?php if($value['user_type']=='Admin') {echo " <b>Master Admin</b>";} ?>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="show.php?id=<?php echo encryptID($value['id'],$encryptionKey) ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="edit.php?id=<?php echo encryptID($value['id'],$encryptionKey) ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                                            </td>
                                        </tr>  
                                      <?php
                                    }
                                ?>            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("../templates/footer.php");
?>