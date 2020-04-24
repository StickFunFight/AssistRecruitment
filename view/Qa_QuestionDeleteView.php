<?php

require_once 'head.php';
require_once '../functions/datalayer/database.class.php';
require_once '../functions/datalayer/Qa_QuestionDeleteDatabase.php';
$QD = new QaQuestionDeleteDatabase();
$Qid = "2";
?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >verwijder vraag</button>

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
                <form method="POST">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Weet je zeker dat je de vraag: "<?php $QD->showQ($Qid); ?>" wilt verwijderen?</label>
                    </div>
                <div class="modal-footer">
                    <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-danger" value="Ja">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['btnDelete'])){
    $QD->DeleteQaQuestion($Qid);
}
 ?>
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

    $('#btnDelete').click(function () {
        $.ajax({
            url: 'QaDeleteHandler.php',
            type: 'post',
            data: { "questionName": $('#textField').val()},
            success: function(response) { console.log(response); }
        });
    });
</script>




