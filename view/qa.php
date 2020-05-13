<?php
require_once 'head.php';
require_once 'menu.php';


?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een vraag of antwoord">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn add-container__btn ButtonRight"><i class="fas fa-plus-circle"></i> Vraag toevoegen</button>
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
                        echo '<i id="'.$item->GetID().'" onClick="SendID(this.id)" data-toggle="modal" data-target="#editCategory" class="fas fa-edit table--icon"></i>';
                        echo " ";
                        echo '<i  id="'.$item->GetID().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#deleteCategoryModal" class="fas fa-trash-alt table--icon"></i>';
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
                        echo'<tr id="RowFilter">';
                        echo '<td id="'.$item->getCategorieID().'">';
                        echo  $item->getQuestionName();
                        echo '</td>';
                        echo '<td>';
                        foreach ($item->getAnswers() as $test) {
                            echo "<span class='RuimteVragen'>$test.</span>";
                        }
                        echo '</td>';
                        echo '<td>';
                        echo '<a href="QA_QuestionEdit.php?questionID='.$item->getQuestionID().'" class="editKnop" id="'.$item->getQuestionID().'" onclick="SendID(this.id)"><i class="fas tab-table__icon">&#xf044;</i></a>';
                        echo '<a id="'.$item->getQuestionID().'" onclick="SendID(this.id)"><i class="fas tab-table__icon editKnop">&#xf044;</i></a>';
                        echo  ' ';
                        echo '<a id="'.$item->getQuestionID().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#deleteQuestionModal" data-id="'.$item->getQuestionID().'"><i class="fas tab-table__icon deleteKnop">&#xf187;</i></a>';
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

<!-- Edit Question -->


<!-- Modal Add Question -->
<div class="modal fade" id="modaladdQuestion" name="modaladdQuestion" tabindex="-1" role="dialog" aria-labelledby="modaladdQuestion" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Vraag toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="selCategoryQuestionAdd" class="col-sm-2 col-form-label" >Categorie</label>
                        <div class="col-sm-10">
                            <select required id="selCategoryQuestionAdd" name="selCategoryQuestionAdd" class="form-control">
                                <?php $QF->getCategories(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txQuestionAdd" class="col-sm-2 col-form-label" >Vraag</label>
                        <div class="col-sm-10">
                            <input id="txQuestionAdd" name="txQuestionAdd" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taExampleAdd" class="col-sm-2 col-form-label" >Voorbeeld</label>
                        <div class="col-sm-10">
                            <textarea id="taExampleAdd" name="taExampleAdd" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selStatusQuestAdd" class="col-sm-2 col-form-label" >Status</label>
                        <div class="col-sm-10">
                            <select id="selStatusQuestAdd" name="selStatusQuestAdd" class="form-control" required>
                                <option value="Active">Actief</option>
                                <option value="Archived">Gearchiveerd</option>
                                <option value="Deleted">Verwijderd</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selQuestionTypeQuestionAdd" class="col-sm-2 col-form-label" >Vraag type</label>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <input type="submit" class="btn btn-primary" name="btConfirmAddQuestion" id="btConfirmAddQuestion" name="btConfirmAddQuestion" value="Verzenden"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['btConfirmAddQuestion'])){
    $selCategoryAdd = $_POST['selCategoryQuestionAdd'];
    $txQuestionAdd = $_POST['txQuestionAdd'];
    $taExempleAdd = $_POST['taExampleAdd'];
    $selStatusAdd = $_POST['selStatusQuestAdd'];
    $selQuestionTypeAdd = $_POST['selQuestionTypeQuestionAdd'];
    $QF->setQuestion($selCategoryAdd, $txQuestionAdd, $taExempleAdd, $selStatusAdd, $selQuestionTypeAdd);
}?>

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
                    <input type="text" name="textFieldStatus" id="txtStatus" value="Active"/>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnCatEditAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="btnCatEditOpslaan" class="btn btn-primary" data-dismiss="modal" value="Categorie Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Archive Category-->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="message-text" class="col-form-label">weet je zeker dat je de category wilt verwijderen?</label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCatDelete">ja</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Archive Question-->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <h5 class="modal-title" id="exampleModalLabel">New message</h5>-->
                <button type="button" class="ja" data-dismiss="modal" aria-label="ja">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label fetched-data"></label
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnDelete" id="btnQuestionDelete" class="btn btn-danger" value="Ja">Ja</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>


    $('#selQuestionType').change(function(){
        if($(this).val() == "Question-answer") {
            $('#divAnswerOptions').show();
        }
        else{
            $('#divAnswerOptions').hide();
        }
    });

    $(document).ready(function(){
        $('#deleteQuestionModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '../functions/handler/QaDeleteHandler.php', //Here you will fetch records
                data :  'rowid='+ rowid, //Pass $id
                success : function(data){
                    $('.fetched-data').html("Weet je zeker dat je de vraag: " + data + " wilt archiveren?");//Show fetched data from database
                }
            });
        });
    });

    $(document).ready(function(){
        $("#Filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#QaTable #RowFilter").filter(function() {
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
    })

    $('#btnCatOpslaan').click(function () {
        $.ajax({
            url: '../functions/handler/catHandler.php',
            type: 'post',
            data: { "catName": $('#textField').val()},
            success: function(response) {
                window.location.href='Qa.php';
            }
        });
    });

    $('#editCategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    })

    function SendID(clicked_id)
    {
        window.categoryID = clicked_id;
    }

    $('#btnCatEditOpslaan').click(function () {
        $.ajax({
            url: '../functions/handler/catEditHandler.php',
            type: 'post',
            data: { "catName": $('#txtNaam').val(), "catStatus" : $('#txtStatus').val(), "CustomerID": categoryID},

            success: function(response) { window.location.href = 'Qa.php'; },
        });
    });

    $('#deleteQuestionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

    $('#btnQuestionDelete').click(function () {
        $.ajax({
            url: '../functions/handler/QaDeleteHandler.php',
            type: 'post',
            data: { "QuestionId": categoryID},
            success: function(response) { window.location.href = 'Qa.php'; }
        });
    });

    $('#deleteCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
    })

    $('#btnCatDelete').click(function () {
        $.ajax({
            url: '../functions/handler/catDeleteHandler.php',
            type: 'post',
            data: { "catID": categoryID},
            success: function(response) { window.location.href = 'Qa.php'; }
        });
    });

</script>




