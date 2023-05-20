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
    if(($_REQUEST['dm_id'] == "") || ($_REQUEST['dm_ten'] == "") ){
        //msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2" role="alert">
        Fill All Fields
        </div>';
    }
    else{
        //assigning user value to variable
        $dm_id = $_REQUEST['dm_id'];
        $dm_ten = $_REQUEST['dm_ten'];
        $dm_moTa = $_REQUEST['dm_moTa'];


        $sql = "UPDATE danhMuc SET dm_ten = '$dm_ten', dm_moTa = '$dm_moTa' 
                WHERE dm_id = '$dm_id'";
        
        if($conn -> Query($sql) == TRUE){
            //below msg display on from submit success
            $msg = '<div class="alert alert-success col-sm-9 ml-5 mt-2" role="alert">
            Update Successfully
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
    <h3 class="text-center">Chỉnh sửa danh mục</h3>

    <?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM danhMuc WHERE dm_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="dm_id">ID</label>
            <input type="text" class="form-control" id="dm_id" name="dm_id" value="<?php 
            if(isset($row['dm_id'])){
                echo $row['dm_id'];
            }
            ?>" readonly>
        </div>
        <div class="form-group">
            <label for="dm_ten">Tên danh mục</label>
            <input type="text" class="form-control" id="dm_ten" name="dm_ten" value="<?php 
            if(isset($row['dm_ten'])){
                echo $row['dm_ten'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="dm_moTa">Mô tả</label>
            <textarea class="form-control" id="dm_moTa" name="dm_moTa" row="2"
                style="height: 300px;"><?php 
            if(isset($row['dm_moTa'])){
                echo $row['dm_moTa'];
            }?></textarea>        
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="../admin/danhMuc.php" class="btn btn-secondary">Close</a>
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