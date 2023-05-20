<?php

if(!isset($_SESSION)){
    session_start();
}
include('../staff/staffinclude/header.php');
include('../dbConnection.php');
include('../staff/format.php');

if(isset($_SESSION['is_staff_login'])){
    $staffEmail = $_SESSION['staffLogEmail'];
}
else {
    echo "<script>location.href='../index.php';</script>";
}

?>

<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2">Danh sách sản phẩm</p>
    <form method="POST" class="d-flex col-sm-6 p-2" role="search">
        <input class="form-control me-2 col-sm-4" type="search" name = "search" placeholder="Tên sản phẩm" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="btnSearch">Search</button>
        <button type="submit" class="btn btn-danger" style="margin-left: 10px;" name="all" value="all">
                Tất cả
        </button>
        <button type="submit" class="btn btn-info" style="margin-left: 10px;" name="oos" value="oos">
                Sắp hết hàng
        </button>
    </form>
    <p><i class="fa-solid fa-filter"></i> Bộ lộc theo danh mục 
    <form action="" method="post" enctype="multipart/form-data">
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
    </form>
 
        </select>
    
            <form method="POST" class="d-inline">
                    <input type="hidden" name="loc" value="<?php echo $row['dm_id'] ?>">
                    <button type="submit" class="btn btn-secondary" name="loc" value="loc">
                        Lọc
                    </button>
            </form>
        
    </p>
    
    <?php
        $sql = "SELECT * FROM sanPham";
        if(isset($_REQUEST['btnSearch'])){ 
            $search = $_REQUEST['search'];
            $sql = "SELECT * FROM sanPham 
                    WHERE LOWER(sp_ten) LIKE LOWER('%$search%')";
        }
        if(isset($_REQUEST['all'])){ 
                $sql = "SELECT * FROM sanPham";
        }
        if(isset($_REQUEST['oos'])){ 
            $sql = "SELECT * FROM sanPham WHERE sp_soLuong <= 5";
    }
        if(isset($_REQUEST['loc'])){ 
            $loc = $_REQUEST['dm_id'];
            $sql = "SELECT * FROM sanPham WHERE dm_id = $loc ";
        }
            $result = $conn->query($sql);
            if($result -> num_rows > 0) {    
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
       <tbody>
            <?php while($row = $result -> fetch_assoc()){
            echo '<tr >';
            echo '<th scope="row">'.$row["sp_id"].'</th>';
            echo '<td>'.$row["sp_ten"].'</td>';
            echo '<td>'.$row["sp_soLuong"].'</td>';
            echo '<td>'.format_curency($row["sp_gia"]).'</td>';
            echo '<td>';
            echo '
                <form action="suaSanPham.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["sp_id"].'>
                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                            <i class="fas fa-pen"></i>
                    </button>
                </form>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["sp_id"].'>
                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>';
            } ?>
        </tbody>
    </table>

    <?php }
    else{
        echo "0 Result";
    }

    if(isset($_REQUEST['delete'])){
        $sql = "DELETE FROM sanPham WHERE sp_id = " . $_REQUEST['id'];
        if($conn ->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
        }
        else{
            echo "Unable to delete data";
        }
    }

    ?>
</div>
</div>

<?php
    
?>

<div>
    <a href="../staff/themSanPham.php" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
        <p>Thêm sản phẩm</p>
    </a>
</div>
</div>



<?php 
include('../staff/staffinclude/footer.php');
?>