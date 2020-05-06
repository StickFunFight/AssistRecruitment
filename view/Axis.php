<?php
require_once 'head.php';
require_once 'menu.php';
?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een vraag of antwoord">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-success ButtonRight"><i class="fas fa-plus-circle"></i> Vraag toevoegen</button>
            </div>
        </div>
            <div>
                <table id="QaTable" class="table">
                    <thead>
                    <tr>
                        <th>Axis</th>
                        <th>Axis Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require("../functions/controller/AxisController.php");
                    require '../functions/models/EntAxis.php';
                    $Axis = new AxisController();
                    $lijstAxis = $Axis->getAxis();
                    foreach ($lijstAxis as $item)
                    {
                        echo'<tr id="RowFilter">';
                        echo '<td id="'.$item->getAxisName().'">';
                        echo $item->getAxisName();
                        echo '</td>';
                        echo '<td>';
                        echo  $item->getAxisStatus(); 
                        echo '</td>';
                        echo '<td>';
                        echo '<a class="editKnop" id="'.$item->getAxisId().'"><i class="fas tab-table__icon">&#xf044;</i></a>';
                        echo  ' ';
                        echo '<a class="deleteKnop" id="'.$item->getAxisId().'"><i class="fas tab-table__icon">&#xf2ed;</i></a>';
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





