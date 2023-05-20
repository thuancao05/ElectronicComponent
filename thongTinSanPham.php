<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
  include('./admin/format.php');

?>  
<style>
  .productContainer {
    width:100%;
    padding-right:15px;
    padding-left:15px;
    margin-right:auto;
    margin-left:auto;
    background-color: #f5fff0;
  }
.cardHolder:hover{
    padding: 3%;

}
</style>  
<div class="productContainer">
    <div class="row">
        <div class="container mt-5"> <!-- Start All Products -->
        <!-- Thêm sản phẩm vào giỏ
              1. Lấy thông tin sản phẩm (Form)

        -->
            <?php
                if(isset($_GET['sp_id'])){
                $sp_id = $_GET['sp_id'];
                $_SESSION['sp_id'] = $sp_id;
                $sql = "SELECT * FROM sanpham WHERE sp_id = '$sp_id'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){ 
                  while($row = $result->fetch_assoc()){
                    echo ' 
                    <form action="themVaoGioHang.php" method="POST">
                    <div class="row">
                       
                                  <div class="col-md-4">
                                    <img src="'.str_replace('..', '.', $row['sp_hinhAnh']).'" class="card-img-top" alt="Image" />
                                  </div>
                                <div class="col-md-8">
                                  <div class="card-body">
                                      <h5 class="card-title">Tên sản phẩm: '.$row['sp_ten'].'</h5>
                                      <p class="card-text">Giá:  <span class="font-weight-bolder"> '.format_curency($row['sp_gia']).' &#8363;<span></p>
                                      <p class="card-text">Mô tả sản phẩm: '.$row['sp_moTa'].'</p>
                                  
                                      <input type="hidden" name="id" value='. $row["sp_gia"] .'> 
                                      <div>
                                          <label id="text-des" for="cars">Số lượng: </label>
                                          <span style="position: relative;margin-left: 12px;">

                                          <input type="number" name="sp_soLuong" max="100" min="1" size="3" value="1">
                                          
                                         
                                          <input class="btn btn-primary" type="submit" value="Thêm vào giỏ hàng" name="themGioHang">
                                          </span>
                                      </div>                        
                                  </div>

                                  <input type="hidden" name="sp_id" value="'.$row['sp_id'].'">
                                  <input type="hidden" name="sp_ten" value="'.$row['sp_ten'].'">
                                  <input type="hidden" name="sp_hinhAnh" value="'.$row['sp_hinhAnh'].'">
                                  <input type="hidden" name="sp_gia" value="'.$row['sp_gia'].'">

                      </div>
                      </form>
                    ';
                  }
                }
              }
              ?>   
        </div><!-- End All Products -->   
        <hr class="featurette-divider">
        <h6>SẢN PHẨM LIÊN QUAN</h6>
    </div>  
    <div class="row container mt-4" style="background: #f5fff0; margin-left: 20%;">
        <?php
            $sp_id = $_GET['sp_id'];
            $sql = "SELECT * FROM sanpham WHERE dm_id = (SELECT dm_id FROM sanpham WHERE sp_id = '$sp_id')";
            $result = $conn->query($sql);
            if($result->num_rows > 0){ 
                while($row = $result->fetch_assoc()){
                $sp_id = $row['sp_id'];
                echo ' 
                    <div class="col-sm-2 mb-2">
                    <a href="thongTinSanPham.php?sp_id='.$sp_id.'" class="btn" style="text-align: left; padding:0px;">
                    <div class="card cardHolder">
                        <img src="'.str_replace('..', '.', $row['sp_hinhAnh']).'" class="card-img-top" alt="image" />
                        <div class="card-body">
                        <h5 class="card-title">'.$row['sp_ten'].'</h5>
                        </div>
                        <div class="card-footer">
                        <p class="card-text d-inline">Giá: <small></small> <span class="font-weight-bolder">&#8363; '.format_curency($row['sp_gia']).'<span></p> <a href="thongTinSanPham.php?sp_id='.$sp_id.'"></a>
                        </div>
                    </div> </a>
                    </div>
                ';
                }
            }
            ?>
        </div>
</div>
               
      
<?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>  
