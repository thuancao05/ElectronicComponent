<!-- Start Including Header -->
<?php

include('./dbconnection.php');
include('./mainInclude/header.php');
include('./admin/format.php');
?>
<!-- End Including Header -->


<!-- style.css not working!!! -->
<style>
  .productContainer {
    width:80%;
    padding-right:15px;
    padding-left:15px;
    margin-right:auto;
    margin-left:auto;
    background-color: #E9ECEF;
  }
.cardHolder:hover{
    padding: 3%;

}
</style>      
<!-- WEBPAGE -->
<div class="productContainer">
    <!-- Each Components -->
    <div class="row">
        <!-- Product Category -->
        <div class="col-sm-3">      
                <div class="list-group mt-4">
                    <a href="#" class="list-group-item list-group-item-action active">
                    Danh Mục Sản Phẩm
                    </a>
                    <?php
                    $sql = "SELECT * FROM danhmuc";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){
                        $dm_id = $row['dm_id'];
                        echo'<a href="sanPham.php?dm_id='.$dm_id.'" class="list-group-item list-group-item-action">'.$row['dm_ten'].'</a>';
                        }
                    }
                    ?>
                </div>        
        </div>
        <!-- End Product Category -->
        <!-- Main View -->
        <div class="col-sm-9"> 
        
        <!-- Slider -->
            <div class="row mt-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./image/banner/photo-1555664424-778a1e5e1b48_new.jpg" class="d-block w-100" alt="..." class="slider_img">
                            <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div> -->
                        </div>
                        <div class="carousel-item">
                            <img src="./image/banner/photo-1557701197-2f99da0922dd_new.jpg" class="d-block w-100" alt="..." class="slider_img">
                            <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div> -->
                        </div>
                        <div class="carousel-item">
                            <img src="./image/banner/photo-1579803168341-9691c1852995_new.jpg" class="d-block w-100" alt="..." class="slider_img">
                            <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div> -->
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>    
        <!-- end Slider -->     
            <?php 
                $dm_id = $_GET['dm_id'];
                $sql = "SELECT * FROM danhmuc WHERE dm_id = '$dm_id'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){ 
                    while($row = $result->fetch_assoc()){            
                    echo '<h3 class="mt-5 mb-2 text-uppercase" style="font-size: 28px; font-family:Quicksand, sans-serif;margin-left: 20px"> '.$row['dm_ten'].' </h3>'; 
                    }
                }
                    
            ?>
        <hr class="featurette-divider">
        <!-- Products List  -->
            <div class="row mt-4" style="background: #E9ECEF;">
                <?php
                    $dm_id = $_GET['dm_id'];
                    
                    $sql = "SELECT * FROM sanpham WHERE dm_id = '$dm_id'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){ 
                        if($dm_id != ''){
                            while($row = $result->fetch_assoc()){
                            $sp_id = $row['sp_id'];
                            echo ' 
                                <div class="col-sm-3 mb-3">
                                <a href="thongTinSanPham.php?sp_id='.$sp_id.'" class="btn" style="text-align: left; padding:0px;">
                                <div class="card cardHolder">
                                    <img src="'.str_replace('..', '.', $row['sp_hinhAnh']).'" class="card-img-top" alt="image" />
                                    <div class="card-body">
                                    <h5 class="card-title">'.$row['sp_ten'].'</h5>
                                    </div>
                                    <div class="card-footer">
                                    <p class="card-text d-inline">Giá: <small></small> <span class="font-weight-bolder">'.format_curency($row['sp_gia']).' &#8363;<span></p> <a href="thongTinSanPham.php?sp_id='.$sp_id.'"></a>
                                    </div>
                                </div> </a>
                                </div>
                            ';
                            }
                        }
                    }
                    ?>
            </div>
        <!-- End Products List --> 
        
        </div>     
    </div> 
    <hr class="featurette-divider">
    <!-- Each components -->

</div>
<!-- End WEBPAGE -->



<!-- Start Including Footer -->
<?php
include('./mainInclude/footer.php')
?>
<!-- End Including Footer -->