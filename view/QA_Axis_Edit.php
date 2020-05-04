<?php

require 'head.php';

?>

<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AxisEditModal">
    Axis Aanpassen
</button>

<div class="modal fade" id="AxisEditModal" tabindex="-1" role="dialog" aria-labelledby="AxisEditModalLabel" aria-hidden="true">
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
<script>
    $('#AxisEditModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    })

    function SendID(clicked_id)
    {
        window.AxisID = clicked_id;
    }

    $('#AxisEditOpslaan').click(function () {
        $.ajax({
            url: '../functions/controller/AxisEditHandler.php',
            type: 'post',
            data: { "AxisName": $('#txtAxisNaam').val(), "AxisStatus" : $('#txtAxisStatus').val(), "AxisID": 3},

            success: function(response) { window.location.href = 'QA_Axis_Edit.php'; },
        });
    });

</script>

</body>