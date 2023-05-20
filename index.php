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
    padding: 1%;

}
.slider {
	padding-top: 3rem;
	padding-bottom: 3rem;
	background-color: #fbfbfb;
}

.slider h2 {
	margin-bottom: 0.75rem;
	text-align: center;
}

.slider .slider-container {
	position: relative;
}

.slider .swiper-container {
	position: static;
	width: 90%;
	text-align: center;
}

.slider .swiper-button-prev:focus,
.slider .swiper-button-next:focus {
	/* even if you can't see it chrome you can see it on mobile device */
	outline: none;
}

.slider .swiper-button-prev {
	left: -0.5rem;
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2028%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23787976'%2F%3E%3C%2Fsvg%3E");
	background-size: 1.125rem 1.75rem;
}

.slider .swiper-button-next {
	right: -0.5rem;
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2028%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23787976'%2F%3E%3C%2Fsvg%3E");
	background-size: 1.125rem 1.75rem;
}

.slider .card {
	position: relative;
	border: none;
	background-color: transparent;
}

.slider .card-image {
	width: 6rem;
	height: 6rem;
	margin-right: auto;
	margin-bottom: 0.25rem;
	margin-left: auto;
	border-radius: 50%;
}

.slider .card .card-body {
	padding-bottom: 0;
}

.slider .testimonial-text {
	margin-bottom: 0.625rem;
}

.slider .testimonial-author {
	color: #484a46;
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
                    $sql = "SELECT * FROM danhmuc ";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){
                        $dm_id = $row['dm_id'];
                        echo'<a href="sanPham.php?sp_id='.$dm_id.'" class="list-group-item list-group-item-action">'.$row['dm_ten'].'</a>';
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
        
        <h3 class="mt-5 mb-2 text-uppercase" style="font-size: 28px; font-family:Quicksand, sans-serif;">
            Sản Phẩm Mới
        </h3>
        <hr class="featurette-divider">

        <!-- Products List  -->
        
            <div class="row mt-4 autoplay" style="background: #E9ECEF;">
                <?php
                    $sql = "SELECT * FROM sanpham ORDER BY sp_id DESC LIMIT 0,12 ";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){
                        $sp_id = $row['sp_id'];
                        echo ' 
                            <div class="col">
                            <a href="thongTinSanPham.php?sp_id='.$sp_id.'" class="btn" style="text-align: left; padding:0px;">
                            <div class="card cardHolder">
                                <img src="'.str_replace('..', '.', $row['sp_hinhAnh']).'" class="card-img-top" alt="image" " />
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
                    ?>
            </div>
        
            
        <!-- End Products List --> 
        <h3 class="mt-5 mb-2 text-uppercase" style="font-size: 28px; font-family:Quicksand, sans-serif;">
            Sản Phẩm Bán Chạy
        </h3>
        <hr class="featurette-divider">
        <!-- Products List  -->
        
        <div class="row mt-4 autoplay" style="background: #E9ECEF;">
                <?php
                    $sql = "SELECT * FROM sanpham ORDER BY sp_daBan DESC LIMIT 0,12 ";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){
                        $sp_id = $row['sp_id'];
                        echo ' 
                            <div class="col">
                            <a href="thongTinSanPham.php?sp_id='.$sp_id.'" class="btn" style="text-align: left; padding:0px;">
                            <div class="card cardHolder">
                                <img src="'.str_replace('..', '.', $row['sp_hinhAnh']).'" class="card-img-top" alt="image" />
                                <div class="card-body ">
                                <h5 class="card-title" ">'.$row['sp_ten'].'</h5>
                                </div>
                                <div class="card-footer">
                                <p class="card-text d-inline">Giá: <small></small> <span class="font-weight-bolder">'.format_curency($row['sp_gia']).' &#8363;<span></p> <a href="thongTinSanPham.php?sp_id='.$sp_id.'"></a>
                                </div>
                            </div> </a>
                            </div>
                        ';
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