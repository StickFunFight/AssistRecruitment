<?php  
    // Checking if there is a customer given in the link
    //if(isset($_GET['customerID'])){

        //require("/functions/modals/CustomerModalMarvin.php");
        include "/functions/controller/CustomerEdit.php";
        $ctrlCustomer = new CustomerMarvin();

        //require('menu.php');
?>
<html>
    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <h1 class="ce__title">Edit customer<h1>
                    </div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row justify-content-md-center ce--form-row">
                        <div class="col-sm-6">
                            <label for="customerName" class="ce__label">Name</label>
                            <input type="text" name="txtCustomerName" id="customerName" value="<?php ?>" class="form-control ce--input" required onchange=""/>
                            <span class="ce__feedback" id="feedbackCustomerName"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="customerRefrence" class="ce__label">Refrence</label>
                            <input type="text" name="txtcustomerRefrence" id="customerRefrence" value="<?php ?>" class="form-control ce--input" required onchange=""/>
                            <span class="ce__feedback" id="feedbackCustomerRefrence"></span>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-sm-6">
                            <label for="customerComment" class="ce__label">Comment</label>
                            <textarea name="txtCustomerComment" id="customerComment" class="form-control ce--input" rows="5" onchange=""></textarea>
                            <span class="ce__feedback" id="feedbackCustomerComment"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="status" class="ce__label">Status</label>
                            <select class="form-control" name="cbxStatus" id="status" onchange="">
                               <?php 
                                    // // Functies ophalen
                                    // $listStatus = $ctrlCustomer->getStatus();

                                    // // Loop om door de functies heen te lopen
                                    // foreach($listStatus as $status){
                                    //     ?>
                                             <option value="iets">iets</option>
                                         <?php
                                    // }
                               ?>
                            </select>
                            <span class="ce__feedback" id="feedbackCustomerStatus"></span>
                    </div>
                </form>
            </div>
        </div> 
    </body>
</html>
<?php
    // If no customer is set
    // }
    // else header('Location: #');
?>