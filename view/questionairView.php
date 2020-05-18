<?php
require_once 'head.php';
require_once '../functions/datalayer/database.class.php';


$QairID = "1";

?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >archiveer questionair</button>




<script>

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })


</script>


