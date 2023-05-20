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

<div class="col-sm-9 mx-3 jumbotron">
    <h3 class="text-center">Chi Tiết Đơn Hàng</h3>

    <?php 
    if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM gioHang AS gh JOIN donhang AS dh 
                JOIN sanpham AS sp JOIN nguoiMua AS nm
                WHERE sp.sp_id = gh.sp_id AND  nm.nm_id = gh.nm_id
                    AND  gh.dh_id = dh.dh_id  AND gh.dh_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
        $stt = 0;
    }
    ?>
    <div class="col-sm-5" style="display: inline-block;">
        <div class="form-group">
            <label for="dh_id">ID đơn hàng</label>
            <input type="text" class="form-control" id="dh_id" name="dh_id" value="<?php if(isset($row['dh_id'])) {echo $row['dh_id']; } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nm_ten">Tên người nhận</label>
            <input type="text" class="form-control" id="nm_ten" name="nm_ten" value="<?php if(isset($row['nm_ten'])) {echo $row['nm_ten']; } ?>"readonly>
        </div>
        <div class="form-group">
            <label for="thanhToan">Tổng thanh toán</label>
            <input type="text" class="form-control" id="thanhToan" name="thanhToanm" value="<?php if(isset($row['dh_tongThanhToan'])) {echo format_curency($row['dh_tongThanhToan']); } ?>"readonly>
        </div>
    </div>
    <div class="col-sm-5" style="display: inline-block;">
        <div class="form-group">
            <label for="dh_ngayDat">Ngày đặt hàng</label>
            <input type="text" class="form-control" id="dh_ngayDat" name="dh_ngayDat" value="<?php if(isset($row['dh_ngayDat'])) {echo $row['dh_ngayDat']; } ?>"readonly>
        </div>
        <div class="form-group">
            <label for="nm_sdt">SĐT</label>
            <input type="text" class="form-control" id="nm_sdt" name="nm_sdt" value="<?php if(isset($row['nm_sdt'])) {echo $row['nm_sdt']; } ?>"readonly>
        </div>
        <div class="form-group">
            <label for="nm_sdt"></label>
            <input type="text" class="form-control" id="nm_sdt" name="nm_sdt" value="" readonly>
        </div>
    </div>
        
        <table class="table">
            <thead>
                <tr class="text-center" style="border-style: double;">
                    <td scope="col" >STT</td>
                    <td scope="col" >Sản phẩm</td>
                    <td scope="col" >Số lượng</td>
                    <td scope="col" >Giá</td>
                    <td scope="col" >Thành tiền</td>
                    
                </tr>
            </thead>
            <tbody class="text-center">
            <?php
                $result = $conn->query($sql);
             while($row = $result -> fetch_assoc()){
                $stt += 1;
                $thanhTien = $row["gh_donGia"]*$row["gh_soLuong"];
            echo '<tr>';
            echo '<td>'.$stt.'</td>';
            echo '<td scope="row">'.$row["sp_ten"].'</td>';
            echo '<td>'.$row["gh_soLuong"].'</td>';
            echo '<td>'.format_curency($row["gh_donGia"]).'</td>';
            echo '<td>'.format_curency($thanhTien).'&nbsp';
            } ?>
            </tbody>
        </table>
        <div class="text-center">
            <td><form class="d-print-none">
                <input class="btn btn-danger" type="submit" value="Print" onClick="window.print()">
                <a href="donHang.php" class="btn btn-secondary">Close</a>
            </form></td>
            
        </div>
        <?php if(isset($msg)) {echo $msg;} ?>
    
</div>
</div>

<?php 
include('../staff/staffinclude/footer.php');
?>