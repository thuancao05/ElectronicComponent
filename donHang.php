<?php
   // Những function được tạo sử dụng trong thanhToan.php
    include('./connectdb.php');

     function taoDonHang($nm_id, $soLuongSanPham, $ghiChu, $tongDonHang, $pttt){
         $conn=connectdb();
         $tt_id=1;
         $dh_ngayDat = date('Y/m/d');
         $sql = "INSERT INTO donhang (dh_tongThanhToan, dh_pttt, nm_id, dh_soLuong, dh_ghiChu, tt_id, dh_ngayDat)
               VALUE ('$tongDonHang', '$pttt', '$nm_id', '$soLuongSanPham', '$ghiChu', '$tt_id', '$dh_ngayDat')";
         $conn->exec($sql);
         $last_id = $conn->lastInsertId(); // Lấy id tự tạo ở table tbl_order trong csdl
         return $last_id;

   }

   function themGioHang($idDonHang, $sp_id, $sp_ten, $sp_hinhAnh, $sp_gia, $soLuong, $nm_id){
      $conn=connectdb();
      $sql = "INSERT INTO giohang (dh_id, sp_id, gh_tenSanPham, gh_img, gh_donGia, gh_soLuong, nm_id)
              VALUE ('".$idDonHang."', '".$sp_id."', '".$sp_ten."', '".$sp_hinhAnh."', '".$sp_gia."', '".$soLuong."', ".$nm_id.")";
      $conn->exec($sql); 
   }

     function hienThiGioHang($idDonHang){
      $conn=connectdb();
      $stmt = $conn->prepare("SELECT * FROM giohang WHERE dh_id = $idDonHang");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $kq = $stmt->fetchAll();
      return $kq;
   }

     function hienThiThongTinDatHang($idDonHang){ 
      $conn=connectdb();
      $stmt = $conn->prepare("SELECT dc.dc_sonha as sonha, dc.dc_thanhpho as tentp, dc.dc_tinh as tentinh, dc.dc_xa as tenxa,
                                    dc.dc_sdt as sdt, dc.dc_hoten as hoten, dc.nm_email as email, dh.dh_pttt as pttt, dh.dh_ghiChu as ghichu
                               FROM donhang dh JOIN diachi dc ON dh.nm_id = dc.nm_id
                               WHERE dh.dh_id = $idDonHang");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $kq = $stmt->fetchAll();
      return $kq;
   }
?>
