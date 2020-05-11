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
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een Axis doormiddel van de naam of status">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-success ButtonRight" data-toggle="modal" data-target="#AxisAddModal"><i class="fas fa-plus-circle"></i>Axis toevoegen</button>
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
                        echo '<a class="editKnop" id="'.$item->getAxisId().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#AxisEditModal"><i class="fas tab-table__icon">&#xf044;</i></a>';
                        echo  ' ';
                        echo '<a class="deleteKnop"  id="'.$item->getAxisId().'" onclick="SendID(this.id)" data-toggle="modal" data-target="#AxisArchiveModal" data-id="'.$item->getAxisId().'"><i class="fas tab-table__icon">&#xf187;</i></a>';
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
<div class="modal fade" id="AxisAddModal" tabindex="-1" role="dialog" aria-labelledby="AxisAddModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Axis aanmaken</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label for="AxisAddtxt">Axis naam:</label>
                    <input type="text" name="AxisAddtxt" id="AxisAddtxt"/>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="AxisAddOpslaan" class="btn btn-primary" data-dismiss="modal" value="Axis Opslaan"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Editing Modal-->
<div class="modal fade" id="AxisEditModal" tabindex="-1" role="dialog" aria-labelledby="AxisEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Axis aanpassen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label for="txtAxisNaam">Nieuwe Axisnaam:</label>
                    <input type="text" name="txtAxisNaam" id="txtAxisNaam"/>
                    <br>
                    <label for="txtAxisStatus">Status:</label>
                    <input type="text" name="txtAxisStatus" id="txtAxisStatus" value="Active"/>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnCatEditAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                    <input type="button" name="btnOpslaan" id="AxisEditOpslaan" class="btn btn-primary" data-dismiss="modal" value="Axis Opslaan"/>
                </div>
            </form>
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
                url : '../functions/handler/QA-Axis-Archive.php', //Here you will fetch records
                data :  'rowid='+ rowid, //Pass $id
                success : function(data){
                    $('.fetched-data').html("Weet je zeker dat je de axis: " + data + " wilt archiveren?");//Show fetched data from database
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
            url: '../functions/handler/QA-Axis-Archive.php',
            type: 'post',
            data: { "AxisID": AxisID},
            success: function(response) { window.location.href = 'Axis.php'; }
        });
    });

    $('#AxisAddOpslaan').click(function () {
        $.ajax({
            url: '../functions/handler/AxisAddHandler.php',
            type: 'post',
            data: { "AxisName": $('#AxisAddtxt').val()},
            success: function(response) { window.location.href = 'Axis.php'; }
        });
    });

    $('#AxisEditOpslaan').click(function () {
        $.ajax({
            url: '../functions/handler/AxisEditHandler.php',
            type: 'post',
            data: { "AxisName": $('#txtAxisNaam').val(), "AxisStatus" : $('#txtAxisStatus').val(), "AxisID": AxisID},

            success: function(response) { window.location.href = 'Axis.php'; },
        });
    });

</script>





