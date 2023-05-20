<!-- Start Including Header -->
<?php
include('./dbconnection.php');
include('./mainInclude/header.php');
?>

<div class="container text-center" style="min-height: 480px;">
  <div class="row">
    <div class="col-12">
    <?php
    // session_start(); 
    // ob_start();
    if (isset($_SESSION['cart']) && (count($_SESSION['cart']) >0)) {
            // echo var_dump($_SESSION['cart']);
            // echo '<br> Có tiếp tục <a href="thongTinSanPham.php"> đặt hàng </a>';
        ?>
            <!-- End Including Header -->
            <h1 style="text-align: center;">Giỏ Hàng</h1>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Hình</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Xóa</th>

                    </tr>
                </thead>
                <tbody id="gioHang">
                    <?php
                    $tongTien = 0;
                    $i = 0;
                    foreach ($_SESSION['cart'] as $sanpham) {
                        $thanhTien = $sanpham[3] * $sanpham[4];
                        $tongTien += $thanhTien;
                        echo '
                            <tr>
                                <td>' . ($i + 1) . '</td>
                                <td><img src="' . $sanpham[2] . '" width="100"></td>
                                <td>' . $sanpham[1] . '</td>
                                <td>' . $sanpham[3] . '</td>
                                <td>
                                    <input type="number" min="1" max="99" value="'. $sanpham[4] .'" class="soLuong">
                                </td>
                                <td>' . $thanhTien . '</td>
                                <td style="text-align:center"><a href="xoaRongGioHang.php?id=' . $i . '">Xóa</a></td>
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
                <tbody>
                    <tr>
                        <td >
                            <p ><a href="index.php">Tiếp tục đặt hàng?</a></p>
                        </td>
                        <td>
                            <p><a href="xoaRongGioHang.php">Xóa rỗng giỏ hàng?</a></p> 
                        </td>
                        <td> <p><a href="giaoDienThanhToan.php">Tiến hành thanh toán</a></p> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        

        <?php
    } else {
        echo '<br> Giỏ hàng rỗng. Bạn muốn đặt hàng không <a href="index.php"> đặt hàng </a>';
    }
    ?>
  </div>
</div>


<script type="text/javascript" src="/js/gioHang.js"></script>

<!-- Start Including Footer -->
<?php
include('./mainInclude/footer.php')
?>
<!-- End Including Footer -->

<!-- <a onclick="Giam(this)"> << </a> <span>' . $sanpham[4] . '</span> <a onclick="Tang(this)"> >> </a> -->

<!-- <td style="text-align:center"><a href="xoaGioHang.php?id=' . $i . '" class="xoaSanPham">Xóa</a></td> -->
