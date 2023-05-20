<?php 
if(!isset($_SESSION)){
    session_start();
}
include('../admin/admininclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];
}
else {
    echo "<script>location.href='../index.php';</script>";
}

//update
if(isset($_REQUEST['requpdate'])){
//checkin for empty Fields
    if(($_REQUEST['nv_id'] == "") || ($_REQUEST['nv_ten'] == "")  || ($_REQUEST['nv_email'] == "") || ($_REQUEST['nv_matkhau'] == "")){
        //msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2" role="alert">
        Fill All Fields
        </div>';
    }
    else{
        //assigning user value to variable
        $nv_id = $_REQUEST['nv_id'];
        $nv_ten = $_REQUEST['nv_ten'];
        $nv_email = $_REQUEST['nv_email'];
        $nv_matkhau = $_REQUEST['nv_matkhau'];

        $sql = "UPDATE nhanvien SET nv_id = '$nv_id', nv_ten = '$nv_ten',
                 nv_email = '$nv_email', nv_matkhau = '$nv_matkhau'
                  WHERE nv_id = '$nv_id'";
        if($conn -> Query($sql) == TRUE){
            //below msg display on from submit success
            $msg = '<div class="alert alert-success col-sm-9 ml-5 mt-2" role="alert">
            Updated Successfully
            </div>';
        }
        else {
            $msg = '<div class="alert alert-danger col-sm-9 ml-5 mt-2" role="alert">
            Unable to Update 
            </div>';
        }
    }
}

?>
<div class="col-sm-9 mx-3 jumbotron">
    <h3 class="text-center">Cập nhật thông tin nhân viên</h3>

    <?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM nhanVien WHERE nv_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nv_id">ID</label>
            <input type="text" class="form-control" id="nv_id" name="nv_id" value="<?php if(isset($row['nv_id'])) {echo $row['nv_id']; } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nv_ten">Tên</label>
            <input type="text" class="form-control" id="nv_ten" name="nv_ten" value="<?php if(isset($row['nv_ten'])) {echo $row['nv_ten']; } ?>">
        </div>
        <div class="form-group">
            <label for="nv_email">Email</label>
            <input type="text" class="form-control" id="nv_email" name="nv_email" value="<?php if(isset($row['nv_email'])) {echo $row['nv_email']; } ?>">
        </div>
        <div class="form-group">
            <label for="nv_matkhau">Mật khẩu</label>
            <input type="text" class="form-control" id="nv_matkhau" name="nv_matkhau" value="<?php if(isset($row['nv_matkhau'])) {echo $row['nv_matkhau']; } ?>">
        

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="nhanVien.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)) {echo $msg;} ?>
    </form>


</div>
</div>

<?php 
include('../admin/admininclude/footer.php');
?>