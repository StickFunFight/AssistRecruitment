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
            <div>
                <table id="QaTable" class="table">
                    <thead>
                    <tr>
                        <th>Axis</th>
                        <th>Axis Status</th>
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
                        echo '</td>';
                        echo '<td>';
                        echo  $item->getAxisStatus();
                        echo '</td>';
                        echo '<td>';
                        echo  '<i id="'.$item->getAxisId().'" class="fas fa-pencil-alt"></i>';
                        echo  ' ';
                        echo  '<i id="'.$item->getAxisId().'" class="fas fa-trash-alt"></i>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>





