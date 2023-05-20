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
    <p class="bg-dark text-white p-2">Danh sách đơn hàng</p>
    <form method="POST" class="d-flex col-sm-4 p-2" role="search">
        <input class="form-control me-2" type="search" name = "search" placeholder="Số điện thoại khách hàng" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="btnSearch">Search</button>
    </form>
    <form method="POST" class="d-inline p-2">
        <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;" name="all" value="all">
                Tất cả
        </button>
    </form>

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
            $sql = "SELECT * FROM donHang AS dh JOIN trangThai AS tt JOIN nguoiMua AS nm
                    WHERE dh.tt_id = tt.tt_id AND nm.nm_id = dh.nm_id";

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
                
            if($row["tt_id"] == 1 ){
            echo   '<form method="POST" class="d-inline">
                    <input type="hidden" name="id" value='.$row["dh_id"].'>
                    <button type="submit" class="btn btn-info mr-3" name="tt1" value="tt1">
                        Xác nhận
                    </button>
                </form>';   
            }
            if($row["tt_id"] == 2 ){
                echo   '<form method="POST" class="d-inline">
                        <input type="hidden" name="id" value='.$row["dh_id"].'>
                        <button type="submit" class="btn btn-info mr-3" name="tt2" value="tt2">
                            Vận chuyển
                        </button>
                    </form>';   
            }
            if($row["tt_id"] == 3 ){
                    echo   '<form method="POST" class="d-inline">
                            <input type="hidden" name="id" value='.$row["dh_id"].'>
                            <button type="submit" class="btn btn-info mr-3" name="tt3" value="tt3">
                                Đã giao hàng
                            </button>
                        </form>';   
            }
            
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
    if(isset($_REQUEST['tt1'])){
        $sql = "UPDATE donHang SET tt_id = 2 WHERE dh_id = " . $_REQUEST['id'];
        if($conn ->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?updated">';
        }
        else{
            echo "Unable to delete update";
        }
    }
    if(isset($_REQUEST['tt2'])){
        $sql = "UPDATE donHang SET tt_id = 3 WHERE dh_id = " . $_REQUEST['id'];
        if($conn ->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?updated">';
        }
        else{
            echo "Unable to delete update";
        }
    }
    if(isset($_REQUEST['tt3'])){
        $sql = "UPDATE donHang SET tt_id = 4 WHERE dh_id = " . $_REQUEST['id'];
        if($conn ->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?updated">';
        }
        else{
            echo "Unable to delete updated";
        }
    }
    ?>
</div>
</div>

</div>



<?php 
include('../staff/staffinclude/footer.php');
?>