<?php
    session_start();
    ob_start();
    if(isset($_SESSION['cart'])  && (count($_SESSION['cart']) >0) ){

            if(isset($_GET['id'])){ // Nếu sản phẩm tồn tại & > 0
                array_splice($_SESSION['cart'], $_GET['id'], 1); // Xóa phần tử có id tại giỏ hàng
            }else{
                unset($_SESSION['cart']);
                header('location: giaoDienGioHang.php');

            }

            if(count(($_SESSION['cart'])) > 0){
                header('location: giaoDienGioHang.php');
            }  
            else{
                // header('location: index.php');
                header('location: giaoDienGioHang.php');

            }
    }
?>