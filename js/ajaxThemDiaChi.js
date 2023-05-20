function addAddress(){
    var hoten = $("#hoten").val();
    var sodienthoai = $("#sodienthoai").val();
    var sonha = $("#sonha").val();
    var thanhpho = document.getElementById("thanhpho").value;
    var tinh = document.getElementById("tinh").value;
    var huyen = document.getElementById("huyen").value;
    var email = document.getElementById("email").value;


    console.log(hoten);
    console.log(sodienthoai);
    console.log(sonha);
    console.log(thanhpho);
    console.log(tinh);
    console.log(huyen);
    console.log(email);

    var reg = /^[0-9]/;

    if(hoten.trim() == ""){
        $("#statusMsg1").html('<small style="color:red;"> Vui lòng điền họ tên! </small>');
        $("#hoten").focus();
        return false;
    } else if (sodienthoai.trim() == ""){
        $("#statusMsg2").html('<small style="color:red;"> Vui lòng điền số điện thoại! </small>');
        $("#sodienthoai").focus();
        return false; 
    }
    else if (!reg.test(sodienthoai)){
        $("#statusMsg2").html('<small style="color:red;"> Vui lòng điền đúng điện thoại! </small>');
        $("#sodienthoai").focus();
        return false;
    }else if (sonha.trim() == ""){
        $("#statusMsg3").html('<small style="color:red;"> Vui lòng điền số nhà! </small>');
        $("#sonha").focus();
        return false; 
    }else if (thanhpho == "Thành phố"){
        $("#statusMsg4").html('<small style="color:red;"> Vui lòng chọn thành phố </small>'); 
        $("#thanhpho").focus();
    }else if (tinh == "Quận huyện"){
        $("#statusMsg5").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#tinh").focus(); 
    }else if (huyen == "Phường xã"){
        $("#statusMsg6").html('<small style="color:red;"> Vui lòng chọn quận huyện </small>');
        $("#huyen").focus(); 
    }
    else{
        $.ajax({
            url:'./themDiaChi.php', // Gửi "data" qua addAddress.php
            method: "POST",
            dataType: "json",
            data:{
                stusignup: "stusignup",
                hoten: hoten,
                sodienthoai: sodienthoai,
                sonha: sonha,
                thanhpho: thanhpho,
                tinh: tinh,
                huyen: huyen,
                email: email,
            }, 
            success:function(data){    
                //console.log(data) // in OK || Failed
                if(data == "Failed"){
                    $('#successMsg').html("<span class='alert alert-bg-danger'> Thêm địa chỉ thất bại!</span>")
                }else if(data == "OK"){
                    var result = confirm("Bạn có muốn thêm địa chỉ mới");
                    if (result == true) {
                        alert("Thêm thành công");
                        setTimeout(()=>{
                            window.location.href = "./diaChiNguoiMua.php";
                            }, 300 );  
                    } else {
                        alert("Không thêm");
                    }    
                    $('#successMsg').html("<span class='alert alert-success'> Thêm địa chỉ thành công!</span>")
                }
            }
        });
        }
}