<?php
require_once 'menu.php';
require_once '../functions/controller/QA_QuestionFunctions.php';
$QF = new QA_QuestionFunctions();
$answerID = $_GET['answerID'];
$arrayQA = array();
$resultQuestionData = $QF->getAnswer($answerID);
?>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div id="modalEditQuestion">
            <div class="header">
                <h1 class="title" id="exampleModalLabel">Antwoord veranderen</h1>
            </div>
            <form method="POST">
                <div class="form-group row">
                    <label for="txQuestion" class="col-sm-2 col-form-label">Antwoord</label>
                    <div class="col-sm-10">
                        <input id="txAnswer" name="txAnswer" class="form-control" required
                               value="<?php echo $resultQuestionData['answer']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txScore" class="col-sm-2 col-form-label">Score</label>
                    <div class="col-sm-10">
                        <input id="txScore" name="txScore" class="form-control"
                               value="<?php echo $resultQuestionData['answerScore']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="btnCancel" class="mb-2 btn btn-danger">Annuleren
                        </button>
                        <input type="submit" name="btnConfirmEditAnswer" id="btnConfirmEditAnswer"
                               class="mb-2 btn btn-primary"
                               value="Antwoord Opslaan"></div>
                </div>

            </form>
            <?php
            $questionID = $_GET['qID'];
            if (isset($_POST['btnConfirmEditAnswer'])) {
                $Answer = $_POST['txAnswer'];
                $AnswerScore = $_POST['txScore'];

                $QF->updateQuestionAnswer($answerID, $Answer, $AnswerScore);
                $url = "http://localhost/AssistRecruitment/view/QA_QuestionEdit.php?questionID=" . $questionID;
                ?>
                <script>window.location = '<?php echo $url ?>';</script><?php
            }

            if (isset($_POST['btnCancel'])) {
                $url = "http://localhost/AssistRecruitment/view/QA_QuestionEdit.php?questionID=" . $questionID;
                ?>
                <script>window.location = '<?php echo $url ?>';</script><?php
            }
            ?>
        </div>
    </div>
</div>
</body>