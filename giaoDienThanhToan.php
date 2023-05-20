<!-- Start Including Header -->
<?php
include('./dbconnection.php');
include('./mainInclude/header.php');

if (isset($_SESSION['is_login'])) {
    $nm_email = $_SESSION['userLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Lấy thông tin người dùng
$sql = "SELECT * FROM nguoimua WHERE nm_email='$nm_email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nm_id = $row["nm_id"];
    $nm_email = $row["nm_email"];
   
}
$sql_diaChi = "SELECT dc_sonha as sonha , dc_thanhpho as tentp, dc_tinh as tentinh, dc_xa as tenxa, dc_sdt as sdt, dc_hoten as hoten
               FROM diachi 
               WHERE nm_email = '$nm_email'";
$result = $conn->query($sql_diaChi);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tentp = $row["tentp"];
        $tentinh = $row["tentinh"];
        $tenxa = $row["tenxa"];
        $sonha = $row["sonha"];
        $sdt = $row["sdt"];
        $hoten = $row["hoten"];

    }
}
?>

<div class="container text-center">
  <div class="row">
    <div class="col-9" style="min-height: 480px;">
    <?php
    if (isset($_SESSION['cart']) && (count($_SESSION['cart']) >0)) {
        ?>
            <!-- End Including Header -->
            <h1 style="text-align: center;">Thông tin sản phẩm</h1>
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
                <tbody id="gioHang">
                    <?php
                    $tongTien = 0;
                    $i = 0;
                    $tongSoLuongSanPham = 0;
                    foreach ($_SESSION['cart'] as $sanpham) {
                        $thanhTien = $sanpham[3] * $sanpham[4];
                        $tongTien += $thanhTien;
                        $tongSoLuongSanPham += $sanpham[4];
                        echo '
                            <tr>
                                <td>' . ($i + 1) . '</td>
                                <td><img src="' . $sanpham[2] . '" width="100"></td>
                                <td>' . $sanpham[1] . '</td>
                                <td>' . $sanpham[3] . '</td>
                                <td>
                                    '. $sanpham[4] .'
                                </td>
                                <td>' . $thanhTien . '</td>
                            </tr>
                        ';
                        $i++;
                    }
                    ?>
                </tbody>
                <tbody id="tongDonHang">
                    <tr>
                            <td colspan="5"><strong>Tổng đơn hàng</strong></td>
                            <td style="background-color: #CCC;"><?php echo $tongTien ?></td>
                            <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-3   ">
        <h4 style="text-align: center;">Thông tin nhận hàng</h4>
        <form action="thanhtoan.php" method="POST">
            <input type="hidden" name="tongdonhang" value="<?=$tongTien?>">
            <input type="hidden" name="soLuongSanPham" value="<?=$tongSoLuongSanPham?>">
            <table class="datHang" style="height: 300px; width: 100%;">
                <tr>
                    <td><input type="text" name="hoten" placeholder="Nhập họ tên" value="<?=$hoten?>"></td>
                </tr>
                <tr>
                <td><input type="text" name="diachi" placeholder="Nhập địa chỉ" value="<?php echo "$sonha, ", "$tenxa, ", "$tentinh, ", "$tentp" ?>"></td>
                </tr>
                <tr>
                <td><input type="text" name="email" placeholder="Nhập email" value="<?=$nm_email?>" readonly></td>
                </tr>
                <tr>
                <td><input type="text" name="sodienthoai" placeholder="Nhập số điện thoại" value="<?=$sdt?>"></td>
                </tr>
                
                <tr>
                    <td><input type="text" name="ghichu" placeholder="Ghi chú" value=""></td>
                </tr>
                <tr>
                    <td>Phương thức thanh toán <br>
                        <input type="radio" name="pttt" value="1" checked> Thanh toán khi nhận hàng <br>
                        <input type="radio" name="pttt" value="2"> Thanh toán khi giao hàng <br>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Đặt hàng" name="thanhToan"></td>
                </tr>
            </table>
        </form>
        <?php
    } else {
        echo '<br> Giỏ hàng rỗng. Bạn muốn đặt hàng không <a href="index.php"> đặt hàng </a>';
    }
    ?>
    </div>
  </div>
</div>

<!-- Start Including Footer -->
<?php
include('./mainInclude/footer.php')
?>

