<?php

require 'head.php';


?>


<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Categorie aanpassen
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="categorien">Kies een categorie:</label>

                    <select id="categorien">
                        <?php
                            require_once '../functions/datalayer/database.class.php';
                            $database = new Database();
                            $db = $database->getConnection();

                            $query = "SELECT categorieName FROM categorie";

                            $stm = $db->prepare($query);
                            if($stm->execute()){

                                $cat = $stm->fetchAll(PDO::FETCH_ASSOC);
                                foreach($cat as $categorie){

                                  ?> <option id="<?php echo $categorie['categorieName']?>"><?php echo $categorie['categorieName'] ?></option>;
                                    <?php

                                }
                            }

                        ?>

                    </select>
                    <br>

                    <label for="txtNaam">Nieuwe categorienaam:</label>
                    <input type="text" name="textFieldNaam" id="txtNaam"/>
                    <br>
                    <label for="txtStatus">Status:</label>
                    <input type="text" name="textFieldStatus" id="txtStatus"/>
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
            url: '../functions/controller/catEditHandler.php',
            type: 'post',
            data: { "catName": $('#txtNaam').val(), "catStatus" : $('#txtStatus').val(), "oldCatName": $('#categorien').val()},
            success: function(response) { window.location.href = 'Qa.php'; }
        });


    });

</script>

</body>