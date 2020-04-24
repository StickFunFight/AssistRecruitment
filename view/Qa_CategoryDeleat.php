
<?php

require_once 'head.php';
require_once '../functions/datalayer/database.class.php';

?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PaginaRick" data-whatever="@mdo">verwijder category<category></category></button>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <h5 class="modal-title" id="exampleModalLabel">New message</h5>-->
                <button type="button" class="ja" data-dismiss="modal" aria-label="ja">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="message-text" class="col-form-label">weet je zeker dat je de category wilt verwijderen?</label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">ja</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
            </div>
        </div>
    </div>
</div>

<script>$('#PaginaRick').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes

        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })</script>