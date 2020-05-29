<?php
    require_once 'menu.php';
require_once '../functions/controller/QA_QuestionFunctions.php';
    $QF = new QA_QuestionFunctions();
//During the process of making a new question, the user adds an answer.
//This answer does not have a questionID that it should connect to, yet.
// Creating a array
$arrayTempAnswer = array();
?>
<link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
<body>

    <div id="page-content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="title">Vraag toevoegen</h1>
            </div>
            <form method="POST">
                <div role="document">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="selCategory" class="col-sm-2 col-form-label">Categorie</label>
                            <div class="col-sm-10">
                                <select id="selCategory" name="selCategory" class="form-control">
                                    <?php $QF->getCategories(); ?>
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
                                <option value="Active">Actief</option>
                                <option value="Archived">Gearchiveerd</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="selAxis" class="col-sm-2 col-form-label">Axis</label>
                            <div class="col-sm-10">
                                <select required id="selAxisAdd" name="selAxisAdd"
                                        class="form-control">
                                    <?php $QF->getAllAxis(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="selQuestionType" class="col-sm-2 col-form-label">Vraag type</label>
                            <div class="col-sm-10">
                                <select id="selQuestionType" name="selQuestionType" class="form-control">
                                    <option value="OCAI">OCAI</option>
                                    <option value="Question-answer">Vraag-antwoord</option>
                                </select>
                            </div>
                        </div>

                        <div name="divAnswerOptions" id="divAnswerOptions" class="form-group row" style="display:none;">
                            <label for="answerOptions" class="col-sm-2 col-form-label">Antwoord opties</label>
                            <div class="col-sm-10">
                                <i class="fas fa-plus" data-toggle="modal" data-target="#modalAnswerAdd"></i>
                                <br>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php $tempAnswers = $QF->readArrayAnswer($arrayTempAnswer);
                                                foreach($tempAnswers as $tempItem){
                                                    echo '<tr>
                                                            <td value="'.$tempItem->answer.'">'.$tempItem->answer.'</td>
                                                            <td value="'.$tempItem->answerScore.'">'.$tempItem->answerScore.'</td>
                                                            <td>
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <i class="fas fa-trash-alt"></i>
                                                            </td>
                                                            </tr>';
                                                }
                                        ?>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="btnConfirmAnswerAdd" name="btnConfirmAnswerAdd"
                                   value="Verzenden"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Answer Add -->
    <div class="modal fade" id="modalAnswerAdd" tabindex="-1" role="dialog" aria-labelledby="modalAnswerAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Antwoord toevoegen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txQuestion" class="col-sm-2 col-form-label" >Antwoord</label>
                            <div class="col-sm-10">
                                <input id="txAnswer" name="txAnswer" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txScore" class="col-sm-2 col-form-label" >Score</label>
                            <div class="col-sm-10">
                                <input id="txScore" name="txScore" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" name="btnCancel" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                        <input type="submit" name="btnConfirmAnswerAdd" id="btnConfirmAnswerAdd" class="btn btn-primary"  value="Antwoord Opslaan"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        $('#selQuestionType').change(function () {
            if ($(this).val() == "Question-answer") {
                $('#divAnswerOptions').show();
            } else {
                $('#divAnswerOptions').hide();
            }
        });
</script>
<?php

if(isset($_POST['btConfirm'])){
    $selAxis = $_POST['selAxisAdd'];
    $selCategory = $_POST['selCategory'];
    $txQuestion = $_POST['txQuestion'];
    $taExemple = $_POST['taExample'];
    $selStatus = $_POST['selStatus'];
    $selQuestionType = $_POST['selQuestionType'];

    $QF->setQuestion($selCategory, $selAxis, $txQuestion, $taExemple, $selStatus, $selQuestionType);

}

if(isset($_POST['btnConfirmAnswerAdd'])){
    $answerAdd = $_POST['txAnswer'];
    $scoreAdd = $_POST['txScore'];
    $QF->putinArrayAnswer($arrayTempAnswer, $answerAdd, $scoreAdd);
}
?>
</body>