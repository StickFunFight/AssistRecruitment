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
                <button type="button" class="btn btn-primary ButtonRight"><i class="fas fa-plus"></i> Vraag toevoegen</button>
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
                        echo  '<i id="'.$item->getQuestionID().'" class="fas fa-pencil-alt"></i>';
                        echo  ' ';
                        echo  '<i data-toggle="modal" data-target="#deleteQuestionModal" id="'.$item->getQuestionID().'" onClick="SendID(this.id)" class="fas fa-trash-alt"></i>';
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
                        <label for="message-text" class="col-form-label">Weet je zeker dat je de vraag: "" wilt verwijderen?</label>
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

    $('#deleteQuestionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

    $('#btnQuestionDelete').click(function () {
        $.ajax({
            url: '../functions/controller/QaDeleteHandler.php',
            type: 'post',
            data: { "CustomerID": categoryID},
            success: function(response) { window.location.href = 'Qa.php'; }
        });
    });

</script>




