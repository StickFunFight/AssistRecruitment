<?php

    require 'head.php';


?>


<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Nieuwe Categorie
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" name="btnAnnuleer" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
                <input type="button" name="btnOpslaan" id="btnOpslaan" class="btn btn-primary" data-dismiss="modal" value="Categorie Opslaan"/>
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

    $('#btnOpslaan').click(function () {
        $.ajax({
            url: '../functions/controller/catHandler.php',
            type: 'post',
            data: { "catName": $('#textField').val()},
            success: function(response) { window.location.href = 'Qa.php'; }
        });
    });

</script>

</body>




