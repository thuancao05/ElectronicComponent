<!-- Giao diện thông tin sau khi thanh toán -->
<div class="">
  <div class="row">
    <div class="col-9 container text-center" style="min-height: 480px;">
            <?php
            // Hiển thị đơn hàng vừa thanh toán
            if(isset($_SESSION['idDonHang']) && ($_SESSION['idDonHang'] > 0)){
            $hienThiGioHang = hienThiGioHang($idDonHang);
            if (isset($hienThiGioHang) && (count($hienThiGioHang) > 0)) {
                    ?>
                    <h1 style="text-align: center;">Thông tin đặt hàng</h1>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            // $sanpham = array($sp_id, $sp_ten, $sp_hinhAnh, $sp_gia, $soLuong);
                                $tongTien = 0;
                                $i = 0;
                                foreach ($hienThiGioHang as $sanpham) {
                                    $thanhTien = $sanpham['gh_soLuong'] * $sanpham['gh_donGia'];
                                    $tongTien += $thanhTien;
                                    echo '
                                        <tr>
                                            <td>' . ($i + 1) . '</td>
                                            <td><img src="' . $sanpham['gh_img'] . '" width="100"></td>
                                            <td>' . $sanpham['gh_tenSanPham'] . '</td>
                                            <td>' . $sanpham['gh_donGia'] . '</td>
                                            <td>' . $sanpham['gh_soLuong'] . '</td>
                                            <td>' . $thanhTien . '</td>
                                        
                                        </tr>
                                    ';
                                    $i++;
                                }
                                ?>
                                <tr>
                                    <td colspan="5">Tổng đơn hàng</td>
                                    <td style="background-color: #CCC;"><?php echo $tongTien ?></td>
                                    <td></td>
                                </tr>

                            </tbody>
            <?php
                    }
            ?>    
        </div>
    
    <div class="col-3">
    <?php
        // Hiển thị thông tin người đặt
         if(isset($_SESSION['idDonHang']) && ($_SESSION['idDonHang'] > 0)){
            $orderInfor = hienThiThongTinDatHang($_SESSION['idDonHang']);
            if(count($orderInfor) > 0){
        ?>  
                    <table class="datHang container text-center" >
                        <tr>
                            <td><h1>Thông tin người đặt</h1></td>
                        </tr>
                        <!-- <tr>
                            <td><h4>ID đơn hàng: <?=$orderInfor[0]['dh_id']?> </h4></td>
                        </tr> -->
                        <tr>
                            <td>Tên người nhận: <?=$orderInfor[0]['hoten']?> </td>
                        </tr>
                        <tr>
                        <td>Địa chỉ người nhận: <?=$orderInfor[0]['sonha']?> </td>
                        </tr>
                        <tr>
                        <td>Email người nhận: <?=$orderInfor[0]['email']?> </td>
                        </tr>
                        <tr>
                        <td>Điện thoại người nhận: <?=$orderInfor[0]['sdt']?></td>
                        </tr>
                        <tr>
                        <td>Ghi chú: <?=$orderInfor[0]['ghichu']?></td>
                        </tr>

                        <tr>
                            <td>Phương thức thanh toán:
                            <?php
                                switch ($orderInfor[0]['pttt']) {
                                    case '1':
                                        $txtMess="Thanh toán khi nhận hàng";
                                        break;
                                    case '2':
                                        $txtMess="Thanh toán khi giao hàng";
                                        break;
                                    default:
                                        $txtMess="Quý khách chưa chọn ...";
                                        break;
                                }
                                echo $txtMess;
                            ?></td>
                        </tr>
                    
                    </table>
                
                    <?php
                    }
        }
        ?>
    <?php
        echo '<br> Quay lại <a href="index.php">  trang chủ </a>';
        }
        
    ?>
    </div>
  </div>
 
</div>
