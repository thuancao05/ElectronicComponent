<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once('../dbConnection.php');
include('../staff/format.php');

//staff login verification
if(!isset($_SESSION['is_staff_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['staffLogEmail']) && isset($_POST['staffLogPass'])){
        $staffLogEmail = $_POST['staffLogEmail'];
        $staffLogPass = $_POST['staffLogPass'];

        $sql = "SELECT nv_email, nv_matKhau FROM nhanvien WHERE nv_email = '".$staffLogEmail."' AND nv_matKhau = '".$staffLogPass."' ";

        $result = $conn -> query($sql);

        $row = $result -> num_rows;

        if($row === 1){
            $_SESSION['is_staff_login'] = true;
            $_SESSION['staffLogEmail'] = $staffLogEmail;
            echo json_encode($row);
        }
        else if ($row === 0){
            echo json_encode($row);
        }
    }
}


?>
