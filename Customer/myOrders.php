<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'My Order');
define('PAGE', 'order');
include('./cusInclude/header.php');
include_once('../dbConnection.php');
include('../admin/format.php');


if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['userLogEmail'];
    
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2">Danh sách đơn hàng</p>
    <!-- <form method="POST" class="d-flex col-sm-4 p-2" role="search">
        <input class="form-control me-2" type="search" name = "search" placeholder="Số điện thoại khách hàng" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="btnSearch">Search</button>
    </form>
    <form method="POST" class="d-inline p-2">
        <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;" name="all" value="all">
                Tất cả
        </button>
    </form> -->

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ngày đặt hàng</th>
                <th scope="col">Tên người nhận</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tổng thanh toán</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
       <tbody>
        <?php 
       
            $sql = "SELECT nm_id FROM nguoimua 
                    WHERE nm_email = '".$stuEmail."'";
            $result = $conn->query($sql);
            $row = $result-> fetch_assoc();
            $nm_id = $row['nm_id'];

            $sql = "SELECT * FROM donHang AS dh JOIN trangThai AS tt JOIN nguoiMua AS nm
                    WHERE dh.tt_id = tt.tt_id AND '".$nm_id."' = dh.nm_id AND '".$nm_id."' = nm.nm_id";

            if(isset($_REQUEST['btnSearch'])){ 
                $search = $_REQUEST['search'];
                $sql = "SELECT * FROM donHang AS dh JOIN trangThai AS tt JOIN nguoiMua AS nm
                            WHERE dh.tt_id = tt.tt_id AND nm.nm_id = dh.nm_id
                                    AND nm_sdt LIKE '$search'";
            }
            if(isset($_REQUEST['all'])){ 
                $sql = "SELECT * FROM donHang AS dh JOIN trangThai AS tt JOIN nguoiMua AS nm
                            WHERE dh.tt_id = tt.tt_id AND nm.nm_id = dh.nm_id";
            }
            $result = $conn->query($sql);
                if($result -> num_rows > 0) {

        ?>
            <?php while($row = $result -> fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">'.$row["dh_id"].'</th>';
            echo '<td>'.$row["dh_ngayDat"].'</td>';
            echo '<td>'.$row["nm_ten"].'</td>';
            echo '<td>'.$row["nm_sdt"].'</td>';
            echo '<td>'.format_curency($row["dh_tongThanhToan"]).'</td>';
            echo '<td>'.$row["tt_ten"].'&nbsp';
                
            
            
            echo '</td>
                <td>';
            echo '
                <form action="chiTietDonHang.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["dh_id"].'>
                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                            Chi tiết
                    </button>
                </form>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["dh_id"].'>
                    <button type="submit" class="btn btn-secondary" name="cancel" value="cancel">
                        Hủy
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

    if(isset($_REQUEST['cancel'])){
        $sql = "UPDATE donHang SET tt_id = 5 WHERE dh_id = " . $_REQUEST['id'];
        if($conn ->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?canceled">';
        }
        else{
            echo "Unable to delete cacel";
        }
    }
    
    ?>
</div>
</div>

</div>


<?php  
include("./cusInclude/footer.php");
?>