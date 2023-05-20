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

    $adminEmail = $_SESSION['adminLogEmail'];  
    if(isset($_REQUEST['adminPassUpdate'])){
        if($_REQUEST['adminPass'] == ""){
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
        }
        else{
            $sql = "SELECT * FROM nguoiBan WHERE nb_email = '$adminEmail'";
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                $adminPass = $_REQUEST['adminPass'];
                $sql = "UPDATE nguoiBan SET nb_matKhau = '$adminPass' WHERE nb_email = '$adminEmail'";
                if($conn -> query($sql) == TRUE){
                    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Cập nhật thành công</div>';
                }
                else{
                    $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Thất bại</div>'; 
                }
            }
        }        
    }

?>

<div class="col-sm-9 mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form method="POST" action="" class="mt-5 mx-5">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $adminEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputnewpassword">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="Mật khẩu mới" name="adminPass">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="adminPassUpdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php if(isset($passmsg)) { echo $passmsg;} ?>
            </form>
        </div>
    </div>
</div>