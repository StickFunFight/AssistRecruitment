<?php

require_once 'head.php';
require_once 'menu.php';

?>

<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<div id="page-content">

    <h1>Questionare Add</h1>

    <label for="textField"><h3>Name: </h3></label>
    <input type="text" name="textField" id="textField" />
    <br>
    <label for="statusField"><h3>Status:</h3></label>
    <input type="text" name="statusField" id="statusField">



    <button type="submit" id="btnVolgende" value="Volgende" class="btn btn-success ButtonLeft">
</div>

</html>

<script>

    $('#btnVolgende').click(function () {
        $.ajax({
            url: '../functions/handler/questionairAddHandler.php',
            type: 'post',
            data: { "questionairName": $('#textField').val(), "questionairStatus": $('#statusField').val()},
            success: function(response) {
                window.location.href = 'questionaireAdd2.php';
            }
        });
    });

</script>