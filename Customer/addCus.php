
<?php
if (!isset($_SESSION)) { // Nếu chưa có sesion thì start
    session_start();
}
/*
    Ngày 14/01/2023
    Thực hiện thêm student (tên, email, mật khẩu) khi signup vào csdl "student"
    1. Kết nối csdl
    2. Thực hiện thêm
    3. Kiểm tra email nhập vào có tồn tại trong csdl chưa
*/
include_once("../dbconnection.php"); // Kết nối csdl

// Checking email registration
if (isset($_POST['checkemail']) && isset($_POST['useremail'])) {
    $useremail = $_POST['useremail'];
    $sql = "SELECT mn_email FROM nguoimua WHERE nm_email ='" . $useremail . "'";
    $result = $conn->query($sql);
    $row = $result->num_rows;
    echo json_encode($row);
}

// Insert student
// isset hàm kiểm tra một biến dữ liệu có xác định và khác NULL hay không?
if (isset($_POST['userSignup']) && isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['userpass'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userpass = $_POST['userpass'];

    $sql = "INSERT INTO nguoimua(nm_ten, nm_email, nm_matKhau) VALUE ('$username' ,'$useremail', '$userpass')";

    if ($conn->query($sql) == TRUE) {
        echo json_encode("OK");
    } else {
        echo json_encode("Failed");
    }
}

// Student Login Verification
/* 
    Nhận thông tin "function checkUserLogin()" của "ajaxrequest.js"
*/

if (!isset($_SESSION['is_login'])) { // Nếu chưa login thì tiến hành kiểm tra email + pass
    if (isset($_POST['checkLogEmail']) && isset($_POST['userLogEmail']) && isset($_POST['userLogPass'])) {

        $userLogEmail = $_POST['userLogEmail'];
        $userLogPass = $_POST['userLogPass'];

        $sql = "SELECT nm_email, nm_matKhau FROM nguoimua WHERE nm_email ='" . $userLogEmail . "' AND nm_matKhau='" . $userLogPass . "'";

        $result = $conn->query($sql);
        $row = $result->num_rows;

        if ($row === 1) {
            $_SESSION['is_login'] = true;
            $_SESSION['userLogEmail'] = $userLogEmail;
            echo json_encode($row);
        } else if ($row === 0) {
            echo json_encode($row);
        }
    }
}
?>
