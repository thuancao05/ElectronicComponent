<?php 
if(!isset($_SESSION)){
    session_start();
}
include('../staff/staffinclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_staff_login'])){
    $aspinEmail = $_SESSION['staffLogEmail'];
}
else {
    echo "<script>location.href='../index.php';</script>";
}

//update
if(isset($_REQUEST['requpdate'])){
    if(($_REQUEST['sp_ten'] == "") || ($_REQUEST['sp_moTa'] == "") || ($_REQUEST['sp_gia'] == "")
        || ($_REQUEST['sp_giaGoc'] == "") ) {
        $msg = '<div class="alert alert-warning col-sm-9 ml-5 mt-2">Fill All Fields</div>';
    }
    else{

    $dm_id = $_REQUEST['dm_id'];
    $sp_ten = $_REQUEST['sp_ten'];
    $sp_id = $_REQUEST['sp_id'];
    $sp_soLuong = $_REQUEST['sp_soLuong'];
    $sp_moTa = $_REQUEST['sp_moTa'];
    $sp_giaGoc = $_REQUEST['sp_giaGoc'];
    $sp_gia =  $_REQUEST['sp_gia'];
    $sp_nsx = $_REQUEST['sp_nsx'];
    $product_link = $_FILES['sp_hinhAnh']['name'];
    $product_link_temp = $_FILES['sp_hinhAnh']['tmp_name'];
    $link_folder = '../image/sanpham/'.$product_link;
    move_uploaded_file($product_link_temp, $link_folder);

    $sql = "UPDATE sanPham SET sp_ten = '$sp_ten', sp_soLuong = '$sp_soLuong', sp_moTa = '$sp_moTa'
            , sp_giaGoc = '$sp_giaGoc',sp_gia = '$sp_gia', sp_nsx = '$sp_nsx', sp_hinhAnh = '$link_folder'
            ,dm_id = '$dm_id' WHERE sp_id = '$sp_id';";

    if($conn -> query($sql) == TRUE){
        $msg = '<div class="alert alert-success col-sm-9 ml-5 mt-2">Thêm sản phẩm thành công</div>';
    }
    else{
        $msg = '<div class="alert alert-danger col-sm-9 ml-5 mt-2">Thất bại</div>';
    }
    }
}
?>
<div class="col-sm-9 mx-3 jumbotron">
    <h3 class="text-center">Chỉnh sửa sản phẩm</h3>

    <?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM sanPham WHERE sp_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="sp_id">ID</label>
            <input type="text" class="form-control" id="sp_id" name="sp_id" value="<?php 
            if(isset($row['sp_id'])){
                echo $row['sp_id'];
            }
            ?>" readonly>
        </div>

        <div class="form-group">
            <label for="sp_ten">Tên sản phẩm</label>
            <input type="text" class="form-control" id="sp_ten" name="sp_ten" row="2" value = "<?php 
            if(isset($row['sp_ten'])){
                echo $row['sp_ten'];
            }
            ?>">  
        </div>
        <div class="form-group">
            <label for="sp_soLuong">Số lượng</label>
            <input type="text" class="form-control" id="sp_soLuong" name="sp_soLuong" value = "<?php 
            if(isset($row['sp_soLuong'])){
                echo $row['sp_soLuong'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="sp_moTa">Mô tả sản phẩm</label>
            
            <textarea type="text" class="form-control moTa" id="sp_moTa" name="sp_moTa" 
                style="height: 300px;"><?php 
            if(isset($row['sp_moTa'])){
                echo $row['sp_moTa'];
            }
            ?></textarea>
        </div>
        <div class="form-group">
            <label for="sp_giaGoc">Giá gốc</label>
            <input type="text" class="form-control" id="sp_giaGoc" name="sp_giaGoc" value = "<?php 
            if(isset($row['sp_giaGoc'])){
                echo $row['sp_giaGoc'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="sp_gia">Giá khuyến mãi</label>
            <input type="text" class="form-control" id="sp_gia" name="sp_gia" value = "<?php 
            if(isset($row['sp_gia'])){
                echo $row['sp_gia'];
            }
            ?>">
        </div>
        <?php 
         $date = $row['sp_nsx'];
         echo' <div class="form-group">
                <label for="sp_nsx">Ngày sản xuất</label>
                <input type="date" class="form-control" id="sp_nsx" name="sp_nsx" value ='.$date.' >
            </div>';
        ?>            
        <div class="form-group">
            <img src= "<?php 
            if(isset($row['sp_hinhAnh'])){
                echo $row['sp_hinhAnh'];
            }
            ?>"
            alt="" class="img-thumbnail" style="width: 30%;">
            <input type="file" class="form-control" id="sp_hinhAnh" name="sp_hinhAnh" >
        </div>

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


        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="../staff/sanPham.php" class="btn btn-secondary">Close</a>
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