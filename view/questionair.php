<?php
require_once 'head.php';
require_once 'menu.php';


?>
<html>
<link rel="stylesheet" href="../assests/styling/QaStyling.css">
<link rel="stylesheet" href="../assests/styling/customer.scss">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
<body>
<div id="page-content">
    <div class="container-fluid">
        <div class="row QaTopMargin">
            <div class="col-sm-6">
                <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een questionair.">
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn add-container__btn ButtonRight"><i class="fas fa-plus-circle"></i> Questionair toevoegen</button>
            </div>
        </div>
        <div>
            <table id="QaTable" class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require("../functions/controller/QuestionairController.php");
                $questionair = new QuestionairController();
                $lijstQuestionair = $questionair->GetQuestionair();
                foreach ($lijstQuestionair as $item)
                {
                    echo'<tr id="RowFilter">';
                    echo '<td>';
                    echo $item->getQuestionairName();
                    echo '</td>';
                    echo '<td>';
                    echo  $item->getQuestionairStatus();
                    echo '</td>';
                    echo '<td>';
                    echo '<a id="'.$item->getQuestionairID().'" onclick="SendID(this.id)"><i class="fas tab-table__icon editKnop">&#xf044;</i></a>';
                    echo  ' ';
                    echo '<a id="'.$item->getQuestionairID().'" onclick="SendID(this.id)" data-id="'.$item->getQuestionairID().'" data-toggle="modal" data-target="#questionairArchiveModal"><i class="fas tab-table__icon deleteKnop">&#xf187;</i></a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="questionairArchiveModal" tabindex="-1" role="dialog" aria-labelledby="questionairArchiveModal" aria-hidden="true">
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
                        <label for="message-text" class="col-form-label">Weet je zeker dat je de questionair: "" wilt archiveren?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="btnArchiveerQair" id="btnArchiveer" class="btn btn-danger" value="Ja">Ja</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">nee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function(){
        $("#Filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#QaTable #RowFilter").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $('#questionairArchiveModal').on('show.bs.modal', function (event) {
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
        window.QuestionairID = clicked_id;
    }

    $('#btnArchiveer').click(function () {
        $.ajax({
            url: 'questionairArchiveHandler.php',
            type: 'post',
            data: { "questionairID": QuestionairID},
            success: function(response) {
                window.location.href = 'questionair.php';
                console.log(response);
                },
            error: function (exception){
                console.log(exception);
            }
        });
    });
</script>
</html>
<?php





