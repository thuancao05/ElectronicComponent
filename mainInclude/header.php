<!DOCTYPE html>
<html lang="en">
<?php 
    ob_start();
    SESSION_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Google Font -->
    <!--  
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    -->
    <!--Slick slider  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- Scripts  -->
    <title> Sáng Tạo Điện Tử</title>

</head>
<style>
.nav-links {
    display: flex;
    text-align: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.5);
    margin: 0 15px !important;
    padding: 10px 15px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.nav-links li {
    list-style: none;
    margin: 0 12px;
}

.nav-links li a {
    position: relative;
    color: #0f4229;
    font-size: 20px;
    font-weight: 1000;
    padding: 10px 0 10px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.4s ease;
    white-space: nowrap;
}

.nav-links li a:hover {
    color: #fff !important;
    background-color: #348e38;
}

.nav-btn {
    font-size: 25px;
    padding: 0.8rem;
    margin: 0.3rem 0.3rem;
    color: #fff;
    border-radius: 90px;
    background-color: var(--primary-color3);
    border: 2px solid #fff;
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    transition: 0.3s;
}

.nav-btn:hover {
    background-color: var(--primary-color);
    color: #dc3545 !important;
    border: 2px solid #dc3545;
}

.nav-btn i {
    font-size: 20px;
}

#search-btn {
    display: none;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 128, 0)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

.navbar-toggler {
    border: 3px solid green !important;
}

.navbar-toggler:focus {
    box-shadow: none;
}    
.d-flex.search-form {
    font-family: 'Rokkitt', serif;
    margin-right: 15px;
    margin-left: 650px;
}
.btn-cus{
    color:#fff;
    background-color:#007bff;
    border-color:#fff;   
}
.btn-cus:hover{
    color:#dc3545;
    border-color: #dc3545;
}

/* InforAccount */

.sub-menu-wrap{
    position: absolute;
    top: 100%;
    right: 10%;
    width: 320px;
    max-height: 0px;
    transition: max-height 0.5s;
    overflow: hidden;
    z-index: 99 !important;
 }
.sub-menu{
    background: #fff;
    padding: 15px 10px;
    margin: 10px;
}
.sub-menu ul{
    list-style:none;
    padding:0;
    margin:0;
}
.sub-menu-link{
    display: flex;
    align-items: center;
    color: #525252;
    margin: 12px 0;
    text-decoration: none;
    border-radius: 5px;
    font-size: 22px;
    text-align: center;
}
.sub-menu-link:hover{
    text-decoration: none;
    font-weight: 5px;
    color:#fff;
    background: #007bff;
    font-weight: 5px;
}

 .sub-menu-wrap.open-menu{
    max-height: 400px;
 }

</style>
<body>
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-sm" style="background-color: #007bff; border-radius: 10px; margin: 5px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img src="image/logo.png" alt="Logo" height="60" width="60">Sáng Tạo Điện Tử</a>
            <span class="navbar-text"></span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- <ul class="navbar-nav custom-nav px-5 me-auto mb-2 mb-lg-0">
                    <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link" 
                        style="min-width: 120px;font-size: 20px;">Trang chủ</a></li>
                    <li class="nav-item custom-nav-item"><a href="sanPham.php" class="nav-link"
                    style="min-width: 120px;font-size: 20px;">Sản phẩm</a></li>
                </ul> -->
        
                <!-- <form class="d-flex search-form">
                    <input type="text" class="form-control col-sm-9" name="search" placeholder="Tìm kiếm" required>
                    <button type="submit" class="btn btn-cus">Search
                        
                    </button>
                    
                </form> -->
                <div style="margin-left: 80%;"></div>
                <a href="timKiem.php" class="nav-btn" ><i class="fas fa-search"></i></a>
                <a href="giaoDienGioHang.php" class="nav-btn" ><i class="fas fa-shopping-cart"></i></a>
                <a href="#" id="account-btn" class="nav-btn"><i class="fas fa-user" onclick="toggleMenu()"></i></a>                       
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <ul>
                            <?php
                             
                                if(isset($_SESSION['is_login'])){
                                    echo '
                                        <li ><a href="Customer/thongTinNguoiMua.php" class="sub-menu-link"">My Profile</a></li> 
                                        <li ><a href="logout.php" class="sub-menu-link">Logout</a></li>                        
                                    ';
                                } else{
                                    echo '
                                        <li ><a href="#login" class="sub-menu-link" data-toggle="modal" data-target="#loginModal">Login</a></li><hr>
                                        <li><h6>Dont have an Account?</h6></li>
                                        <li ><a href="#signup" class="sub-menu-link" data-toggle="modal" data-target="#signupModal">Signup</a></li>                        
                                    ';
                                }   
                            ?>  
                            <!-- <li ><a href="" class="sub-menu-link">Login  </a></li>
                            
                            <li ><a href="" class="sub-menu-link">Sign-up</a></li> -->
                        </ul>    
                    </div>
                    
                </div>         
            </div>
        </div>
    </nav>
    <!-- End Navigation -->