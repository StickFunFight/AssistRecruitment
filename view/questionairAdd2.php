<?php

require_once 'head.php';
require_once 'menu.php';

?>
<html
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
                require '../functions/controller/questionairController.php';
                require '../functions/models/EntQuestion.php';
                $QC = new questionairController();
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
    </div>
</div>

<!-- AxisAddModal -->
<div class="modal fade" id="questionairAddModal" tabindex="-1" role="dialog" aria-labelledby="questionairAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Vraag toevoegen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-target="#questionDropDown">
                        Dropdown button
                    </button>
                    <div class="dropdown-menu" id="questionDropDown">
                    <?php
                    require '../functions/controller/questionairController.php';
                    require '../functions/models/EntQuestion.php';
                    $QC = new questionairController();
                    $lijstQuestionair = $QC->getQuestionairList();
                    foreach ($lijstQuestionair as $item)
                    {
                        echo '<option id="'.$item->getQuestionID().'">'.$item->getQuestionName().'</option>';

                    }
                    ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="AxisAddOpslaan" class="btn btn-primary" data-dismiss="modal" value="Axis Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>



</html>

<script>

    $(".dropdown").on("show.bs.dropdown", function(event){
        var x = $(event.relatedTarget).text(); // Get the text of the element
        alert(x);
    });

</script>