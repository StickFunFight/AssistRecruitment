<?php

require 'head.php';


?>


<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AxisAddModal">
    Nieuwe Axis
</button>

<!-- Modal -->
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
                    <label for="AxisAddtxt">Axis aanmaken:</label>
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
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    })

    $('#AxisAddOpslaan').click(function () {
        $.ajax({
            url: '../functions/controller/AxisAddHandler.php',
            type: 'post',
            data: { "AxisName": $('#AxisAddtxt').val()},
            success: function(response) { window.location.href = 'QA_Axis_Add.php'; }
        });
    });

</script>

</body>