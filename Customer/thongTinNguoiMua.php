<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Customer Profile');
define('PAGE', 'profile');

include('./cusInclude/header.php');

include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['userLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

$sql = "SELECT * FROM nguoimua WHERE nm_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuId = $row["nm_id"];
    $stuName = $row["nm_ten"];
    $stuImg = $row["nm_hinhAnh"];
    
}

if (isset($_REQUEST['updateStuNameBtn'])) {
    if (($_REQUEST['stuName'] == "")) {
        // msg displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
        $stuName = $_REQUEST["stuName"];
        
        $stu_image = $_FILES['stuImg']['name'];
        $stu_image_temp = $_FILES['stuImg']['tmp_name'];
        $img_folder = '../image/nguoimua/' . $stu_image;
        move_uploaded_file($stu_image_temp, $img_folder);
        $sql = "UPDATE nguoimua SET nm_ten = '$stuName', nm_hinhAnh = '$img_folder' WHERE nm_email = '$stuEmail'";
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
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="stuId">ID Khách Hàng</label>
            <input type="text" class="form-control" id="stuId" name="stuId" value=" <?php if (isset($stuId)) {
                                                                                        echo $stuId;
                                                                                    } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stuEmail">Email</label>
            <input type="email" class="form-control" id="stuEmail" value=" <?php echo $stuEmail ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stuName">Tên Khách Hàng</label>
            <input type="text" class="form-control" id="stuName" name="stuName" value="<?php if (isset($stuName)) {
                                                                                            echo $stuName;
                                                                                        } ?>">
        </div>
        <div class="form-group">
            <label for="stuImg">Tải ảnh lên</label>
            <input type="file" class="form-control-file" id="stuImg" name="stuImg">
        </div>
        <button type="submit" class="btn btn-primary" name="updateStuNameBtn">Tải lên</button>
        <?php if (isset($passmsg)) {
            echo $passmsg;
        } ?>
    </form>
</div>

<?php
include('./cusInclude/footer.php');
?>