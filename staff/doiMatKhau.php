<?php 
if(!isset($_SESSION)){
    session_start();
}
include('../staff/staffinclude/header.php');
include('../dbConnection.php');

    if(isset($_SESSION['is_staff_login'])){
        $staffEmail = $_SESSION['staffLogEmail'];
    }
    else {
        echo "<script>location.href='../index.php';</script>";
    }

    $staffEmail = $_SESSION['staffLogEmail'];  
    if(isset($_REQUEST['staffPassUpdate'])){
        if($_REQUEST['staffPass'] == ""){
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
        }
        else{
            $sql = "SELECT * FROM nhanvien WHERE nv_email = '$staffEmail'";
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                $staffPass = $_REQUEST['staffPass'];
                $sql = "UPDATE nhanvien SET nv_matKhau = '$staffPass' WHERE nv_email = '$staffEmail'";
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
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $staffEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputnewpassword">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="Mật khẩu mới" name="staffPass">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="staffPassUpdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php if(isset($passmsg)) { echo $passmsg;} ?>
            </form>
        </div>
    </div>
</div>