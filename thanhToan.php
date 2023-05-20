<?php
     include('./mainInclude/header.php');
    include('./dbconnection.php');
    include('../admin/format.php');
    //  SESSION_start();
    //  ob_start();
    if (isset($_SESSION['is_login'])) {
        $nm_email = $_SESSION['userLogEmail'];
    } else {
        echo "<script> location.href='../index.php'; </script>";
    }
    
     include('./donHang.php');
    //  include('./hoaDon.php');
     
    // Nếu click button Thanh toán
     if((isset($_POST['thanhToan'])) && (isset($_POST['thanhToan']))){
        // Lấy dữ liệu khi lick thanh toán
        $tongDonHang = $_POST['tongdonhang'];
        $soLuongSanPham = $_POST['soLuongSanPham'];
        $ghiChu = $_POST['ghichu'];
        // $hoTen = $_POST['hoten'];
        // $diaChi = $_POST['diachi'];
        // $email = $_POST['email'];
        // $sdt = $_POST['sodienthoai'];
        $pttt = $_POST['pttt'];
        // Tạo mã đơn hàng
        // $maDonHang = "LKDT".rand(0,999999);
        // Tạo đơn hàng (insert thông tin vào bản tlb_order)
        // $idDonHang=taoDonHang($maDonHang, $tongDonHang, $pttt, $hoTen, $diaChi, $email, $sdt); // donHang.php
        
        $nm_id=0;
        $sql = "SELECT * FROM nguoimua WHERE nm_email='$nm_email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $nm_id = $row["nm_id"];
        }
        
        $idDonHang=taoDonHang($nm_id, $soLuongSanPham, $ghiChu, $tongDonHang, $pttt);        

        $_SESSION['idDonHang'] = $idDonHang;
        // Tạo giỏ hàng (insert thông tin vào bản tlb_cart)
        if(isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0) ){
            foreach ($_SESSION['cart'] as $sanpham){
                // addtocart($idDonHang, $sanpham[0], $sanpham[1], $sanpham[2], $sanpham[3], $sanpham[4]);
                themGioHang($idDonHang, $sanpham[0], $sanpham[1], $sanpham[2], $sanpham[3], $sanpham[4], $nm_id);
            }
            // Xóa giỏ hàng sau khi đặt
             unset($_SESSION['cart']);
        }
        
     }
     
?>



<?php  
include('./giaoDienThongTinThanhToan.php');

//  include('./mainInclude/footer.php');
ob_flush(); 
?>
