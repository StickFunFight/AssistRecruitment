<?php

require_once 'head.php';
require_once 'menu.php';
require '../functions/controller/questionairController.php';

if (isset($_GET['qID'])){
    $ID = $_GET['qID'];
    $QC = new questionairController();
    $QC->setQuestionairID($ID);
}

?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <button type="button" class="btn btn-success ButtonRight" data-toggle="modal" data-target="#questionairAddModal"><i class="fas fa-plus-circle"></i>Vraag Toevoegen</button>
            </div>
        </div>
        <div>
            <table id="QaTable" class="table">
                <thead>
                <tr>
                    <th>Vraag</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require '../functions/models/EntQuestion.php';
                $lijstQuestionair = $QC->getQuestionairList();
                foreach ($lijstQuestionair as $item)
                {
                    echo'<tr id="RowFilter">';
                    echo '<td id="'.$item->getQuestionID().'">';
                    echo $item->getQuestionName();
                    echo '</td>';
                    echo '<td>';
                    echo  $item->getQuestionType();
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success ButtonLeft" id="btnKlaar">Volgende</button>
    </div>
</div>

<!-- QuestionairQuestionAddModal -->
<div class="modal fade" id="questionairAddModal" tabindex="-1" role="dialog" aria-labelledby="questionairAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Vraag toevoegen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
            <div class="modal-body">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Vraag toevoegen
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        $lijstQuestion = $QC->getQuestions();
                        foreach ($lijstQuestion as $question)
                        {
                            echo '<a class="dropdown-item" id="'.$question->getQuestionID().'" onclick="SendID(this.id)" >'.$question->getQuestionName().'</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success ButtonLeft" id="VraagOpslaan">Toevoegen</button>
                <button class="btn btn-danger" id="btnAnnuleer" data-toggle="modal" data-target="#questionairAddModal">Annuleer</button>
            </div>
            </form>
        </div>
    </div>
</div>



<?php

//$QD = new QuestionairDatabase();
//if (isset($_POST['btnOpslaan'])){
//    $QID = $_POST['questionList'];
//    echo $QID. $ID;
//    $QD->add($ID, $QID);
//    Header("Location: questionairAdd2.php?qID=$ID&vraag=$QID");
//
//}
?>

</html>

<script>

    $(".dropdown").on("show.bs.dropdown", function(event){
        var x = $(event.relatedTarget).text(); // Get the text of the element
        alert(x);
    });

    $(document).ready(function(){
        $(".dropdown-toggle").dropdown();
    });



    $('#VraagOpslaan').click(function () {
        $.ajax({
            url: 'questionairAddHandler2.php',
            type: 'post',
            data: { "questionairID": <?php echo $ID ?> ,"questionID": QuestionID},
            success: function(response) {

                window.location.href = 'questionairAdd2.php?qID=<?php echo $ID?>';
            }
        });
    });

    $('#btnKlaar').click(function (){
       window.location.href = 'questionair.php';
    });

</script>

<!-- Linking voor jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Linking to Bootstrap JavaScript -->
<script src="../assests/bootstrap/js/bootstrap.min.js"></script>

<script>
    function SendID(clicked_id)
    {
        console.log(clicked_id);
        window.QuestionID = clicked_id;
    }
</script>