
<?php
    SESSION_start();
    ob_start();
    if((isset($_POST['sp_soLuong']) && ($_POST['sp_soLuong']))){ // Nhận giá trị từ $.post bên gioHang.php
        $sp_ten = $_POST['sp_ten'];
        $sp_soLuong = $_POST['sp_soLuong'];
        $i=0;
        $soLuongSanPham = 0;
        // Tìm và so sánh một sản phẩm trong giỏ hàng, có rồi thì chỉ cập nhật số lượng (trùng tên)
         if(isset($_SESSION['cart']) ){
            foreach ($_SESSION['cart'] as $sanpham) {
                if($sanpham[1] == $sp_ten){
                    // Cập nhật số lượng mới dô giỏ hàng
                    $_SESSION['cart'][$i][4] = $sp_soLuong; // Cập nhật cột thứ 4(Số lượng) trong tại vị trí $i trong giỏ hàng
                    break;
                }
                $i++;
            }
            // Cập nhật số lượng sản phẩm trong icon giỏ hàng khi thay đổi bên trong giỏ hàng
            $j=0;
            foreach ($_SESSION['cart'] as $sanpham) {
                    $soLuongSanPham += $_SESSION['cart'][$j][4];
                    $j++;
                } 
            }
            echo $soLuongSanPham;
         }
?>

