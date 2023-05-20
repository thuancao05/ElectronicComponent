<?php
include_once('../dbConnection.php');
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_login'])) {
    $userLogEmail = $_SESSION['userLogEmail'];
}
// else {
//  echo "<script> location.href='../index.php'; </script>";
// }
if (isset($userLogEmail)) {
    $sql = "SELECT nm_hinhAnh FROM nguoimua WHERE nm_email = '$userLogEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stu_img = $row['nm_hinhAnh'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap_thang.min.css">
    <!-- Font AweSome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>

<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">Sáng Tạo Điện Tử</a>
    </nav>

    <!-- Side Bar -->
    <div class="container-fluid mb-5 " style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3">
                            <img src="<?php echo $stu_img ?>" alt="studentimage" class="img-thumbnail rounded-circle">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (PAGE == 'profile') {
                                                    echo 'active';
                                                } ?>" href="thongTinNguoiMua.php">
                                <i class="fas fa-user"></i>
                                Thông tin tài khoản <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (PAGE == 'myorder') {
                                                    echo 'active';
                                                } ?>" href="myOrders.php">
                                <i class="fab fa-accessible-icon"></i>
                                Đơn hàng của bạn
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (PAGE == 'studentChangePass') {
                                                    echo 'active';
                                                } ?>" href="doiMatKhauNguoiMua.php">
                                <i class="fas fa-key"></i>
                                Đổi mật khẩu
                            </a>
                        </li>
                        <!-- Address Management 06/03/2023 -->
                        <li class="nav-item">
                            <a class="nav-link <?php if (PAGE == 'studentAddress') {
                                                    echo 'active';
                                                } ?>" href="diaChiNguoiMua.php">
                                <i class="fas fa-key"></i>
                                Địa chỉ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>