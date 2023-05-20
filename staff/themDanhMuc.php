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

if(isset($_REQUEST['dmSubmitBtn'])){
    // print($_REQUEST);
    //checking fro empty fields
    if(($_REQUEST['dm_ten'] == "") || ($_REQUEST['dm_moTa'] == "") ) {
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2">Vui lòng điền đầy đủ !</div>';
    }
    else{
        $dm_ten = $_REQUEST['dm_ten'];
        $dm_moTa = $_REQUEST['dm_moTa'];


        $sql = "INSERT INTO danhMuc (dm_id, dm_ten, dm_moTa) VALUES (NULL, '$dm_ten', '$dm_moTa');";

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
    <h3 class="text-center">Thêm Danh Mục</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="dm_ten">Tên danh mục</label>
            <input type="text" class="form-control" id="dm_ten" name="dm_ten">
        </div>
        <div class="form-group">
            <label for="dm_moTa">Mô tả</label>
            <textarea class="form-control" id="dm_moTa" name="dm_moTa" row="2"></textarea>        
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="dmSubmitBtn" name="dmSubmitBtn">Submit</button>
            <a href="../staff/courses.php" class="btn btn-secondary">Close</a>
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
include('../staff/staffinclude/footer.php');
?>