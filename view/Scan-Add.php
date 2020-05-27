<?php
require('menu.php');
require ("../functions/controller/ScanController.php");
$Scan = new ScanController();
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
                <h1 class="page__title">Scan add</h1>
            </div>
        </div>

        <form method="POST">
            <!-- Bootstrap table row -->
            <div class="row page__row">
                <!-- bootstrap column, 6 van de 12 breed -->
                <div class="col-sm-6">
                    <label class="form__label">Scan name</label>
                    <!-- form-control is een bootstrap input class -->
                    <!-- Met required checkt je browser of het leeg blijft -->
                    <input type="text" class="form-control marvin__input" id="txtName" name="txtName"
                           value="Scan Name" required>
                </div>

                <div class="col-sm-6">
                    <label class="form__label">Scan type</label>
                    <select class="form-control marvin__input marvin__select" id="cbxType" name="cbxType" required>
                        <!-- Hoe je opties krijgt in een combobox -->
                        <option value="type1" selected="selected">Internal Scan</option>
                        <option value="type2">Public Scan</option>
                        <!-- Selected zorgt dat het de standaard optie is -->
                    </select>
                </div>
            </div>


            <div class="row page__row">
                <!-- bootstrap column, 6 van de 12 breed -->
                <div class="col-sm-6">
                    <label class="form__label">Scan Comment</label>
                    <!-- Textarea is een input type die grooter is. Voor lappen teksten -->
                    <textarea name="txtComment" class="form-control marvin__input" id="txtComment" rows="2">Scan Comment </textarea>
                </div>


                <div class="col-sm-3">
                    <label for="StartDate" class="ce__label">Start Date</label>
                    <input type="date" name="StartDate" id="StartDate"
                               class="form-control ce--input" required/>
                </div>



                <div class="col-sm-3">
                    <label for="EndDate" class="ce__label">End Date</label>
                    <input type="date" name="EndDate" id="EndDate"
                               class="form-control ce--input" required/>
                </div>

            </div>
            <div class="row page__row">
                <div class="col-sm-6">
                    <label class="form__label">Introduction</label>
                    <!-- form-control is een bootstrap input class -->
                    <!-- Met requirecd checkt je browser of het leef blijft -->
                    <!-- input type heeft wel 12 types ofzo. Je kan ze makkkelijk online vinden -->
                    <input type="text" class="form-control marvin__input" id="txtEmployees" name="txtIntroduction"
                           value="Introduction text" required/>
                </div>
                <div class="col-sm-6">
                    <label class="form__label">Reminder</label>
                    <!-- form-control is een bootstrap input class -->
                    <!-- Met requirecd checkt je browser of het leef blijft -->
                    <!-- input type heeft wel 12 types ofzo. Je kan ze makkkelijk online vinden -->
                    <input type="text" class="form-control marvin__input" id="txtEmployees" name="txtIntroduction"
                           value="Reminder text" required/>
                </div>
            </div>

            <!-- Add one or more contact to a scan
                    when a contact is selected,
                    add another select in which the already selected contact is removed
                    repeat after each selected contact
              -->
            <div class="row page__row">
                <div class="col auto">
                    <select  id="selContactAdd" name="selContactAdd"
                            class="form-control">
                            <?php   $Scan->fillScanAddContact(); ?>
                    </select>
                </div>
            </div>

            <div class="row page__row">
                <div class="col auto">
                    <!-- Bootstrap defeult button is btn -->
                    <!-- Bootstrap button class toevoegen voor een andere kleur. De kleuren kan je vinden in de bootstrap documentatie -->
                    <input type="submit" name="btnOpslaan" value="Save" id="btnOpslaan" class="btn btn-danger marvin__input">
                </div>
            </div>

            <!-- add Questionair, see func in scandb.php -->
<!--            <div class="row page__row">-->
<!--                <div class="col auto">-->
<!--                    <select required id="selContactAdd" name="selContactAdd"-->
<!--                            class="form-control">-->
<!---->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->



    </div>

</div>


<?php

$Status = "Active";
$ReminderText = "remindertext test gr marvin";
if(isset($_POST['btnOpslaan'])) {
//    $selContactAdd = $_POST['selContactAdd'];
    $startDate = date("Y-m-d", strtotime($_POST['StartDate']));
    $endDate = date("Y-m-d", strtotime($_POST['EndDate']));
    $scanName= $_POST['txtName'];
    $scanComment= $_POST['txtComment'];
    $scanStatus= $Status;
    $scanIntroductionText= $_POST['txtIntroduction'];
    $scanReminderText= $ReminderText;
    $scanStartDate= $startDate;
    $scanEndDate= $endDate;
    $Scan->addScan($scanName,$scanComment, $scanStatus,$scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate, 1);
}







?>

<!--<script>-->
<!---->
<!--    $('#btnOpslaan').click(function (){-->
<!--        $.ajax({-->
<!--            url: '../functions/handler/Scan-AddHandler.php',-->
<!--            type: 'post',-->
<!--            data: {-->
<!--                "scanName": $('#txtName').val(),-->
<!--                "scanType": $('#cbxType').val(),-->
<!--                "scanComment": $('#txtComment').val(),-->
<!--                "scanIntroduction": $('#txtIntroduction').val(),-->
<!--            },-->
<!---->
<!--            success: function (response){-->
<!--                window.location.href='Qa.php';-->
<!--            }-->
<!---->
<!--        });-->
<!--    });-->
<!---->
<!--</script>-->
</body>