<?php
require_once 'head.php';
require_once 'menu.php';
?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een questionair.">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn add-container__btn ButtonRight"><i class="fas fa-plus-circle"></i> Questionair toevoegen</button>
            </div>
        </div>
        <div>
            <table id="QaTable" class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require("../functions/controller/QuestionairController.php");
                $questionair = new QuestionairController();
                $lijstQuestionair = $questionair->GetQuestionair();
                foreach ($lijstQuestionair as $item)
                {
                    echo'<tr id="RowFilter">';
                    echo '<td>';
                    echo $item->getQuestionairName();
                    echo '</td>';
                    echo '<td>';
                    echo  $item->getQuestionairStatus();
                    echo '</td>';
                    echo '<td>';
                    echo '<a id="'.$item->getQuestionairID().'" onclick="SendID(this.id)"><i class="fas tab-table__icon editKnop">&#xf044;</i></a>';
                    echo  ' ';
                    echo '<a id="'.$item->getQuestionairID().'" onclick="SendID(this.id)" data-id="'.$item->getQuestionairID().'"><i class="fas tab-table__icon deleteKnop">&#xf187;</i></a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#Filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#QaTable #RowFilter").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
