<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/adminstyle.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/2dd9be8ee2.css" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <script src="https://kit.fontawesome.com/2dd9be8ee2.js" crossorigin="anonymous"></script>
    <!-- top navbar -->
    <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #225470;">
        <a href="trangChu.php" class="navbar-brand col-sm-3 col-md-2 mr-0">Sáng Tạo Điện Tử <small class="text-white">Admin area</small></a>
    </nav>
    <!-- side bar -->
    <div class="container-fluid mb-5" style="margin-top: 40px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="trangChu.php">
                                <i class="fas fa-tachometer-alt"></i> Trang chủ
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="donHang.php">
                                <i class="fa-solid fa-file"></i> Đơn hàng
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="sanPham.php">
                                <i class="fa-solid fa-clipboard"></i> Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="danhMuc.php">
                                <i class="fa-solid fa-bars"></i> Danh mục
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="thongKe.php">
                                <i class="fa-solid fa-bag-shopping"></i> Thống kê
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="khachHang.php">
                                <i class="fas fa-users"></i> Khách hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nhanVien.php">
                                <i class="fa-solid fa-user"></i> Nhân viên
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="doiMatKhau.php">
                                <i class="fas fa-key"></i> Đổi mật khẩu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>