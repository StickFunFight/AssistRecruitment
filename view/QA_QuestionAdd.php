<?php
    require_once 'head.php';
    require_once '../functions/controller/QA_QuestionFunctions.php';
    $QF = new QA_QuestionFunctions();

?>
<link rel="stylesheet" type="text/css" href="../assests/styling/QA_QuestionStyle.css">
<body>
<label id="lbTitel">Voeg vraag toe</label>
    <form method="post">
        <div class="form-group row">
            <label for="selCategory" class="col-sm-2 col-form-label" >Categorie</label>
            <div class="col-sm-10">
                <select id="selCategory" name="selCategory" class="form-control">
                    <?php $QF->getCategories(); ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="txQuestion" class="col-sm-2 col-form-label" >Vraag</label>
            <div class="col-sm-10">
                <input id="txQuestion" name="txQuestion" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="taExample" class="col-sm-2 col-form-label" >Voorbeeld</label>
            <div class="col-sm-10">
                <textarea id="taExample" name="taExample" class="form-control">
                </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="selStatus" class="col-sm-2 col-form-label" >Status</label>
            <div class="col-sm-10">
                <select id="selStatus" name="selStatus" class="form-control">
                    <option value="active">Actief</option>
                    <option value="archived">Gearchiveerd</option>
                    <option value="deleted">Verwijderd</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="selQuestionType" class="col-sm-2 col-form-label" >Vraag type</label>
            <div class="col-sm-10">
                <select id="selQuestionType" name="selQuestionType" class="form-control">
                    <option value="OCAI">OCAI</option>
                    <option value="Question-answer">Vraag-antwoord</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" id="btConfirm" name="btConfirm" class="form-control">
            </div>
        </div>

    </form>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
<script>

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        });

</script>
<?php

if(isset($_POST['btConfirm'])){
    $selCategory = $_POST['selCategory'];
    $txQuestion = $_POST['txQuestion'];
    $taExemple = $_POST['taExample'];
    $selStatus = $_POST['selStatus'];
    $selQuestionType = $_POST['selQuestionType'];

    echo $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType;
    $QF->setQuestion($selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);

}

?>
<script>

    $('#btnConfirm').click(function(){

    });
</script>
</body>