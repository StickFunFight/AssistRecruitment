<?php
require_once 'head.php';
require_once '../functions/controller/QA_QuestionFunctions.php';
$QF = new QA_QuestionFunctions();
$questionID = "10";

?>
    <link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
    <body>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Modal
</button>
<form method="POST">
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Vraag toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="selCategory" class="col-sm-2 col-form-label" >Categorie</label>
                        <div class="col-sm-10">
                            <select id="selCategory" name="selCategory" class="form-control">
                                <?php  ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txQuestion" class="col-sm-2 col-form-label" >Vraag</label>
                        <div class="col-sm-10">
                            <input id="txQuestion" name="txQuestion" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="taExample" class="col-sm-2 col-form-label" >Voorbeeld</label>
                        <div class="col-sm-10">
                            <textarea id="taExample" name="taExample" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selStatus" class="col-sm-2 col-form-label" >Status</label>
                        <div class="col-sm-10">
                            <select id="selStatus" name="selStatus" class="form-control">
                                <option value="active">Actief</option>
                                <option value="archived">Gearchiveerd</option>
                                <option value="deleted">Verwijderd</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selQuestionType" class="col-sm-2 col-form-label" >Vraag type</label>
                        <div class="col-sm-10">
                            <select id="selQuestionType" name="selQuestionType" class="form-control">
                                <option value="OCAI">OCAI</option>
                                <option value="Question-answer">Vraag-antwoord</option>
                            </select>
                        </div>
                    </div>

                    <div name="divAnswerOptions" id="divAnswerOptions" class="form-group row" style="display:none;">
                        <label for="answerOptions" class="col-sm-2 col-form-label" >Antwoord opties</label>
                        <div class="col-sm-10">
                            <table name="answerOptions"></table>
                            <label>OPEN</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <input type="submit" class="btn btn-primary" id="btConfirm" name="btConfirm" value="Verzenden"/>
                    </div>
                </div>
            </div>
        </div>
</form>


<script>
    $('#selQuestionType').change(function(){
        if($(this).val() == "Question-answer") {
            $('#divAnswerOptions').show();
        }
        else{
            $('#divAnswerOptions').hide();
        }
    });
</script>
<?php

    if(isset($_POST['btConfirm'])){

        $selCategory = $_POST['selCategory'];
        $txQuestion = $_POST['txQuestion'];
        $taExemple = $_POST['taExample'];
        $selStatus = $_POST['selStatus'];
        $selQuestionType = $_POST['selQuestionType'];
        echo $selQuestionType;

        if($selCategory == null || $txQuestion == null || $selStatus == null || $selQuestionType == null){
            ?><?php
        }
        else {
            $QF->updateQuestion($questionID, $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);
        }
    }
    ?>
    <script>
        $('#btnConfirm').click(function(){

        });
    </script>
    </body><?php
