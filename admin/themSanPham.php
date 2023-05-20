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


if(isset($_REQUEST['spSubmitBtn'])){
    //checking fro empty fields
    if(($_REQUEST['sp_ten'] == "") || ($_REQUEST['sp_moTa'] == "") || ($_REQUEST['sp_gia'] == "")
            || ($_REQUEST['sp_giaGoc'] == "") ) {
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2">Fill All Fields</div>';
    }
    else{
        
        $dm_id = $_REQUEST['dm_id'];
        $sp_ten = $_REQUEST['sp_ten'];
        $sp_soLuong = $_REQUEST['sp_soLuong'];
        $sp_moTa = $_REQUEST['sp_moTa'];
        $sp_giaGoc = $_REQUEST['sp_giaGoc'];
        $sp_gia =  $_REQUEST['sp_gia'];
        $sp_nsx = $_REQUEST['sp_nsx'];
        $lesson_link = $_FILES['sp_hinhAnh']['name'];
        $lesson_link_temp = $_FILES['sp_hinhAnh']['tmp_name'];
        $link_folder = '../image/sanpham/'.$lesson_link;
        move_uploaded_file($lesson_link_temp, $link_folder);

        $sql = "INSERT INTO sanPham (sp_id, sp_ten, sp_soLuong, sp_moTa, sp_giaGoc,sp_gia, sp_nsx, sp_hinhAnh,dm_id)
                 VALUES (NULL, '$sp_ten', '$sp_soLuong', '$sp_moTa', '$sp_giaGoc', '$sp_gia', '$sp_nsx', '$link_folder', '$dm_id');";

        if($conn -> query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-9 ml-5 mt-2">Thêm sản phẩm thành công</div>';
        }
        else{
            $msg = '<div class="alert alert-danger col-sm-9 ml-5 mt-2">Thất bại</div>';
        }
    }
}


?>




<div class="col-sm-9 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Thêm sản phẩm mới</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="danhMuc">Danh mục <hr></label>
        <select name="dm_id" class="form-group">
            
            <?php 
                $sql = "Select * FROM danhMuc";
                $query = $conn->query($sql);
                $num = $query -> num_rows;
                if($num > 0){
                    while($row = $query -> fetch_assoc()){
                
            ?>
            <option value="<?php echo $row['dm_id'] ?>"><?php echo $row['dm_ten'] ?></option>

            <?php 
                    }
                }
            ?>
        </select>
        <div class="form-group">
            <label for="sp_ten">Tên sản phẩm</label>
            <textarea class="form-control" id="sp_ten" name="sp_ten" row="2"></textarea>        
        </div>
        <div class="form-group">
            <label for="sp_soLuong">Số lượng</label>
            <input type="text" class="form-control" id="sp_soLuong" name="sp_soLuong">
        </div>
        <div class="form-group">
            <label for="sp_moTa">Mô tả sản phẩm</label>
            <input type="text" class="form-control" id="sp_moTa" name="sp_moTa">
        </div>
        <div class="form-group">
            <label for="sp_giaGoc">Giá gốc</label>
            <input type="text" class="form-control" id="sp_giaGoc" name="sp_giaGoc">
        </div>
        <div class="form-group">
            <label for="sp_gia">Giá khuyến mãi</label>
            <input type="text" class="form-control" id="sp_gia" name="sp_gia">
        </div>
        <?php 
         $date = date("Y-m-d");
         echo' <div class="form-group">
                <label for="sp_nsx">Ngày sản xuất</label>
                <input type="date" class="form-control" id="sp_nsx" name="sp_nsx" value ='.$date.' >
            </div>';
        ?>            
        <div class="form-group">
            <label for="sp_hinhAnh">Hình ảnh</label>
            <input type="file" class="form-control-file" id="sp_hinhAnh" name="sp_hinhAnh">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="spSubmitBtn" name="spSubmitBtn">Submit</button>
            <a href="../admin/sanPham.php" class="btn btn-secondary">Close</a>
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