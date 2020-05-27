<?php

require_once 'head.php';
require_once 'menu.php';

?>

<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<div id="page-content">
    <div class="container-fluid">
        <h1>Questionare Add</h1>
        <form method="POST">
            <label for="txtName"><h3>Name: </h3></label>
            <input type="text" name="txtName" id="txtName" />
            <br>
            <label for="txtStatus"><h3>Status:</h3></label>
            <input type="text" name="txtStatus" id="txtStatus">



            <div class="row QaTopMargin">
                <div class="col-sm-1">
                    <input type="button" class="btn btn-success ButtonLeft" id="btnVolgende" value="Volgende"></input>
                </div>
            </div>
        </form>
    </div>
</div>
</html>
<script>

    $('#btnVolgende').click(function () {
        $.ajax({
            url: 'questionairAddHandler.php',
            type: 'post',
            data: { "questionairName": $('#txtName').val(), "questionairStatus": $('#txtStatus').val()},
            success: function(response) {
                window.location.href = 'questionairAdd2.php?qID='+response;
            }
        });
    });

</script>
