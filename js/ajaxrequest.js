/* 
    Ngày 14/01/2023
    Hàm addStu() chức năng thêm một student vào csdl khi chọn signup (tên, emaim, mật khẩu)
    1. addStu() gán sự kiện onlick ở nút submit form đăng ký
    2. Tạo addStu() ở ajaxrequest.js
        - Lấy giá trị từ 3 trường trong form từ #id
            + username. useremail, userpass
        - Tạo  $.ajax() để đẩy dữ liệu qua addstudent.php để xử lý
        - Kiểm tra các ràng buộc như rỗng, nhập đúng định dạng email
        - Khi đăng ký thành công hiển thị thông báo
    3. Hàm clearStuRegField() để reset các trường khi đăng ký thành công
    4. (document).ready(function() xử lý kiểm tra email đã tồn tại hay chưa
    5. function checkuserLogin() 

*/

$(document).ready(function(){
    // Ajax call form already exists email verification
    $("#useremail").on("keypress blur", function(){
        var reg = /^[A-Z0-9._/%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var useremail = $("#useremail").val();
        $.ajax({
             url: './Customer/addCus.php', 
             method: "POST",
             data:{
                checkemail: "checkmail",
                useremail: useremail,
             },
             success:function(data){
                console.log(data);
                if(data != 0){
                     $("#statusMsg2").html('<small style="color:red;"> Email ID Already Used !</small>');
                     $("#signup").attr("disabled", true);
                }else if(data == 0 && reg.test(useremail)){
                    $("#statusMsg2").html('<small style="color:green;"> There You Go !</small>');
                    $("#signup").attr("disabled", false);
                }else if(!reg.test(useremail)){
                    $("#statusMsg2").html('<small style="color:red;"> Please Enter valid Email e.g example@gmail.com !</small>');
                    $("#useremail").focus();
                    $("#signup").attr("disabled", false);
                }
            }
        });
    });
});

function addUser(){
    var reg = /^[A-Z0-9._/%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var username = $("#username").val();
    var useremail = $("#useremail").val();
    var userpass = $("#userpass").val();
    // console.log(username);
    // console.log(useremail);
    // console.log(userpass);

    // Checking form Failed on form submitssion
    if(username.trim() == ""){
        $("#statusMsg1").html('<small style="color:red;"> Please Enter Name !</small>');
        $("#username").focus();
        return false;
    } else if (useremail.trim() == ""){
        $("#statusMsg2").html('<small style="color:red;"> Please Enter Email !</small>');
        $("#useremail").focus();
        return false; 
    }else if (useremail.trim() != "" && !reg.test(useremail)){
        $("#statusMsg2").html('<small style="color:red;"> Please Enter valid Email e.g example@gmail.com !</small>');
        $("#useremail").focus();
        return false; 
    }else if (userpass.trim() == ""){
        $("#statusMsg3").html('<small style="color:red;"> Please Enter Password !</small>');
        $("#userpass").focus();
        return false; 
    } else {
    /*
     Hàm $.ajax() của JQuery được sử dụng để thực hiện các request HTTP bất đồng bộ (async).
     - url: là một chuỗi chứa URL mà bạn muốn sử dụng AJAX để thực hiện request, trong khi đó tham số options là một object thuần chứa các thiết lập cho request AJAX đó.
     - dataType: là dạng dữ liệu trả về. (text, json, script, xml,html,jsonp )
     - data: không bắt buộc ,là một đối tượng object gồm các key : value sẽ gửi lên server
    */
    $.ajax({
        url:'./Customer/addCus.php', 
        method: "POST",
        dataType: "json",
        data:{
            userSignup: "userSignup", // Gui thong bao dang ky qua addstudent
            username: username,
            useremail: useremail,
            userpass: userpass,
        },
        success:function(data){    
            console.log(data)
            if(data == "OK"){
                $('#successMsg').html("<span class='alert alert-success'> Registration Successful !</span>")
                clearStuRegField();
            }else if(data == "Failed"){
                  $('#successMsg').html("<span class='alert alert-bg-danger'> Unable to Register !</span>")
            }
        }
    });
    }
}

// Empty all Failed
function clearStuRegField(){
    $("#userRegForm").trigger("reset");
    $("#statusMsg1").html(" ");
    $("#statusMsg2").html(" ");
    $("#statusMsg3").html(" ");

}

// Ajax call for student login verification
/*
    Sự kiện onclick="checkuserLogin()" ở footer.php
    Lấy thông tin từ form login gửi dữ liệu qua addstudent.php để kiểm tra đăng nhập
*/
function checkUserLogin(){
    //console.log("Login Clicked!!")
    var userLogEmail = $("#userLogEmail").val();
    var userLogPass = $("#userLogPass").val();
    $.ajax({
        url: './Customer/addCus.php', 
        method: "POST",
        data:{
            checkLogEmail: "checkLogEmail",
            userLogEmail: userLogEmail,
            userLogPass: userLogPass,
        },
        success:function(data){
             //console.log(userLogEmail);
             //console.log(userLogPass);
            console.log(data);
            if(data == 0){
                $("#statusLogMsg").html('<small class="alert alert-danger"> Invalid Email or Password !</small>'); 
            }else if(data == 1){
                $("#statusLogMsg").html('<div class="spinner-border text-success role="status"></div>');
                setTimeout(()=>{
                    window.location.href = "index.php";
                }, 1000 );
            }
        }
    });
}
let subMenu = document.getElementById("subMenu");
function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}
