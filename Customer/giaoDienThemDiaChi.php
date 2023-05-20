<!-- Hiển thị form khi nhấn nút "Thêm" -->
<div class="modal fade" id="stuAddAdress" tabindex="-1" aria-labelledby="stuAddAdressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stuAddAdressLabel">THÊM ĐỊA CHỈ MỚI</h1>
               
            </div>
            <div class="modal-body">
                <!-- Start form -->
                <form role="form" id="stuRegForm">
                    <div class="form-group">
                    <input type="email" class="form-control" id="email" value="<?php echo $stuEmail ?>" readonly>

                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg1"></small>
                        <input type="text" class="form-control" placeholder="Họ tên" name="hoten" id="hoten">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg2"></small>
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="sodienthoai" id="sodienthoai">
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg3"></small>
                        <input type="text" class="form-control" placeholder="Số nhà" name="sonha" id="sonha" >
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg4"></small>
                        <select class="form-select thanhpho" aria-label="Default select example" id="thanhpho">

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
                        <small id="statusMsg5"></small>
                        <select class="form-select tinh" id="tinh" aria-label="Default select example">
                            <option selected>Quận huyện</option>


                        </select>
                    </div> <br>
                    <div class="form-group">
                        <small id="statusMsg6"></small>
                        <select class="form-select huyen" id="huyen" aria-label="Default select example">
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
                <!-- End form -->
            </div>
            <div class="modal-footer">
                <span id="successMsg"></span>
                <!-- <small id="statusMsg4"></small> -->
                <button type="button" class="btn btn-primary" onclick="addAddress()" id="themdiachi">Thêm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<?php  
include("./cusInclude/footer.php");
?>

