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
    if(($_REQUEST['nm_id'] == "") || ($_REQUEST['nm_ten'] == "") || ($_REQUEST['nm_sdt'] == "") || ($_REQUEST['nm_email'] == "") || ($_REQUEST['nm_matKhau'] == "")){
        //msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2" role="alert">
        Fill All Fields
        </div>';
    }
    else{
        //assigning user value to variable
        $nm_id = $_REQUEST['nm_id'];
        $nm_ten = $_REQUEST['nm_ten'];
        $nm_sdt = $_REQUEST['nm_sdt'];
        $nm_email = $_REQUEST['nm_email'];
        $nm_matKhau = $_REQUEST['nm_matKhau'];
        $nm_link = $_FILES['nm_hinhAnh']['name'];
        $nm_link_temp = $_FILES['nm_hinhAnh']['tmp_name'];
        $link_folder = '../image/nguoimua/'.$nm_link;
        move_uploaded_file($nm_link_temp, $link_folder);

        $sql = "UPDATE nguoiMua SET nm_id = '$nm_id', nm_ten = '$nm_ten', nm_sdt = '$nm_sdt',
                 nm_email = '$nm_email', nm_matKhau = '$nm_matKhau', nm_hinhAnh = '$link_folder'
                  WHERE nm_id = '$nm_id'";
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
    <h3 class="text-center">Cập nhật thông tin khách hàng</h3>

    <?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM nguoiMua WHERE nm_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nm_id">ID</label>
            <input type="text" class="form-control" id="nm_id" name="nm_id" value="<?php if(isset($row['nm_id'])) {echo $row['nm_id']; } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nm_ten">Tên</label>
            <input type="text" class="form-control" id="nm_ten" name="nm_ten" value="<?php if(isset($row['nm_ten'])) {echo $row['nm_ten']; } ?>">
        </div>
        <div class="form-group">
            <label for="nm_sdt">Số điện thoại</label>
            <input type="text" class="form-control" id="nm_sdt" name="nm_sdt" value="<?php if(isset($row['nm_sdt'])) {echo $row['nm_sdt']; } ?>">
        </div>
        <div class="form-group">
            <label for="nm_email">Email</label>
            <input type="text" class="form-control" id="nm_email" name="nm_email" value="<?php if(isset($row['nm_email'])) {echo $row['nm_email']; } ?>">
        </div>
        <div class="form-group">
            <label for="nm_matKhau">Mật khẩu</label>
            <input type="text" class="form-control" id="nm_matKhau" name="nm_matKhau" value="<?php if(isset($row['nm_matKhau'])) {echo $row['nm_matKhau']; } ?>">
        </div>
        <div class="form-group">
            <img src= "<?php 
            if(isset($row['nm_hinhAnh'])){
                echo $row['nm_hinhAnh'];
            }
            ?>"
            alt="" class="img-thumbnail" style="width: 30%;">
            <input type="file" class="form-control" id="nm_hinhAnh" name="nm_hinhAnh" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="khachHang.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)) {echo $msg;} ?>
    </form>


</div>
</div>

<?php 
include('../admin/admininclude/footer.php');
?>