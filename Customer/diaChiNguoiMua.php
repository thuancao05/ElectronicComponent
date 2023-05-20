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
?>

<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <div class="form-group">

            <h1>Địa chỉ của bạn</h1> <span id="soluongdiachi"></span>
        </div>

        <a href="#" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#stuAddAdress"> Thêm </a> 
        <?php if (isset($passmsg)) {
            echo $passmsg;
        } ?>
        <!-- Địa chỉ -->
        <?php
        // Đếm số lượng địa chỉ
        $sql2 = "SELECT COUNT(dc_id) as sldc FROM diachi WHERE nm_email='$stuEmail'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $soluongdiachi = $row['sldc'];
                echo '
                <h2>Số lượng địa chỉ của bạn (' . $soluongdiachi . ') </h2>
                ';
            }
        }

        // Hiển thị 3 địa chỉ WHERE '$stuEmail'
        $sql = "SELECT * FROM diachi WHERE nm_email= '$stuEmail' LIMIT 0,12 ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dc_id = $row['dc_id']; // Cần chỉnh sau
                $hoten = $row['dc_hoten'];
                $sdt = $row['dc_sdt'];
                $sonha = $row['dc_sonha'];
                $thanhpho = $row['dc_thanhpho'];
                $huyen = $row['dc_tinh'];
                $xa = $row['dc_xa'];
                $email = $row['nm_email'];
                echo '
                        <div class="form-group">
                            <b>ID địa chỉ:</b> ' . $dc_id . '
                        </div>
                        <div class="form-group">
                            <b>Họ tên:</b> ' . $hoten . '
                        </div>
                        <div class="form-group">
                            <b>Email:</b> ' . $email . '
                        </div>
                        <div class="form-group">
                            <b>Địa chỉ:</b> ' . $sonha . ', ' . $xa . ', ' . $huyen . ', ' . $thanhpho . '
                        </div>

                        <div class="form-group">
                            <b>Số điện thoại:</b> ' . $sdt . '
                        </div>
                        <div class="form-group">
                           
                                    <a href="./giaoDienCapNhatDiaChi.php?dc_id='.$dc_id.'" class="btn btn-primary" > Chỉnh sửa địa chỉ </a>

                                    <input type="hidden" name="idDelete" value='.$dc_id.'>
                                    <button type="submit" class="btn btn-danger" name="delete" value="Delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>

                        </div>
                        <br> 
                    ';
            }
        }
        // Xóa địa chỉ
        if (isset($_REQUEST['delete'])) { //name="delete" của button
            $sql = "DELETE FROM diachi WHERE dc_id = {$_REQUEST['idDelete']}"; // "id" name="id" của thẻ input
            if ($conn->query($sql) == TRUE) {
                echo '
            <script>
                alert("Xóa thành công")
            </script>';
                echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
            } else {
                echo "Unable to Delete Data";
            }
        }
        ?>

    </form>
</div>
<?php
include('./cusInclude/footer.php');
include('./giaoDienThemDiaChi.php');
?>