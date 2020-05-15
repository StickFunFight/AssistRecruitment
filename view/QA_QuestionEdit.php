<?php
require_once 'head.php';
require_once '../functions/controller/QA_QuestionFunctions.php';
require_once 'menu.php';
$QF = new QA_QuestionFunctions();
$questionID = $_GET['questionID'];
$resultQuestionData = $QF->getQuestionData($questionID);

?>
    <link rel="stylesheet" href="../assests/styling/QaStyling.css">
    <link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
    <body>
<div id="page-content">
    <div class="container-fluid">
        <div id="modalEditQuestion">
            <div class="header">
                <h1 class="title" id="exampleModalLabel">Vraag veranderen</h1>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="selCategoryQuestionEdit" class="col-sm-2 col-form-label">Categorie</label>
                        <div class="col-sm-10">
                            <select required id="selCategoryQuestionEdit" name="selCategoryQuestionEdit"
                                    class="form-control">
                                <?php $QF->getCategories(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txQuestionEdit" class="col-sm-2 col-form-label">Vraag</label>
                        <div class="col-sm-10">
                            <input id="txQuestionEdit" name="txQuestionEdit" class="form-control"
                                   value="<?php echo $resultQuestionData['questionName']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taExampleEdit" class="col-sm-2 col-form-label">Voorbeeld</label>
                        <div class="col-sm-10">
                    <textarea id="taExampleEdit" name="taExampleEdit" class="form-control"
                              required><?php echo $resultQuestionData['questionExemple']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selStatusQuestEdit" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select id="selStatusQuestEdit" name="selStatusQuestEdit" class="form-control" required>
                                <option value="Active">Actief</option>
                                <option value="Archived">Gearchiveerd</option>
                                <option value="Deleted">Verwijderd</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selAxis" class="col-sm-2 col-form-label">Axis</label>
                        <div class="col-sm-10">
                            <select required id="selAxisEdit" name="selAxisEdit"
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
                            <i class="fas fa-plus" ></i>
                            <br>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Answer</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Axis</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php echo $QF->getQuestionAnswer($questionID);?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <input type="submit" name="btnQuestionEditSubmit" id="btnQuestionEditSubmit" class="btn btn-primary"
                           value="Verzenden"/>
                </div>
            </form>
        </div>

    </div>
</div>

<?php

    if(isset($_POST['btnQuestionEditSubmit'])){
        $selAxis = $_POST['selAxisEdit'];
        $selCategory = $_POST['selCategoryQuestionEdit'];
        $txQuestion = $_POST['txQuestionEdit'];
        $taExemple = $_POST['taExampleEdit'];
        $selStatus = $_POST['selStatusQuestEdit'];
        $selQuestionType = $_POST['selQuestionTypeQuestionEdit'];

        $QF->updateQuestion($questionID, $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);
    }

?>
<script>


    $('#selCategoryQuestionEdit').val(<?php echo $resultQuestionData['categorieID']; ?>);
    $('#selQuestionType').val("<?php echo $resultQuestionData['questionType'] ?>");
    $('#selStatusQuestEdit').val("<?php echo $resultQuestionData['questionStatus'] ?>");



    $('#selQuestionType').change(function () {
        if ($(this).val() == "Question-answer") {
            $('#divAnswerOptions').show();
        } else {
            $('#divAnswerOptions').hide();
        }
    });

</script>
    </body><?php
