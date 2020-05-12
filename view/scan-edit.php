<?php
//Include Menu
require('menu.php');

$id = $_GET['Id'];

require("../functions/controller/ScanController.php");
require '../functions/models/entScan.php';
$Scan = new ScanController();
$lijstScan = $Scan->GetScan($id);
foreach ($lijstScan as $item){
echo $item->getScanReminderText();
}
?>
<html>
<head>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">
</head>
<body>
<div class="page__container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="ce__title" id="pageTitle">Edit User</h1>
            </div>
        </div>

        <form method="POST" autocomplete="off">
            <div class="row ce--form-row">
                <div class="col-sm-6">
                    <label for="Name" class="ce__label">Name</label>
                    <input type="text" name="txtName" id="name" value="" class="form-control ce--input" required/>
                </div>

                <div class="col-sm-6">
                    <label for="Comment" class="ce__label">Comment</label>
                    <input type="text" name="TxtComment" id="Comment" value="" class="form-control ce--input" required/>
                </div>
            </div>
            <div class="row ce--form-row">
                <div class="col-sm-6">
                    <label for="Introduction" class="ce__label">Introductie</label>
                    <input type="text" name="Txtintro" id="name" value="" class="form-control ce--input" required/>
                </div>

                <div class="col-sm-6">
                    <label for="Reminder" class="ce__label">Reminder</label>
                    <input type="tel" name="TxtReminder" id="Reminder" value="" class="form-control ce--input"
                           required/>
                </div>
            </div>
            <div class="row ce--form-row">
                <div class="col-sm-6">
                    <label for="StartDate" class="ce__label">Start Date</label>
                    <input type="date" name="DpStart" id="EndDate" value="" class="form-control ce--input" required/>
                </div>

                <div class="col-sm-6">
                    <label for="EndDate" class="ce__label">End date</label>
                    <input type="date" name="DpEnd" id="EndDate" value="" class="form-control ce--input" required/>
                </div>

                <div class="col-sm-6">
                    <label for="status" class="ce__label">Status</label>
                    <select class="form-control" name="cbxStatus" id="status">
<!--                        --><?php
//                        $customerStatus[] = "Active";
//                        $customerStatus[] = "Archived";
//                        $customerStatus[] = "Deleted";
//
//                        foreach ($customerStatus as $value) {
//                            if ($value == $customer->getCustomerStatus()) {
//                                ?>
<!--                                <option selected="selected" value="--><?php //echo $value; ?><!--">--><?php //echo $value; ?><!--</option>-->
<!--                                --><?php
//                            } else {
//                                ?>
<!--                                <option value="--><?php //echo $value; ?><!--">--><?php //echo $value; ?><!--</option>-->
<!--                                --><?php
//                            }
//                        }
//                        ?>
                    </select>
                    <span class="ce__feedback" id="feedbackCustomerStatus"></span>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
