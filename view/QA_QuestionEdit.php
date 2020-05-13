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
<script>
    var response = {};
    response.val = <?php echo $resultQuestionData['categoryName']; ?>;
    $("#selCategoryQuestionEdit option[data-value='" + response.val + "']").attr("selected", "selected");
</script>
<div id="modalEditQuestion">
    <div class="header">
        <h1 class="title" id="exampleModalLabel">Vraag veranderen</h1>
    </div>
    <form method="POST">
        <div class="modal-body">
            <div class="form-group row">
                <label for="selCategoryQuestionEdit" class="col-sm-2 col-form-label">Categorie</label>
                <div class="col-sm-10">
                    <select required id="selCategoryQuestionEdit" name="selCategoryQuestionEdit" class="form-control">
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
                <label for="selQuestionTypeQuestionEdit" class="col-sm-2 col-form-label">Vraag type</label>
                <div class="col-sm-10">
                    <select id="selQuestionTypeQuestionEdit" name="selQuestionTypeQuestionEdit" class="form-control"
                            required>
                        <option value="OCAI">OCAI</option>
                        <option value="Question-answer">Vraag-antwoord</option>
                    </select>
                </div>
            </div>
            <div name="divAnswerOptionsEdit" id="divAnswerOptionsEdit" class="form-group row" style="display:none;">
                <label for="answerOptionsQuestionEdit" class="col-sm-2 col-form-label">Antwoord opties</label>
                <div class="col-sm-10">
                    <table name="answerOptionsQuestionEdit"></table>
                    <label>OPEN</label>
                </div>
            </div>
        </div>
        <div class="footer">
            <button type="button" name="btnQuestionCancel" class="btn btn-danger" data-dismiss="modal">Annuleren
            </button>
            <input type="button" name="btnQuestionEditSubmit" id="btnQuestionEditSubmit" class="btn btn-primary"
                   data-dismiss="modal" value="Verzenden"/>
        </div>
    </form>
</div>

    </div></div>
<script>

    $('#btnQuestionEditSubmit').click(function () {
        $.ajax({
            url: '../functions/handler/QA_QuestionEditHandler.php',
            type: 'post',
            data: {
                "questionID": categoryID,
                "CategoryQuestionEdit": $('#selCategoryQuestionEdit').val(),
                "QuestionNameEdit": $('#txQuestionEdit').val(),
                "QuestionExampleEdit": $('#taExampleEdit').val(),
                "QuestionStatusEdit": $('#selStatusQuestEdit').val(),
                "QuestionTypeEdit": $('#selQuestionTypeQuestionEdit').val()
            },

            success: function (response) {
                window.location.href = 'Qa.php';
            },
        });
    });

    $('#selQuestionType').change(function () {
        if ($(this).val() == "Question-answer") {
            $('#divAnswerOptions').show();
        } else {
            $('#divAnswerOptions').hide();
        }
    });

    $('#selQuestionTypeQuestionEdit').change(function () {
        if ($(this).val() == "Question-answer") {
            $('#divAnswerOptionsEdit').show();
        } else {
            $('#divAnswerOptionsEdit').hide();
        }
    });

</script>
    </body><?php
