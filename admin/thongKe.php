<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Sell Report');
define('PAGE', 'sellreport');
include('./adminInclude/header.php'); 
include('../dbConnection.php');
include('../admin/format.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 $date = date("Y-m-d");
 $newdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
 $newdate = date ( 'Y-m-d' , $newdate );


echo '<div class="col-sm-7 mt-5">
      <h4 class="bg-dark text-white p-2">Thống kê</h4>
      <form action="" method="POST" class="d-print-none">
        <div class="form-row">
          <div class="form-group col-md-3">
            <input type="date" class="form-control" id="startdate" name="startdate" value='.$newdate.' >
          </div> <span> to </span>
          <div class="form-group col-md-3">
            <input type="date" class="form-control" id="enddate" name="enddate" value='.$date.'>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
          </div>
        </div>
      </form>';
      ?>

      <?php

    if(isset($_REQUEST['searchsubmit'])){
        $startdate = $_REQUEST['startdate'];
        $enddate = $_REQUEST['enddate'];
        // $sql = "SELECT * FROM courseorder WHERE order_date BETWEEN '2018-10-11' AND '2018-10-13'";
        $sql = "SELECT * FROM donHang AS dh JOIN trangThai AS tt
                          JOIN nguoiMua AS nm
         WHERE dh.tt_id = tt.tt_id AND dh.nm_id = nm.nm_id AND dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
        echo '
        <div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID đơn hàng</th>
                <th scope="col">Tên người nhận</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Tổng thanh toán</th>
              </tr>
            </thead>
            <tbody>';
            while($row = $result->fetch_assoc()){
              echo '<tr>
                <th scope="row">'.$row["dh_id"].'</th>
                <td>'.$row["nm_ten"].'</td>
                <td>'.$row["tt_ten"].'</td>
                <td>'.$row["dh_ngayDat"].'</td>
                <td>'.format_curency($row["dh_tongThanhToan"]).'</td>
              </tr>';
            }
            $sql = "SELECT COUNT(dh_id)
                    FROM donHang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate';";
            $result = $conn->query($sql);
            $row = $result-> fetch_assoc();
            $quantity =  $row['COUNT(dh_id)'] ;
            $sql = "SELECT SUM(dh_tongThanhToan)
                    FROM donHang WHERE dh_ngayDat BETWEEN '$startdate' AND '$enddate';";
            $result = $conn->query($sql);
            $row = $result-> fetch_assoc();
            $sum =  $row['SUM(dh_tongThanhToan)'] ;
echo         '<h5 class=" bg-dark text-white p-2 mt-4">'.$quantity.' Đơn hàng - '.format_curency($sum).'VND </h5>';
            echo '<tr>
            <td><form class="d-print-none"><input class="btn btn-danger" type="submit" value="Print" onClick="window.print()"></form></td>
          </tr></tbody>
          </table>
        </div>';
       
      
   echo  '</div>';

        for($i= 1; $i <= 5; $i++){
            $sql = "SELECT COUNT(dh_id) FROM donHang WHERE tt_id = '$i'
                    AND dh_ngayDat BETWEEN '$startdate' AND '$enddate'";
            $result = $conn->query($sql);
            $row = $result-> fetch_assoc();
            if($i==1 && $quantity > 0){
              $s1 =  100*$row['COUNT(dh_id)']/$quantity ; 
            }
            if($i==2 && $quantity > 0){
              $s2 =  100*$row['COUNT(dh_id)']/$quantity ; 
            }
            if($i==3 && $quantity > 0){
              $s3 =  100*$row['COUNT(dh_id)']/$quantity ; 
            }
            if($i==4 && $quantity > 0){
              $s4 =  100*$row['COUNT(dh_id)']/$quantity ; 
            }
            if($i==5 && $quantity > 0 ){
              $s5 =  100*$row['COUNT(dh_id)']/$quantity ; 
            }
            
        }


        $dataPoints = array( 
          array("label"=>"Chờ xử lý", "y"=>$s1),
          array("label"=>"Đã xác nhận", "y"=>$s2),
          array("label"=>"Đang vận chuyển", "y"=>$s3),
          array("label"=>"Đã giao hàng", "y"=>$s4),
          array("label"=>"Đã hủy", "y"=>$s5)
        );
        
      }else {
        echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>";
      }
    }
    ?>
    <script>
        window.onload = function() {
        
        
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title: {
            text: "Trang thái"
          },
          // subtitles: [{
          //   text: "November 2017"
          // }],
          data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
        });
        chart.render();
        
        }
        
    </script>
    <div id="chartContainer" style="height: 200px; width: 25%; padding-top:50px"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </div>
        
  </div>
 
 
  </div>  <!-- div Row close from header -->
 </div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>