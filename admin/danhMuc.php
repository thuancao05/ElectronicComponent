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
?>

<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2">Danh sách danh mục</p>
    <form method="POST" class="d-flex col-sm-6 p-2" role="search">
        <input class="form-control me-2" type="search" name = "search" placeholder="Tên danh mục" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="btnSearch">Search</button>
        <button type="submit" class="btn btn-danger" style="margin-left: 10px;" name="all" value="all">
                Tất cả
        </button>
    </form>
    <?php 
        $sql = "SELECT * FROM danhMuc";
        if(isset($_REQUEST['btnSearch'])){ 
            $search = $_REQUEST['search'];
            $sql = "SELECT * FROM danhMuc 
                    WHERE LOWER(dm_ten) LIKE LOWER('%$search%')";
        }
        if(isset($_REQUEST['all'])){ 
                $sql = "SELECT * FROM danhMuc";
        }

    $result = $conn->query($sql);
    if($result -> num_rows > 0) {

    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result -> fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">'.$row["dm_id"].'</th>';
            echo '<td>'.$row["dm_ten"].'</td>';
            echo '<td>'.$row["dm_moTa"].'</td>';
            echo '<td>';
            echo '
                <form action="suaDanhMuc.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["dm_id"].'>
                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                        
                            <i class="fas fa-pen"></i>
                       
                    </button>
                </form>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["dm_id"].'>
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
        $sql = "DELETE FROM danhMuc WHERE dm_id = " . $_REQUEST['id'];
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

<div>
    <a href="../admin/themDanhMuc.php" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
        <p>Thêm danh mục</p>
    </a>
</div>
</div>



<?php 
include('../admin/admininclude/footer.php');
?>