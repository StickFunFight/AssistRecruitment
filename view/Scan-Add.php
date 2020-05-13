<?php
require('menu.php');

?>
<link href="../assests/styling/Scan-AddCSS.css" rel="stylesheet">
<body>
<!-- Jouw container -->
<div class="container-Scan-Add" style="100%">
    <!-- Bootstrap container -->
    <div class="container">
    </div>
</div>


<body style="font-size: 16px;">
<!-- Linken naar stylesheet -->
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
<!-- Pagina container -->
<div class="page__container">
    <!--- Bootstrap container -->
    <!-- Boostrap table -->
    <div class="container">
        <!-- Bootstrap grid toepassen -->
        <!-- Bootstrap table row -->
        <!-- Page row is a custom class -->
        <div class="row page__row">
            <!-- bootstrap column -->
            <div class="col-sm-12">
                <h1 class="page__title">Customer aanmaken</h1>
            </div>
        </div>

        <form method="POST">
            <!-- Bootstrap table row -->
            <div class="row page__row">
                <!-- bootstrap column, 6 van de 12 breed -->
                <div class="col-sm-6">
                    <label class="form__label">Customer name</label>
                    <!-- form-control is een bootstrap input class -->
                    <!-- Met required checkt je browser of het leef blijft -->
                    <input type="text" class="form-control marvin__input" id="txtName" name="txtName"
                           value="Peitje pans pettenfabriek" required>
                </div>

                <!-- bootstrap column, 6 van de 12 breed -->
                <div class="col-sm-6">
                    <label class="form__label">Customer type</label>
                    <!-- bootstrap combobox heeft bijna altijd een extra class nodig met height:auto. Dit komt door de manier waarop form-control gestyled is -->
                    <select class="form-control marvin__input marvin__select" id="cbxType" name="cbxType" required>
                        <!-- Hoe je opties krijgt in een combobox -->
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
                        <option value="type3">Type 3</option>
                        <option value="type4">Type 4</option>
                        <!-- Selected zorgt dat het de standaard optie is -->
                        <option value="type5" selected="selected">Type 5</option>
                        <option value="type6">Type 6</option>
                    </select>
                </div>
            </div>

            <!-- Nieuwe boostrap row maken -->
            <!-- Elke nieuwe row heeft 12 colummen -->
            <div class="row page__row">
                <!-- bootstrap column, 8 van de 12 breed -->
                <div class="col-sm-8">
                    <label class="form__label">Customer comment</label>
                    <!-- Textarea is een input type die grooter is. Voor lappen teksten -->
                    <textarea name="txtComment" class="form-control marvin__input" id="txtComment" rows="5">Pietje pan is een fabriek waar petten gemaakt worden. </textarea>
                </div>

                <div class="col-sm-4">
                    <label class="form__label">Introduction</label>
                    <!-- form-control is een bootstrap input class -->
                    <!-- Met requirecd checkt je browser of het leef blijft -->
                    <!-- input type heeft wel 12 types ofzo. Je kan ze makkkelijk online vinden -->
                    <input type="text" class="form-control marvin__input" id="txtEmployees" name="txtIntroduction"
                           value="piet@pietspettenfabriek.pan" required>
                </div>
            </div>

            <!-- Nieuwe boostrap row maken -->
            <!-- Elke nieuwe row heeft 12 colummen -->
            <div class="row page__row">
                <div class="col-sm-12">
                    <!-- Bootstrap defeult button is btn -->
                    <!-- Bootstrap button class toevoegen voor een andere kleur. De kleuren kan je vinden in de bootstrap documentatie -->
                    <input type="submit" name="btnOpslaan" value="Save my ass" id="btnOpslaan" class="btn btn-danger marvin__input">
                </div>
            </div>
        </form>
    </div>
</div>s

<script>

    $('#btnOpslaan').click(function (){
        $.ajax({
            url: '../functions/handler/Scan-AddHandler.php',
            type: 'post',
            data: {
                "scanName": $('#txtName').val(),
                "scanType": $('#cbxType').val(),
                "scanComment": $('#txtComment').val(),
                "scanIntroduction": $('#txtIntroduction').val(),
            },

            success: function (response){
                window.location.href='Qa.php';
            }

        });
    });

</script>
</body>