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
        <h1>Questionare Edit</h1>

            <label for="txtName"><h3>Name:</h3></label>
            <input type="text" name="txtOldName" id="txtOldName" value=" <?php echo $QC->getName();?>">
            <input type="text" name="txtName" id="txtName">
            <br>
            <label for="txtStatus"><h3>Status:</h3></label>
            <input type="text" name="txtOldStatus" id="txtOldStatus" value="<?php echo $QC->getStatus();?>">
            <input type="text" name="txtStatus" id="txtStatus">
            <br>
            <label for="txtComment"><h3>Comment:</h3></label>
            <input type="text" name="txtOldComment" id="txtOldComment" value="<?php echo $QC->getComment();?>">
            <input type="text" name="txtComment" id="txtComment">
            <br>
            <button type="button" id="Update" class="btn btn-success ButtonLeft">Update</button>


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
                        <th>Actions</th>
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
                        echo '<td>';
                        echo '<a id="'.$item->getQuestionID().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#deleteQuestionModal"><i class="fas tab-table__icon deleteKnop">&#xf187;</i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-success ButtonLeft" id="btnKlaar" onclick="next()">Volgende</button>

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
                            Dropdown button
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

<!-- Modal Archive Question-->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <h5 class="modal-title" id="exampleModalLabel">New message</h5>-->
                <button type="button" class="ja" data-dismiss="modal" aria-label="ja">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="message-text" class="col-form-label">weet je zeker dat je de vraag wilt verwijderen?</label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnVraagDelete">ja</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
            </div>
        </div>
    </div>
</div>

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


    $('#btnVraagDelete').click(function () {
        $.ajax({
            url: 'questionairEditHandler.php',
            type: 'post',
            data: { "questionairID": <?php echo $ID ?> ,"questionID": QuestionID},
            success: function(response) {

                window.location.href = 'questionairEdit.php?qID=<?php echo $ID?>';
            }
        });
    });

    $('#Update').click(function () {
        $.ajax({
            url: 'questionairUpdateHandler.php',
            type: 'post',
            data: { "questionairID": <?php echo $ID;?>, "questionairName": $('#txtName').val(), "questionairComment": $('#txtComment').val(), "questionairStatus": $('#txtStatus').val()},
            success: function(response) {
                window.location.href = 'questionairEdit.php?qID=<?php echo $ID?>';
            }
        });
    });

    function next()
    {
        window.location.href = 'questionair.php';
    }


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
