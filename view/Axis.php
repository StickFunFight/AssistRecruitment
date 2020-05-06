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
                        echo '<a class="deleteKnop"  id="'.$item->getAxisId().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#AxisArchiveModal" data-id="'.$item->getAxisId().'"><i class="fas tab-table__icon">&#xf2ed;</i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

<!--Archiving Modal-->
<div class="modal fade" id="AxisArchiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="message-text" class="col-form-label fetched-data"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnArchiveer" id="btnArchiveer" class="btn btn-danger" value="Ja">Ja</button>
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
            $("#QaTable #RowFilter").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function(){
        $('#AxisArchiveModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '../functions/controller/QA-Axis-Archive.php', //Here you will fetch records
                data :  'rowid='+ rowid, //Pass $id
                success : function(data){
                    $('.fetched-data').html("Weet je zeker dat je axis: " + data + " wilt verwijderen?");//Show fetched data from database
                }
            });
        });
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

    function SendID(clicked_id)
    {
        window.AxisID = clicked_id;
    }

    $('#btnArchiveer').click(function () {
        $.ajax({
            url: '../functions/controller/QA-Axis-Archive.php',
            type: 'post',
            data: { "AxisID": AxisID},
            success: function(response) { window.location.href = 'Axis.php'; }
        });
    });


</script>





