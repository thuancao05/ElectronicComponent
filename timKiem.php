<!-- Start Including Header -->
<?php
include('./dbconnection.php');
include('./mainInclude/header.php');
include('./admin/format.php');

?>
<?php
if (isset($_POST['btnSearch'])) {
    extract($_REQUEST);
    $sql = "SELECT * FROM sanpham WHERE LOWER(sp_ten) LIKE  LOWER('%$search%')";
    // echo $sql; die;
     $stmt = $conn-> prepare($sql);
     $stmt->execute();
     $resultSet = $stmt->get_result();
     $search1 = $resultSet->fetch_all(MYSQLI_ASSOC);
}
?>
<!-- End Including Header -->


<!-- style.css not working!!! -->
<style>
  .productContainer {
    width:80%;
    min-height: 440px;
    padding-right:15px;
    padding-left:15px;
    padding-bottom: 15px;
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
    <div class="header-page text-center">
        <h1 style="font-size: 32px; padding: 5px; padding-top: 20px">Tìm kiếm</h1>
        <?php if(isset($search)) : ?>
        <?php if (count($search1) > 0) { ?>
            <p class="text mt-2">Có <span><?php echo count($search1) ?></span> sản phẩm cho tìm kiếm sản phẩm "<span class="font-weight-bold"><?= $search ?></span>"</p>
            <?php } ?>
            <?php if (count($search1) == 0) { ?>
                <h5 class="mt-3">Không tìm thấy nội dung yêu cầu</h5>
                <p>Không tìm thấy "<span class="font-weight-bold"><?= $search ?></span>" . Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</p>
            <?php } ?>
            <?php endif; ?>

        <div style="width: 9%;height: 3px;background-color: #050505;" class="mx-auto"></div>

        <form action="" class="mt-3 d-flex justify-content-start" method="post">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-4"></div>
                    <div class="col-xl-4 d-flex justify-content-start">
                        <input type="text" name="search" class="form-control" value="" required>
                        <button type="submit" name="btnSearch" style="border:none; background: #fff">
                            <a href="#"><i class="fas fa-search mx-2"></i></a>
                        </button>
                    </div>
                    <div class="col-xl-4"></div>
                </div>
            </div>
        </form>
    </div>
<!-- Show up -->
<hr class="featurette-divider">
<!-- Products List  -->
    <div class="row mt-4" style="background: #E9ECEF;">
        <?php if(isset($search)) :?>
            <?php foreach ($search1 as $c) : ?>
                <div class="col-md-2">
                    <div class="product-hover mt-5">
                        <div class="col">
                            <a href="thongTinSanPham.php?sp_id=<?= $c['sp_id'] ?>" class="btn" style="text-align: left; padding:0px;">
                                <div class="card cardHolder">
                                    <img src="./image/<?= $c['sp_hinhAnh'] ?>" class="card-img-top" alt="image">
                                    <div class="card-body">
                                    <h5 class="card-title"><?= $c['sp_ten'] ?></h5>
                                    </div>
                                    <div class="card-footer">
                                    <p class="card-text d-inline">Giá: <small></small> <span class="font-weight-bolder"><?= format_curency($c['sp_gia']) ?> &#8363;<span></p> <a href="thongTinSanPham.php?sp_id=<?= $c['sp_id'] ?>"></a>
                                    </div>
                                </div> 
                            </a>
                        </div>    
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif;?>
    </div>
<!-- End Products List --> 
        
</div>
<hr class="featurette-divider">

<!-- Start Including Footer -->
<?php
include('./mainInclude/footer.php')
?>
<!-- End Including Footer -->
