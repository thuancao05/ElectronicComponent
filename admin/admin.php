<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once('../dbConnection.php');
include('../admin/format.php');

//admin login verification
if(!isset($_SESSION['is_admin_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['adminLogEmail']) && isset($_POST['adminLogPass'])){
        $adminLogEmail = $_POST['adminLogEmail'];
        $adminLogPass = $_POST['adminLogPass'];

        $sql = "SELECT nb_email, nb_matKhau FROM nguoiban WHERE nb_email = '".$adminLogEmail."' AND nb_matKhau = '".$adminLogPass."' ";

        $result = $conn -> query($sql);

        $row = $result -> num_rows;

        if($row === 1){
            $_SESSION['is_admin_login'] = true;
            $_SESSION['adminLogEmail'] = $adminLogEmail;
            echo json_encode($row);
        }
        else if ($row === 0){
            echo json_encode($row);
        }
    }
}

//load data dasboard
$enddate = date("Y-m-d");
if(isset($_POST['seven_day'])){
    $newdate = strtotime ( '-7 day' , strtotime ( $enddate ) ) ;
    $startdate = date ( 'Y-m-d' , $newdate );
        $sql = "SELECT COUNT(dh_id) FROM donHang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql);
        $row = $result-> fetch_assoc();
        $quantity =  $row['COUNT(dh_id)'] ;
        
        $sql1 = "SELECT SUM(dh_tongThanhToan)
                FROM donhang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql1);
        $row = $result-> fetch_assoc();
        $sum =  $row['SUM(dh_tongThanhToan)'] ;
                            
        $sql2 = "SELECT COUNT(sp_id) FROM sanPham WHERE sp_soLuong < 5";
        $result = $conn->query($sql2);
         $row = $result-> fetch_assoc();
         $oos =  $row['COUNT(sp_id)'] ;
if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE){
    $output = '
        <div class="col-sm-4 mt-5" >
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">Đơn hàng</div>
                    <div class="card-body">
                        <h4 class="card-title" >'.$quantity.'</h4>
                        <a class="btn text-white" href="donHang.php">Xem</a>
                    </div>
                </div>
        </div>
            <div class="col-sm-4 mt-5">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                     <div class="card-header">Doanh thu</div>
                     <div class="card-body">
                         <h4 class="card-title">'.format_curency($sum).'VND </h4>
                         <a class="btn text-white" href="thongKe.php">Xem</a>
                            
                     </div>
                 </div>
             </div>
             <div class="col-sm-4 mt-5">
                                  <div class="card text-white bg-info mb-3" style="max-width: 18rem;" onclick="lessons.php">
                                     <div class="card-header">Sản phẩm sắp hết</div>
                                      <div class="card-body">
                                          <h4 class="card-title">'.$oos.' </h4>
                                          <a class="btn text-white" href="sanPham.php">Xem</a>
                                      </div>
                                  </div>
                              </div>';

            echo json_encode($output);
        }
        else{
            echo json_encode("Failed");
        }
        
    
}

if(isset($_POST['thirty_day'])){
    $newdate = strtotime ( '-30 day' , strtotime ( $enddate ) ) ;
    $startdate = date ( 'Y-m-d' , $newdate );
    $sql = "SELECT COUNT(dh_id) FROM donHang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
    $result = $conn->query($sql);
    $row = $result-> fetch_assoc();
    $quantity =  $row['COUNT(dh_id)'] ;
    
    $sql1 = "SELECT SUM(dh_tongThanhToan)
            FROM donhang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
    $result = $conn->query($sql1);
    $row = $result-> fetch_assoc();
    $sum =  $row['SUM(dh_tongThanhToan)'] ; 

    $sql2 = "SELECT COUNT(sp_id) FROM sanPham WHERE sp_soLuong < 5";
                $result = $conn->query($sql2);
                 $row = $result-> fetch_assoc();
                 $oos =  $row['COUNT(sp_id)'] ;

    
        if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE){
            $output = '
                <div class="col-sm-4 mt-5" >
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Đơn hàng</div>
                            <div class="card-body">
                                <h4 class="card-title" >'.$quantity.'</h4>
                                <a class="btn text-white" href="donHang.php">Xem</a>
                            </div>
                        </div>
                </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                             <div class="card-header">Doanh thu</div>
                             <div class="card-body">
                                 <h4 class="card-title">'.format_curency($sum).'VND </h4>
                                 <a class="btn text-white" href="thongKe.php">Xem</a>
                                    
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-4 mt-5">
                                          <div class="card text-white bg-info mb-3" style="max-width: 18rem;" onclick="lessons.php">
                                             <div class="card-header">Sản phẩm sắp hết</div>
                                              <div class="card-body">
                                                  <h4 class="card-title">'.$oos.' </h4>
                                                  <a class="btn text-white" href="sanPham.php">Xem</a>
                                              </div>
                                          </div>
                                      </div>';

            echo json_encode($output);
        }
        else{
            echo json_encode("Failed");
        }
        
    
}

if(isset($_POST['all_day'])){
    $sql = "SELECT COUNT(dh_id) FROM donHang";
    $result = $conn->query($sql);
    $row = $result-> fetch_assoc();
    $quantity =  $row['COUNT(dh_id)'] ;
    
    $sql1 = "SELECT SUM(dh_tongThanhToan)
            FROM donhang";
    $result = $conn->query($sql1);
    $row = $result-> fetch_assoc();
    $sum =  $row['SUM(dh_tongThanhToan)'] ;
    
    $sql2 = "SELECT COUNT(sp_id) FROM sanPham WHERE sp_soLuong < 5";
                $result = $conn->query($sql2);
                 $row = $result-> fetch_assoc();
                 $oos =  $row['COUNT(sp_id)'] ;
        if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE){
            $output = '
                <div class="col-sm-4 mt-5" >
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Đơn hàng</div>
                            <div class="card-body">
                                <h4 class="card-title" >'.$quantity.'</h4>
                                <a class="btn text-white" href="donHang.php">Xem</a>
                            </div>
                        </div>
                </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                             <div class="card-header">Doanh thu</div>
                             <div class="card-body">
                                 <h4 class="card-title">'.format_curency($sum).'VND </h4>
                                 <a class="btn text-white" href="thongKe.php">Xem</a>
                                    
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-4 mt-5">
                                          <div class="card text-white bg-info mb-3" style="max-width: 18rem;" onclick="lessons.php">
                                             <div class="card-header">Sản phẩm sắp hết</div>
                                              <div class="card-body">
                                                  <h4 class="card-title">'.$oos.' </h4>
                                                  <a class="btn text-white" href="sanPham.php">Xem</a>
                                              </div>
                                          </div>
                                      </div>';

            echo json_encode($output);
        }
        else{
            echo json_encode("Failed");
        }
        
    
}

?>
