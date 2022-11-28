
    function signIn() {
    //$('#signin').click(function(){
    //$(function(){
        let username = $('#username').val();
        let password = $('#password').val();
        $.ajax({
            url: 'includes/webServices/login.php',
            method: 'POST',
            data: {username:username,password:password},
            success: function(result) {
                console.log(result);
                if (result==1) {
                    location.href='index.php';
                }else{
                    $('#errorMsg').html('<font color=red>Wrong Username or Password</font>');
                }
            }
        })
    }//)
