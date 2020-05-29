<?php
require_once 'menu.php';
require_once '../functions/controller/QA_QuestionFunctions.php';
$QF = new QA_QuestionFunctions();

?>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div id="modalEditQuestion">
            <div class="header">
                <h1 class="title" id="exampleModalLabel">Antwoord toevoegen</h1>
            </div>
            <form method="POST">
                <div class="form-group row">
                    <label for="txQuestion" class="col-sm-2 col-form-label">Antwoord</label>
                    <div class="col-sm-10">
                        <input id="txAnswer" name="txAnswer" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txScore" class="col-sm-2 col-form-label">Score</label>
                    <div class="col-sm-10">
                        <input id="txScore" name="txScore" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="btnCancel" class="mb-2 btn btn-danger">Annuleren
                        </button>
                        <input type="submit" name="btnConfirmAddAnswer" id="btnConfirmAddAnswer"
                               class="mb-2 btn btn-primary"
                               value="Antwoord Opslaan"></div>
                </div>

            </form>
            <?php
            $questionID = $_GET['qID'];
            if (isset($_POST['btnConfirmAddAnswer'])) {
                $Answer = $_POST['txAnswer'];
                $AnswerScore = $_POST['txScore'];

                $QF->setQuestionAnswer($Answer, $AnswerScore, $questionID);
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