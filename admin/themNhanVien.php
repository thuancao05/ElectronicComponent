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

if(isset($_REQUEST['nvSubmitBtn'])){
    // print($_REQUEST);
    //checking fro empty fields
    if(($_REQUEST['nv_ten'] == "") || ($_REQUEST['nv_email'] == "") || ($_REQUEST['nv_matkhau'] == "") ) {
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2">Vui lòng điền đầy đủ !</div>';
    }
    else{
        $nv_ten = $_REQUEST['nv_ten'];
        $nv_email = $_REQUEST['nv_email'];
        $nv_matkhau = $_REQUEST['nv_matkhau'];


        $sql = "INSERT INTO nhanvien (nv_id, nv_ten, nv_email, nv_matkhau) VALUES (NULL, '$nv_ten', '$nv_email', '$nv_matkhau');";

        if($conn -> query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-9 ml-5 mt-2">Thêm thành công</div>';
        }
        else{
            $msg = '<div class="alert alert-danger col-sm-9 ml-5 mt-2">Lỗi rồi</div>';
        }
    }
}


?>

<div class="col-sm-9 mx-3 jumbotron">
    <h3 class="text-center">Thêm Nhân Viên</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nv_ten">Tên nhân viên</label>
            <input type="text" class="form-control" id="nv_ten" name="nv_ten">
        </div>
        <div class="form-group">
            <label for="nv_moTa">Email</label>
            <input class="form-control" id="nv_email" name="nv_email" ></input>        
        </div>
        <div class="form-group">
            <label for="nv_moTa">Mật khẩu</label>
            <input class="form-control" id="nv_matkhau" name="nv_matkhau"></input>        
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="nvSubmitBtn" name="nvSubmitBtn">Submit</button>
            <a href="../admin/nhanVien.php" class="btn btn-secondary">Close</a>
        </div>
        <?php 
            if(isset($msg)){
                echo $msg;
            }
        ?>
    </form>
</div>

</div>
</div>

<?php 
include('../admin/admininclude/footer.php');
?>