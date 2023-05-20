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
        <h4 class="bg-dark text-white p-2 text-center">Đơn hàng mới nhất</h4>


 <?php 
    $sql = "SELECT dh.dh_id, tt.tt_ten, dh.dh_ngayDat, dh.dh_tongThanhToan,nm_ten,nm_sdt
            FROM donhang AS dh JOIN trangThai AS tt
                        JOIN nguoiMua AS nm WHERE tt.tt_id = dh.tt_id AND nm.nm_id=dh.nm_id
            ORDER BY  dh_id
            DESC LIMIT 5;";
    $result = $conn->query($sql);
    if($result -> num_rows > 0) {
    ?>

    <div class="mx-5 mt-5 text-center">
                    
                    <!-- table -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $result -> fetch_assoc()){
                            echo '<tr>';
                            echo '<th scope="row">'.$row['dh_id'].'</th>';
                            echo '<td>'.$row['dh_ngayDat'].'</td>';
                            echo '<td>'.$row['tt_ten'].'</td>';
                            echo '<td>'.$row['nm_ten'].'</td>';
                            echo '<td>'.$row['nm_sdt'].'</td>';
                            echo '<td>'.format_curency($row['dh_tongThanhToan']).'</td>';
                            echo  '<td>
                                    <form action="chiTietDonHang.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value='.$row["dh_id"].'>
                                        <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                                                Chi tiết
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
                    } ?>
                </div>
            </div>
        </div>
    </div> '; 
</div>    
<?php 

include('../staff/staffinclude/footer.php');
?>