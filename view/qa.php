<?php
require_once 'head.php';
require_once 'menu.php';


?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een vraag of antwoord">
            </div>
            <div class="col-sm-6">
                <button type="button" data-toggle="modal" data-target="#modaladdQuestion" class="btn btn-primary ButtonRight"><i class="fas fa-plus"></i> Vraag toevoegen</button>
            </div>
        </div>
        <div id="wrapper">
            <div id="FirstQaDiv">
                <table class="table">
                    <thead>
                    <tr>
                    <th><i class="fas fa-folder-open"></i> (All Categories)</th>
                        <th><i id="CategoryAdd" class="fas fa-plus fa-lg" data-target="#modalCatAdd" data-toggle="modal"></i> </th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            require("../functions/datalayer/QaOverView.php");
                            $QO = new QaOverView();
                            $Qa = $QO->GetAllCategories();
                            foreach ($Qa as $item)
                            {
                                echo '<tr class="category-tabel__row" onclick="filterSelection('.$item->GetID().')">';
                                echo '<td value="'.$item->GetID().'">';
                                echo '<i id="Icon" class="fas fa-folder"></i>';
                                echo " ";
                                echo  $item->GetNaam();
                                echo '</td>';
                                echo '<td>';
                                echo '<i id="'.$item->GetID().'" onClick="SendID(this.id)" data-toggle="modal" data-target="#editCategory" class="fas fa-pencil-alt table--icon"></i>';
                                echo " ";
                                echo '<a href="https://www.youtube.com/watch?v=i7MfrslYUac"><i id="'.$item->GetID().'" class="fas fa-trash-alt table--icon"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>

                    </tbody>
                </table>
            </div>
            <div id="SecondQaDiv">
                <table id="QaTable" class="table">
                    <thead>
                    <tr>
                        <th>Questions</th>
                        <th>Answers options</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $QO = new QaOverView();
                    $Qa = $QO->GetQuestionAnswers();
                    foreach ($Qa as $item)
                    {
                        echo'<tr>';
                        echo '<td id="'.$item->getCategorieID().'">';
                        echo  $item->getQuestionName();
                        echo '</td>';
                        echo '<td>';
                        foreach ($item->getAnswers() as $test) {
                            echo "<span class='RuimteVragen'>$test.</span>";
                        }
                        echo '</td>';
                        echo '<td>';
                        echo  '<i id="'.$item->getQuestionID().'" name="questionIDEdit" onClick="SendID(this.id)" class="fas fa-pencil-alt" data-toggle="modal" data-target="#modalEditQuestion"></i>';
                        echo  ' ';
                        echo  '<i id="'.$item->getQuestionID().'" class="fas fa-trash-alt"></i>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal AddCategory-->
<div class="modal fade" id="modalCatAdd" tabindex="-1" role="dialog" aria-labelledby="modalCatAdd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Categorie aanmaken</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label for="textField">Categorie aanmaken:</label>
                    <input type="text" name="textField" id="textField"/>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnCatAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="btnCatOpslaan" class="btn btn-primary" data-dismiss="modal" value="Categorie Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Category-->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Categorie aanpassen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label for="txtNaam">Nieuwe categorienaam:</label>
                    <input type="text" name="textFieldNaam" id="txtNaam"/>
                    <br>
                    <label for="txtStatus">Status:</label>
                    <input type="text" name="textFieldStatus" id="txtStatus"/>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnCatEditAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="btnCatEditOpslaan" class="btn btn-primary" data-dismiss="modal" value="Categorie Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require("../functions/controller/QA_QuestionFunctions.php");
$QF = new QA_QuestionFunctions(); ?>

<!-- Modal Add Question-->
<div class="modal fade" id="modaladdQuestion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalQuestionAdd" aria-hidden="true">
    <form method="POST">
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
                            <select required id="selCategoryQuestionAdd" name="selCategoryQuestionAdd" class="form-control">
                                <?php $QF->getCategories(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txQuestion" class="col-sm-2 col-form-label" >Vraag</label>
                        <div class="col-sm-10">
                            <input id="txQuestionAdd" name="txQuestionAdd" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="taExample" class="col-sm-2 col-form-label" >Voorbeeld</label>
                        <div class="col-sm-10">
                            <textarea id="taExampleAdd" name="taExampleAdd" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selStatus" class="col-sm-2 col-form-label" >Status</label>
                        <div class="col-sm-10">
                            <select id="selStatusQuestAdd" name="selStatusQuestAdd" class="form-control" required>
                                <option value="Active">Actief</option>
                                <option value="Archived">Gearchiveerd</option>
                                <option value="Deleted">Verwijderd</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selQuestionType" class="col-sm-2 col-form-label" >Vraag type</label>
                        <div class="col-sm-10">
                            <select id="selQuestionTypeQuestionAdd" name="selQuestionTypeQuestionAdd" class="form-control" required>
                                <option value="OCAI">OCAI</option>
                                <option value="Question-answer">Vraag-antwoord</option>
                            </select>
                        </div>
                    </div>

                    <div name="divAnswerOptionsAdd" id="divAnswerOptions" class="form-group row" style="display:none;">
                        <label for="answerOptionsQuestionAdd" class="col-sm-2 col-form-label" >Antwoord opties</label>
                        <div class="col-sm-10">
                            <table name="answerOptionsQuestionAdd"></table>
                            <label>OPEN</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <input type="submit" class="btn btn-primary" id="btConfirmAddQuestion" name="btConfirmAddQuestion" value="Verzenden"/>
                    </div>
                </div>
            </div>
    </form>

    <script>

        $('#selQuestionTypeQuestionAdd').change(function(){
            if($(this).val() == "Question-answer") {
                $('#divAnswerOptionsAdd').show();
            }
            else{
                $('#divAnswerOptionsAdd').hide();
            }
        });
    </script>
    <?php
        if(isset($_POST['btConfirmAddQuestion'])){
            $selCategory = $_POST['selCategoryQuestionAdd'];
            $txQuestion = $_POST['txQuestionAdd'];
            $taExemple = $_POST['taExampleAdd'];
            $selStatus = $_POST['selStatusQuestAdd'];
            $selQuestionType = $_POST['selQuestionTypeQuestionAdd'];
            echo $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType;
            $QF->setQuestion($selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);
        }
    ?>
</div>

<!-- Modal Edit Question -->
<div class="modal fade" id="modalEditQuestion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalQuestionEdit" aria-hidden="true">
    <form method="POST">
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
                            <select required id="selCategoryQuestionEdit" name="selCategoryQuestionEdit" class="form-control">
                                <?php $QF->getCategories(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txQuestion" class="col-sm-2 col-form-label" >Vraag</label>
                        <div class="col-sm-10">
                            <input id="txQuestionEdit" name="txQuestionEdit" class="form-control" value="<?php echo $resultsQuestion['questionName']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="taExample" class="col-sm-2 col-form-label" >Voorbeeld</label>
                        <div class="col-sm-10">
                            <textarea required id="taExampleQuestionEdit" name="taExampleQuestionEdit" class="form-control"><?php echo $resultsQuestion['questionExemple']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selStatus" class="col-sm-2 col-form-label" >Status</label>
                        <div class="col-sm-10">
                            <select id="selStatusQuestEdit" name="selStatusQuestEdit" class="form-control" required>
                                <option value="Active">Actief</option>
                                <option value="Archived">Gearchiveerd</option>
                                <option value="Deleted">Verwijderd</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="selQuestionTypeQuestionEdit" class="col-sm-2 col-form-label" >Vraag type</label>
                        <div class="col-sm-10">
                            <select id="selQuestionTypeQuestionEdit" name="selQuestionTypeQuestionEdit" class="form-control" required>
                                <option value="OCAI">OCAI</option>
                                <option value="Question-answer">Vraag-antwoord</option>
                            </select>
                        </div>
                    </div>

                    <div name="divAnswerOptionsEdit" id="divAnswerOptionsEdit" class="form-group row" style="display:none;">
                        <label for="answerOptionsQuestionAdd" class="col-sm-2 col-form-label" >Antwoord opties</label>
                        <div class="col-sm-10">
                            <table name="answerOptionsQuestionAdd"></table>
                            <label>OPEN</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <input type="submit" class="btn btn-primary" id="btConfirmEditQuestion" name="btConfirmEditQuestion" value="Verzenden"/>
                    </div>
                </div>
            </div>
    </form>

    <script>
        $('#selQuestionTypeQuestionEdit').change(function(){
            if($(this).val() == "Question-answer") {
                $('#divAnswerOptionsEdit').show();
            }
            else{
                $('#divAnswerOptionsEdit').hide();
            }
        });
    </script>
    <?php


    if(isset($_POST['btConfirmEditQuestion'])){


        $CategorieID = $_POST['questionIDEdit'];
        $resultsQuestion = $QF->getQuestionData($CategorieID);

        $selCategory = $_POST['selCategoryQuestionEdit'];
        $txQuestion = $_POST['txQuestionEdit'];
        $taExemple = $_POST['taExampleQuestionEdit'];
        $selStatus = $_POST['selStatusQuestEdit'];
        $selQuestionType = $_POST['selQuestionTypeQuestionEdit'];

        $QF->updateQuestion($questionID, $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);
    }
    ?>
</div>

</body>
</html>
<script>
    $(document).ready(function(){
        $("#Filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#QaTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function filterSelection(ID) {
        var input, filter, table, tr, td, i;
        input = ID;
        table = document.getElementById("QaTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.id.indexOf(input) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    $('#modalCatAdd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    })
    $('#btnCatOpslaan').click(function () {
        $.ajax({
            url: '../functions/controller/catHandler.php',
            type: 'post',
            data: { "catName": $('#textField').val()},
            success: function(response) { window.location.href = 'Qa.php'; }
        });
    });

    $('#editCategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    })

    function SendID(clicked_id)
    {
        window.categoryID = clicked_id;
        alert(clicked_id);
    }

    $('#btnCatEditOpslaan').click(function () {
        $.ajax({
            url: '../functions/controller/catEditHandler.php',
            type: 'post',
            data: { "catName": $('#txtNaam').val(), "catStatus" : $('#txtStatus').val(), "CustomerID": categoryID},

            success: function(response) { window.location.href = 'Qa.php'; },
        });
    });
</script>




