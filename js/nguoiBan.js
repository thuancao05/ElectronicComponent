// Ajax call for admin login verification
function checkAdminLogin(){
    
    var adminLogEmail = $("#adminLogemail").val();
    var adminLogPass = $("#adminLogpass").val();
    $.ajax({
        url: "admin/admin.php",
        method: "POST",
        dataType: "json",
        data : {
            checkLogemail: "checkLogemail",
            adminLogEmail : adminLogEmail,
            adminLogPass : adminLogPass,
        },
        success: function(data){
            console.log(adminLogEmail);
            console.log(adminLogPass);
            if(data == 0){
                $('#statusAdminLogMsg').html('<small class="alert alert-danger">Invalid Email or Password !</small>');
            }
            else if(data == 1){
                $('#statusAdminLogMsg').html('<small class="alert alert-success">ISuccuss loading...</small>');
                setTimeout(()=>{
                    window.location.href = "admin/trangChu.php";
                },1000);
            }
        }, 
    });
}
$(document).ready(function(){ 
    var seven_day = $("#btn_7days").val();
    $('#btn_7days').css('background-color', 'blue');
    $('#btn_30days').css('background-color', 'rgb(210, 210, 210)');
    $('#btn_all').css('background-color', 'rgb(210, 210, 210)');

        function fetch_data(){
            $.ajax({
                url: "admin.php",
                method: "POST",
                dataType: "json",
                data : {
                    seven_day: seven_day,
                },
                success: function(data){
                    //console.log(data)
                    $('#load-data').html(data);
                }, 
            });     
        }
        fetch_data();
});

$('#btn_7days').on('click', function(){
    var seven_day = $("#btn_7days").val();
    $('#btn_7days').css('background-color', 'blue');
    $('#btn_30days').css('background-color', 'rgb(210, 210, 210)');
    $('#btn_all').css('background-color', 'rgb(210, 210, 210)');

    function fetch_data(){
        $.ajax({
            url: "admin.php",
            method: "POST",
            dataType: "json",
            data : {
                seven_day: seven_day,
            },
            success: function(data){
                //console.log(data)
                $('#load-data').html(data);
            }, 
        });     
    }
    fetch_data();
   });

$('#btn_30days').on('click', function(){
    var thirty_day = $("#btn_30days").val();
    $('#btn_30days').css('background-color', 'blue');
    $('#btn_7days').css('background-color', 'rgb(210, 210, 210)');
    $('#btn_all').css('background-color', 'rgb(210, 210, 210)');

    function fetch_data(){
         $.ajax({
            url: "admin.php",
            method: "POST",
            dataType: "json",
            data : {
                thirty_day: thirty_day,
            },
            success: function(data){
                console.log(data)
                $('#load-data').html(data);
            }, 
        });     
    }
    fetch_data();
});

$('#btn_all').on('click', function(){
    var all_day = $("#btn_all").val();
    $('#btn_all').css('background-color', 'blue');
    $('#btn_7days').css('background-color', 'rgb(210, 210, 210)');
    $('#btn_30days').css('background-color', 'rgb(210, 210, 210)');

    function fetch_data(){
         $.ajax({
            url: "admin.php",
            method: "POST",
            dataType: "json",
            data : {
                all_day: all_day,
            },
            success: function(data){
                console.log(data)
                $('#load-data').html(data);
            }, 
        });     
    }
    fetch_data();
});

