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
    <p class="bg-dark text-white p-2">Danh sách nhân viên</p>
    <form method="POST" class="d-flex col-sm-4 p-2" role="search">
        <input class="form-control me-2" type="search" name = "search" placeholder="Mã nhân viên" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="btnSearch">Search</button>
    </form>
    <form method="POST" class="d-inline p-2">
        <input type="hidden" name="all" value="all">
        <button type="submit" class="btn btn-danger" name="all" value="all">
                Tất cả
        </button>
    </form>

    <?php 
    $sql = "SELECT * FROM nhanvien";
        if(isset($_REQUEST['btnSearch'])){ 
            $search = $_REQUEST['search'];
            $sql = "SELECT * FROM nhanvien
                        WHERE nv_id LIKE '$search'";
        }
        if(isset($_REQUEST['all'])){ 
            $sql = "SELECT * FROM nhanvien";
        }
        $result = $conn->query($sql);
        if($result -> num_rows > 0) {

    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Email</th>
                <th scope="col">Mật khẩu</th>
            </tr>
        </thead>
       <tbody>
            <?php while($row = $result -> fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">'.$row["nv_id"].'</th>';
            echo '<td>'.$row["nv_ten"].'</td>';
            echo '<td>'.$row["nv_email"].'</td>';
            echo '<td>'.$row["nv_matkhau"].'</td>';             
            echo '</td>';

            echo '<td>';
            echo '
                <form action="suaNV.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["nv_id"].'>
                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                            <i class="fas fa-pen"></i>
                    </button>
                </form>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["nv_id"].'>
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
        $sql = "DELETE FROM nhanvien WHERE nv_id = " . $_REQUEST['id'];
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
    <a href="../admin/themNhanVien.php" class="btn btn-danger box">
        <i class="fas fa-plus fa-2x"></i>
        <p>Thêm nhân viên</p>
    </a>
</div>
</div>



<?php 
include('../admin/admininclude/footer.php');
?>