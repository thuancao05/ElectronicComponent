
function updateAddress(){
    var hoten = $("#capnhat_hoten").val();
    var sodienthoai = $("#capnhat_sodienthoai").val();
    var sonha = $("#capnhat_sonha").val();
    var thanhpho = document.getElementById("capnhat_thanhpho").value;
    var tinh = document.getElementById("capnhat_tinh").value;
    var huyen = document.getElementById("capnhat_huyen").value;
    var email = document.getElementById("capnhat_email").value;
    var dc_id = $("#capnhat_diachi").val();

    // console.log(hoten);
    // console.log(sodienthoai);
    // console.log(sonha);
    // console.log(thanhpho);
    // console.log(tinh);
    // console.log(huyen);
    // console.log(email);
    // console.log(dc_id);

    var reg = /^[0-9]/;

    if(hoten.trim() == ""){
        $("#statusMsg1_capnhat").html('<small style="color:red;"> Vui lòng điền họ tên! </small>');
        $("#capnhat_hoten").focus();
        return false;
    } else if (sodienthoai.trim() == ""){
        $("#statusMsg2_capnhat").html('<small style="color:red;"> Vui lòng điền số điện thoại! </small>');
        $("#capnhat_sodienthoai").focus();
        return false; 
    }
    else if (!reg.test(sodienthoai)){
        $("#statusMsg2_capnhat").html('<small style="color:red;"> Vui lòng điền đúng điện thoại! </small>');
        $("#statusMsg2_capnhat").focus();
        return false;
    }
    else if (sonha.trim() == ""){
        $("#statusMsg3_capnhat").html('<small style="color:red;"> Vui lòng điền số nhà! </small>');
        $("#capnhat_sonha").focus();
        return false; 
    }else if (thanhpho == "Thành phố"){
        $("#statusMsg4_capnhat").html('<small style="color:red;"> Vui lòng chọn thành phố </small>'); 
        $("#capnhat_thanhpho").focus();
    }else if (tinh == "Quận huyện"){
        $("#statusMsg5_capnhat").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#capnhat_tinh").focus(); 
    }else if (huyen == "Phường xã"){
        $("#statusMsg6_capnhat").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#capnhat_huyen").focus(); 
    }
    else{
        $.ajax({
            url:'../Student/capNhatDiaChi.php', 
            method: "POST",
            dataType: "json",
            data:{
                stusignup: "stusignup", // Gui thong bao dang ky qua addstudent
                hoten: hoten,
                sodienthoai: sodienthoai,
                sonha: sonha,
                thanhpho: thanhpho,
                tinh: tinh,
                huyen: huyen,
                email: email,
                dc_id: dc_id,
            }, success:function(data){   
        
            }
        });

        var result = confirm("Bạn có muốn cập nhật thông tin địa chỉ");
        if (result == true) {
            alert("Đã cập nhật thành công");
            setTimeout(()=>{
                window.location.href = "./diaChiNguoiMua.php";
                }, 300 );
        } else {
            alert("Không cập nhật");
        }    
        
        }

}