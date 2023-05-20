<!-- Contact & Maps -->
<div class="container-fluid p-4" style="background-color:#E9ECEF">
    <div class="cotainer">
        <div class="maps container-fluid" style="background-image: url('img/home/main3.png');" id="contactus">
            <div class="row">
                <div class="col">
                    <div class="row text-center">
                        <div class="col-sm">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841518408653!2d105.76842661474251!3d10.029933692830634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zxJDhuqFpIGjhu41jIEPhuqduIFRoxqE!5e0!3m2!1svi!2s!4v1639566053317!5m2!1svi!2s"
                                    width="100%"  height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="col-sm">
                            <h5>Thông Tin Liên Hệ</h5>
                            <p>Địa chỉ: Số 01 Hẻm 216 Đường 3/2, Hưng Lợi, Ninh Kiều, Tp Cần Thơ. <br />
                                ✔ Cửa hàng trực tiếp: 0963.288.854 <br />

                                ✔ Hỗ trợ đơn website: 0865.853.416 <br />

                                ✔ Kĩ thuật: 0969.477.417 <br />

                                Email: linhkiendientu@gmail.com</p>
                        </div>
                        <div class="col-sm">
                            <h5>Hỗ Trợ</h5>
                            
                            <a href="https://twitter.com/" > </i><i class="fab fa-twitter"></i> Twitter
                            </a><br />

                            <a href="https://www.facebook.com/sangtaodientu.cantho"> <i class="fab fa-facebook-f"></i> Facebook
                            </a><br />

                            <a href="https://www.youtube.com/@sangtaodientu" >
                                <i class="fab fa-youtube"></i> Youtube
                            </a>
                        </div>
                        
                    </div>    
                </div>
                
            </div>
        </div>    
    </div>
</div>
<!-- End About Section -->
<!-- Start footer -->
<footer class="container-fluid bg-dark text-center p-2">
    <small class="text-white">Copyright &copy; 2023 || Sáng Tạo Điện Tử || 
        <?php 
            if(isset($_SESSION['is_admin_login'])){
                echo '<a href="admin/adminDashboard.php"> Admin Dashboard</a> <a href="logout.php">Logout</a>';
            }else{
                echo '<a href="#" data-toggle="modal" data-target="#adminLoginModal">Admin Login || </a> ';
                echo '<a href="#" data-toggle="modal" data-target="#staffLoginModal">Staff Login </a></small>';
            }
        ?>
    
</footer>
<!-- End footer -->


<!-- Start User Registration Modal -->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="signupModal">Registration</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Start Student Registration Form -->
                <?php
                    include('userRegistration.php');
                ?>
                <!-- End Student Registration Form -->
            </div>
            <div class="modal-footer">
                <span id="successMsg"></span>
                <button type="button" class="btn btn-primary" id="userSignupBtn" onclick="addUser()">Sign Up</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- End Student Registration Modal -->

<!-- Start Student Login Modal -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="loginModal">Login</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Start User Login Form -->
                <form class="loginModal">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i><label for="userLogEmail" style=" font-weight: bold; padding-left: 10px;">Email</label>
                        <br><input type="email" class="form-control" id="userLogEmail" name="userLogEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i> <label for="userLogPass" style="font-weight: bold; padding-left: 8px;">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="userLogPass" id="userLogPass">
                    </div>
                </form>
                <!-- End User login Form -->
            </div>
            <div class="modal-footer">
                <small id="statusLogMsg"></small> 
                <button type="button" class="btn btn-primary" id="userLoginBtn" onclick="checkUserLogin()">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<!-- End Student Login Modal -->

<!-- Start Admin Login Modal -->

<!-- Modal -->
<div class="modal fade" id="adminLoginModal" tabindex="-1" role="dialog" aria-labelledby="adminLoginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="adminLoginModal">Admin Login</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Start admin Login Form -->
                <form id="adminLoginModal">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i><label for="adminLogEmail" style=" font-weight: bold; padding-left: 10px;">Email</label>
                        <br><input type="email" class="form-control" id="adminLogemail" name="adminLogEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i> <label for="adminLogPass" style="font-weight: bold; padding-left: 8px;">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="adminLogPass" , id="adminLogpass">
                    </div>
                </form>
                <!-- End admin login Form -->
            </div>
            <div class="modal-footer">
                <small id="statusAdminLogMsg"></small> 
                <button type="button" class="btn btn-primary" id="adminloginBtn" onclick="checkAdminLogin()">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<!-- End Admin Login Modal -->


<!-- Start staff Login Modal -->

<!-- Modal -->
<div class="modal fade" id="staffLoginModal" tabindex="-1" role="dialog" aria-labelledby="staffLoginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staffLoginModal">Staff Login</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Start staff Login Form -->
                <form id="staffLoginModal">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i><label for="staffLogEmail" style=" font-weight: bold; padding-left: 10px;">Email</label>
                        <br><input type="email" class="form-control" id="staffLogEmail" name="staffLogEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i> <label for="staffLogPass" style="font-weight: bold; padding-left: 8px;">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="staffLogPass" , id="staffLogPass">
                    </div>
                </form>
                <!-- End staff login Form -->
            </div>
            <div class="modal-footer">
                <small id="statusStaffLogMsg"></small> 
                <button type="button" class="btn btn-primary" id="staffloginBtn" onclick="checkStaffLogin()">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<!-- End staff Login Modal -->




<!-- Jquery and Bootstrap Javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Font Awesome JS-->
<script src="js/all.min.js"></script>
<script src="https://kit.fontawesome.com/9ac8be3ee8.js" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/ajaxrequest.js"></script>
<script type="text/javascript" src="js/nguoiBan.js"></script>
<script type="text/javascript" src="js/staff.js"></script>

<script type="text/javascript" src="js/gioHang.js"></script>

<!-- slick slider -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type= "text/javascript">
    $('.autoplay').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 4000,
});
</script> 
<!-- Customize JS -->

</body>

</html>
<?php  ob_flush(); ?>