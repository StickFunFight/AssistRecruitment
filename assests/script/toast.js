$(document).ready(function(){
    $("#forgotPassword").click(function(){
        $("#snackbar").attr('class', 'show');
        setTimeout(function(){
            $("#snackbar").removeAttr('class');
        }, 3000);
    });
});