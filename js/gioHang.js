    
/* 

    // HTML DOM
    function Tang(x){
        // Thay đổi số lượng trực tiếp với DOM HTML
        var cha = x.parentElement;
        var soLuongCu = cha.children[1];

        var soLuongMoi = parseInt(soLuongCu.innerText) + 1;
        soLuongCu.innerText = soLuongMoi;
        // alert(soLuongCu);

        // Gọi tới hàm cập nhật session

    }

    function Giam(x){
        // Thay đổi số lượng trực tiếp với DOM HTML
        var cha = x.parentElement;
        var soLuongCu = cha.children[1];

        if(parseInt(soLuongCu.innerText) > 1){
            var soLuongMoi = parseInt(soLuongCu.innerText) - 1;
            soLuongCu.innerText = soLuongMoi;
        }else{
            alert("Đặt hàng tối thiểu là 1");
        }
        // alert(soLuongCu);

        // Gọi tới hàm cập nhật session
        
    }

*/

    // JQuery
    $(document).ready(function () {
        // Hiểm thị số lượng sản phẩm trong giỏ hàng
            tinhSoLuongSanPham();
            tinhTongDonHang();
        
        // Xóa giỏ hàng class="xoaSanPham"
        /*
        $(".xoaSanPham").click(function (e) { 
            e.preventDefault();
            
            var tr = $(this).parent().parent();
            // alert(tr);
            var tenSanPham = tr.children("td").eq(2).text(); // Lấy tên sản phẩm để xóa csdl
            tr.remove();
            // alert(tenSanPham);

            // Cập nhật lại số lượng
            tinhSoLuongSanPham();
            tinhTongDonHang();
            // Tạo hiệu ứng animation
            $(".coverBoxCart").addClass("cartAnimation");
            setTimeout(function(){ $(".coverBoxCart").removeClass("cartAnimation");;}, 500); // Sau nữa giây sẽ xóa để tạo lại hiệu ứng khi xóa tiếp theo
        });
        */
        // Thay đổi số lượng khi xóa
        $(".soLuong").change(function (e) { 
            e.preventDefault();
            var soLuong = this.value;
            var tr = $(this).parent().parent();
            var tenSanPham = tr.children("td").eq(2).text();
            var donGia = tr.children("td").eq(3).text(); 
            var thanhTien = donGia * soLuong;
            tr.children("td").eq(5).text(thanhTien);
            tinhTongDonHang();
            // alert(soLuong);
        });

        function tinhSoLuongSanPham() {
            var gioHang = $("#gioHang").children("tr");
            var soLuongSanPham = gioHang.length;
            // alert(soLuongSanPham);
            var boxCart = $("#boxCart").children("span").eq(0);
            // alert(boxCart.length);
            // Đóng dòng bên dưới lại để đếm số lượng sản phẩm trong giỏ hàng ở file header.php
            // boxCart.text(soLuongSanPham);
        }


        function tinhTongDonHang() {
            var tongDonHang = $("#tongDonHang").children("tr");
            // Tính tổng đơn hàng
            var gioHang = $("#gioHang").children("tr");
            var tong = 0;
            for (let i = 0; i < gioHang.length; i++) {
                tong += eval(gioHang.eq(i).children("td").eq(5).text());
            }
            tongDonHang.children("td").eq(1).text(tong);
        }
        
            // Cập nhật lại số lượng khi thay đổi trong giaoDienGioHang.php
            $(".soLuong").change(function (e) { 
                e.preventDefault();
                var td = $(this).parent(); // Lấy "dt"
                var sp_soLuong = td.children("input").val(); // Lấy <input> trong "tr"
                var tr = $(this).parent().parent();

                var sp_ten = tr.children("td").eq(2).text(); // Lấy tên của món cần thay đổi SL trong giỏ hàng chuyển cho = id

                // var sp_ten = tr.children("td").eq(0).text(); // Lấy STT để hiển thị số sản phẩm trong giỏ hàng

                //   alert(sp_soLuong);
                //   alert(sp_ten);

                $.post("/capNhatSLSPTrongGioHang.php",{
                        sp_soLuong: sp_soLuong,
                        sp_ten: sp_ten
                    },
                    function (data) {                       
                        var iconGioHang = $("#slsp");
                        iconGioHang.text(data);
                    }
                    
                );
            });
    });

