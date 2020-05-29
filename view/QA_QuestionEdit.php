<?php
require_once 'menu.php';
require_once '../functions/controller/QA_QuestionFunctions.php';

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
                        <label for="selQuestionTypeQuestionEdit" class="col-sm-2 col-form-label">Vraag type</label>
                        <div class="col-sm-10">
                            <select id="selQuestionTypeQuestionEdit" name="selQuestionTypeQuestionEdit" class="form-control">
                                <option value="OCAI">OCAI</option>
                                <option value="Question-answer">Vraag-antwoord</option>
                            </select>
                        </div>
                    </div>

                    <div name="divAnswerOptions" id="divAnswerOptions" class="form-group row">
                        <label for="answerOptions" class="col-sm-2 col-form-label">Antwoord opties</label>
                        <div class="col-sm-10">
                            <a href="QA_QuestionAnswerAdd.php?qID=<?php echo $questionID; ?>"><i class="fas fa-plus"></i></a>
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

                                <?php
                                $arrayQA = array();
                                $listQuestionAnswerEdit = $QF->getQuestionAnswer($arrayQA, $questionID);
                                foreach ($listQuestionAnswerEdit as $QAE) {
                                    echo '<tr>
                                        <td value="'.$QAE->answer.'">'.$QAE->answer.'</td>
                                        <td value="'.$QAE->answerScore.'">'.$QAE->answerScore.'</td>
                                        <td>
                                        <a href="QA_QuestionAnswerEdit.php?answerID='.$QAE->tempID.'&qID='.$questionID.'"><i class="fas fa-pencil-alt" id="'.$QAE->tempID.'" value="'.$QAE->tempID.'"></i></a> 
                                        <i data-toggle="modal" data-target="#deleteSelectedQuestionAnswer" id="'.$QAE->tempID.'" onClick="reply_click(this.id)" value="'.$QAE->tempID.'" class="fas fa-trash-alt"></i>
                                        </td>
                                        </tr>';
                                }
                                ?>
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

<div class="modal fade" id="archiveSelectedQuestionAnswer" tabindex="-1" role="dialog" aria-labelledby="archiveSelectedQuestionAnswer"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModal">Archive Scan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Weet je zeker dat je dit antwoord wilt archiveren?
            </div>

            <form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
                    <button type="submit" name="btnArchive" class="btn btn-primary" id="btnArchive">Bevestig</button>

                    <script type="text/javascript">
                        function reply_click(clicked_id) {
                            window.yourGlobalVariable = clicked_id;
                        }

                        $('#btnArchive').click(function () {
                            $.ajax({
                                url: '../functions/handler/questionAnswerArchiveHandler.php',
                                type: 'post',
                                data: {"answerID": yourGlobalVariable},
                                success: function (response) {

                                }
                            });

                        });

                    </script>

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
        $url = "http://localhost/AssistRecruitment/view/QA_QuestionEdit.php?questionID=".$questionID;
        ?><script>window.location ='<?php echo $url ?>';</script><?php
    }

?>
<script>

    function reply_click(clicked_id) {
        window.yourGlobalVariable = clicked_id;
    }





    $('#selCategoryQuestionEdit').val(<?php echo $resultQuestionData['categorieID']; ?>);
    $('#selQuestionType').val("<?php echo $resultQuestionData['questionType'] ?>");
    $('#selStatusQuestEdit').val("<?php echo $resultQuestionData['questionStatus'] ?>");


    $(document).ready(function(){

        if('')
        $('#selQuestionType').change(function () {
            if ($(this).val() == "Question-answer") {
                $('#divAnswerOptions').show();
            } else {
                $('#divAnswerOptions').hide();
            }
        });
    });


</script>
    </body><?php
