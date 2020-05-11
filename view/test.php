<?php  
    require('menu.php');
?>
<html>
    <body>
        <!-- Jouw container -->
        <div class="container-jouw-pagina" style="100%">
            <!-- Bootstrap container -->
            <div class="container">
            </div>
        </div>
    <!-- Styling tab hoor je niet te gebruiken en is alleen voor het voorbeeld -->
    <style>
        body {
            font-size: 16px;
        }

        .page__container {
           width: 100%;
        }

        /** 1rem is 16px. Hij haalt rem uit je body font-size */
        .page__row {
            padding: 1rem; 
        }

        .form__label {
            color: #000;
        }

        /* inherit pakt de styling van het element erboven */
        .marvin__input{
            font-size: inherit;
        }

        .marvin__select {
            height: auto;
        }
    </style>

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
                            <!-- Met requirecd checkt je browser of het leef blijft -->
                            <input type="text" class="form-control marvin__input" name="txtName" value="Peitje pans pettenfabriek" required>
                        </div>

                        <!-- bootstrap column, 6 van de 12 breed -->
                        <div class="col-sm-6">
                            <label class="form__label">Customer type</label>
                            <!-- bootstrap combobox heeft bijna altijd een extra class nodig met height:auto. Dit komt door de manier waarop form-control gestyled is -->
                            <select class="form-control marvin__input marvin__select" name="cbxType" required>
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
                            <textarea name="txtComment" class="form-control marvin__input" rows="5">Pietje pan is een fabriek waar petten gemaakt worden. </textarea>
                        </div>

                        <div class="col-sm-4">
                            <label class="form__label">Customer email</label>
                            <!-- form-control is een bootstrap input class -->
                            <!-- Met requirecd checkt je browser of het leef blijft -->
                            <!-- input type heeft wel 12 types ofzo. Je kan ze makkkelijk online vinden -->
                            <input type="email" class="form-control marvin__input" name="txtEmployees" value="piet@pietspettenfabriek.pan" required>
                        </div>
                    </div>

                    <!-- Nieuwe boostrap row maken -->
                    <!-- Elke nieuwe row heeft 12 colummen -->
                    <div class="row page__row">
                        <div class="col-sm-12">
                            <!-- Bootstrap defeult button is btn -->
                            <!-- Bootstrap button class toevoegen voor een andere kleur. De kleuren kan je vinden in de bootstrap documentatie -->
                            <input type="submit" name="btnOpslaan" value="Save my ass" class="btn btn-danger marvin__input">
                        </div>    
                    </div>
                </form>
            </div>
        </div> 
    </body>
</html>