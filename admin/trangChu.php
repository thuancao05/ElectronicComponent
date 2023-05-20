<?php 
if(!isset($_SESSION)){
    session_start();
}
include('../admin/admininclude/header.php');
include('../dbConnection.php');
include('../admin/format.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];
}
else {
    echo "<script>location.href='../index.php';</script>";
}

      
?>
  
        <div class="col-sm-9 mt-5">
        <h4 class="bg-dark text-white p-2 text-center">Tổng quan</h4>
        <button type="button" class="btn btn-primary" id="btn_7days" value="7" style="margin-left: 130px;" >7 Ngày</button>
        <button type="button" class="btn btn-primary" id="btn_30days"  style="margin-left: 30px;">30 Ngày</button>
        <button type="button" class="btn btn-primary" id="btn_all"  style="margin-left: 30px;">Toàn thời gian</button>

            <div class="row mx-5 text-center" id="load-data" >
                
                    <div class="col-sm-4 mt-5" >
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Đơn hàng</div>
                            <div class="card-body">
                                <h4 class="card-title" >
                                    <div id="quantity"></div>
                                    </h4>
                                <a class="btn text-white" href="donHang.php">Xem</a>
                            </div>
                        </div>
                    </div>
                
                     <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                             <div class="card-header">Doanh thu</div>
                             <div class="card-body">
                                 <h4 class="card-title"></h4>
                                 <a class="btn text-white" href="thongKe.php">Xem</a>
                                    
                             </div>
                         </div>
                     </div>
<?php
    
    $sql = "SELECT COUNT(sp_id) FROM sanPham WHERE sp_soLuong < 5";
    $result = $conn->query($sql);
    $row = $result-> fetch_assoc();
    $oos =  $row['COUNT(sp_id)'] ;
    echo            '<div class="col-sm-4 mt-5">
                         <div class="card text-white bg-info mb-3" style="max-width: 18rem;" onclick="lessons.php">
                            <div class="card-header">Sản phẩm sắp hết</div>
                             <div class="card-body">
                                 <h4 class="card-title">'.$oos.' </h4>
                                 <a class="btn text-white" href="sanPham.php">Xem</a>
                             </div>
                         </div>
                     </div>
            ';
            ?>
            </div>
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
                    <p class="bg-dark text-white p-2">Đơn hàng mới nhất</p>
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
    
<?php 
include('../admin/admininclude/footer.php');
?>