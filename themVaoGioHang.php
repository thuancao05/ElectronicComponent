<!-- 
    Lấy dữ liệu từ from bên thongTinSanPham.php 
 -->
<?php
include('./dbconnection.php');
include('./mainInclude/header.php');
?>

<?php
    SESSION_start();
    ob_start();
    if(!isset($_SESSION['cart'])){ // Nếu chưa có giỏ hàng thì tạo (Mảng)
        $_SESSION['cart'] = array();
    }
    
    if((isset($_POST['themGioHang']) && ($_POST['themGioHang']))){ // input name="addtocart" in thongTinSanPham.php
        $sp_id = $_POST['sp_id'];
        $sp_ten = $_POST['sp_ten'];
        $sp_hinhAnh = $_POST['sp_hinhAnh'];
        $sp_gia = $_POST['sp_gia'];

        if(isset($_POST['sp_soLuong']) && ($_POST['sp_soLuong'] >0)){
            $soLuong = $_POST['sp_soLuong'];
        }else{
            $soLuong = 1;
        }

        // $soLuong = $_POST[soLuong];
        $i=0;
        $fg=0;
        // Tìm và so sánh một sản phẩm trong giỏ hàng, có rồi thì chỉ cập nhật số lượng (trùng id)
        if(isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0) ){
            foreach ($_SESSION['cart'] as $sanpham) {
                if($sanpham[0] == $sp_id){
                    // Cập nhật số lượng
                    $soLuong += $sanpham[4];
                    $fg = 1;
                    // Cập nhật số lượng mới dô giỏ hàng
                    $_SESSION['cart'][$i][4] = $soLuong; // Cập nhật cột thứ 4(Số lượng) trong tại vị trí $i trong giỏ hàng
                    break;
                }
                $i++;
            }
        }

        // Khi số lượng ban đầu không đổi => thêm mới sp vào giỏ hàng
        if($fg==0){
            // Tạo mảng con trước khi đưa vào giỏ hàng
            $sanpham = array($sp_id, $sp_ten, $sp_hinhAnh, $sp_gia, $soLuong);
            // Đưa mảng vừa tạo vào session
            array_push($_SESSION['cart'], $sanpham);
        }
        // Chuyển trang
    } header('location: giaoDienGioHang.php');     


?>
<?php
include('./mainInclude/footer.php')
?>
