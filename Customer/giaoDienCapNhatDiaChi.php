<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Student Profile');
define('PAGE', 'studentAddress');
include('./cusInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['userLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
// $result = $conn->query($sql);
// if ($result->num_rows == 1) {
//     $row = $result->fetch_assoc();
//     $stuId = $row["stu_id"];
//     $stuName = $row["stu_name"];
//     $stuOcc = $row["stu_occ"];
//     $stuImg = $row["stu_img"];
//     $stuPhone = $row["stu_phone"];
//     $stuAddress = $row["stu_address"];
// }

if (isset($_REQUEST['updateStuNameBtn'])) {
    if (($_REQUEST['stuName'] == "")) {
        // msg displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
        $stuName = $_REQUEST["stuName"];
        $stuOcc = $_REQUEST["stuOcc"];

        $stuPhone = $_REQUEST["stuPhone"];
        $stuAddress = $_REQUEST["stuAddress"];

        $stu_image = $_FILES['stuImg']['name'];
        $stu_image_temp = $_FILES['stuImg']['tmp_name'];
        $img_folder = '../image/stu/' . $stu_image;
        move_uploaded_file($stu_image_temp, $img_folder);
        $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc', stu_phone = '$stuPhone', stu_address = '$stuAddress', stu_img = '$img_folder' WHERE stu_email = '$stuEmail'";
        if ($conn->query($sql) == TRUE) {
            // below msg display on form submit success
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        } else {
            // below msg display on form submit failed
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
        }
    }
}

?>

<div class="col-sm-6 mt-5">
<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stuAddAdressLabel">CẬP NhẬT ĐỊA CHỈ</h1>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <!-- Start student registration modal form -->

                <?php
                if (isset($_GET['dc_id'])) {
                    $dc_id = $_GET['dc_id'];

                    $_SESSION['dc_id'] = $dc_id;

                    $sql = "SELECT * FROM diachi WHERE dc_id = '$dc_id' ";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                }
                ?>

                <form role="form" id="stuRegForm">
                    <div class="form-group">
                        <!-- <label for="stuName">ID địa chỉ</label> -->
                        <input type="text" class="form-control" id="capnhat_diachi" value="<?php echo $row['dc_id'] ?>" readonly>

                    </div> <br>
                    <div class="form-group">
                        <input type="email" class="form-control" id="capnhat_email" value="<?php echo $row['nm_email'] ?>" readonly>

                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg1_capnhat"></small>
                        <input type="text" class="form-control" placeholder="Họ tên" name="capnhat_hoten" id="capnhat_hoten" value="<?php echo $row['dc_hoten'] ?>">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg2_capnhat"></small>
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="capnhat_sodienthoai" id="capnhat_sodienthoai" value="<?php echo $row['dc_sdt'] ?>">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg3_capnhat"></small>
                        <input type="text" class="form-control" placeholder="Số nhà" name="capnhat_sonha" id="capnhat_sonha" value="<?php echo $row['dc_sonha'] ?>">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg4_capnhat"></small>
                        <select class="form-select capnhat_thanhpho" aria-label="Default select example" id="capnhat_thanhpho">

                            <option selected>Thành phố</option>
                            <?php
                            include_once('../dbconnection.php');
                            $sql = "SELECT * FROM devvn_tinhthanhpho";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['matp'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg5_capnhat"></small>
                        <select class="form-select capnhat_tinh" id="capnhat_tinh" aria-label="Default select example">
                            <option selected>Quận huyện</option>


                        </select>
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg6_capnhat"></small>
                        <select class="form-select capnhat_huyen" id="capnhat_huyen" aria-label="Default select example">
                            <option selected>Phường xã</option>

                        </select>
                    </div> <br>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Đặt làm địa chỉ mặt định?
                            </label>
                        </div>
                    </div> <br>
                </form>
                <!-- End student registration modal form -->
            </div>
            <div class="modal-footer">
                <span id="successMsg"></span>
                <button type="button" class="btn btn-primary" onclick="updateAddress()" id="themdiachi"> Cập nhật </button>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> -->
                <a href="./diaChiNguoiMua.php" class="btn btn-secondary" style="margin: 10px;"> Đóng </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="./ajaxThemDiaChi.js"></script>
<script type="text/javascript" src="./ajaxTaiDuLieuDiaChi.js"></script>
<script type="text/javascript" src="./ajaxCapNhatDiaChi.js"></script>

<?php
include('./cusInclude/footer.php');
?>