<?php
//Include Menu
require('menu.php');

$id = $_GET['Id'];

require("../functions/controller/ScanController.php");
require '../functions/models/entScan.php';
$Scan = new ScanController();
$lijstScan = $Scan->GetScan($id);
foreach ($lijstScan as $item) {

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
                    <h1 class="ce__title" id="pageTitle">Edit Scan</h1>
                </div>
            </div>

            <form method="POST" autocomplete="off">
                <div class="row ce--form-row">
                    <div class="col-sm-6">
                        <label for="Name" class="ce__label">Name</label>
                        <input type="text" name="txtName" id="name" value="<?php echo $item->getScanName(); ?>"
                               class="form-control ce--input" required/>
                    </div>
                    <div class="col-sm-6">
                        <label for="Introduction" class="ce__label">Introductie</label>
                        <input type="text" name="Txtintro" id="name"
                               value="<?php echo $item->getScanIntroductionText(); ?>" class="form-control ce--input"
                               required/>

                    </div>
                    <div class="row ce--form-row">
                    </div>
                    <div class="col-sm-6">
                        <label for="Comment" class="ce__label">Comment</label>
                        <textarea name="TxtComment" id="Comment" class="form-control ce--input"
                                  rows="5" required><?php echo $item->getScanComment(); ?></textarea>
                    </div>

                    <div class="col-sm-6">
                        <label for="Reminder" class="ce__label">Reminder</label>
                        <textarea name="TxtReminder" id="Reminder" class="form-control ce--input"
                                  rows="5" required><?php echo $item->getScanReminderText(); ?> </textarea>
                    </div>
                </div>
                <div class="row ce--form-row">
                    <div class="col-sm-6">
                        <label for="StartDate" class="ce__label">Start Date</label>
                        <input type="date" name="DpStart" id="EndDate" value="<?php echo $item->getScanStartDate(); ?>"
                               class="form-control ce--input" required/>
                    </div>

                    <div class="col-sm-6">
                        <label for="EndDate" class="ce__label">End date</label>
                        <input type="date" name="DpEnd" id="EndDate" value="<?php echo $item->getScanEndDate(); ?>"
                               class="form-control ce--input" required/>
                    </div>

                    <div class="col-sm-6">
                        <label for="status" class="ce__label">Status</label>
                        <select class="form-control" name="cbxStatus">
                            <?php
                            $scanStatus[] = "Active";
                            $scanStatus[] = "Archived";
                            $scanStatus[] = "Deleted";

                            foreach ($scanStatus as $value) {
                                if ($value == $item->getScanStatus()) {
                                    ?>
                                    <option selected="selected"
                                            value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row ce--form-row">
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-secondary btn-lg" value="Opslaan" name="BtnOpslaan"
                               id="BtnOpslaan"/>
                    </div>
            </form>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="ce__title" id="pageTitle">Publish in bulk</h1>
                </div>
            </div>
            <div class="row ce--form-row">
                <div class="col-sm-6">
                        <input type="file"  name="file" class="custom-file-input" id="file">
                        <label id="Lblcsv" class="custom-file-label ce--input" for="file">Kies csv bestand..</label>
                    <script>
                        $('#file').change(function () {
                            var value = $(this).val();
                            var result = value.substring(value.lastIndexOf("\\") + 1);
                            $('#Lblcsv').text(result);
                        })
                    </script>

                </div>
                <div class="col-sm-6">
                    <input type="submit" name="BtnImport" value="Importeren" class="btn btn-secondary btn-lg" />
                </div>
            </div>
            </div>
            </form>
        <?php
        if (isset($_POST["BtnImport"])) {
            if ($_FILES['file']['name']) {
                $filename = explode(".", $_FILES['file']['name']);
                if ($filename[1] == 'csv') {
                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while ($data = fgetcsv($handle)) {
                        $item1 = $data[0];
                        $item2 = $data[1];

                        echo $item1;
                        echo $item2;
                    }
                    fclose($handle);
                }
            }
        }
?>
    </body>
    </html>
    <?php
}
if(isset($_POST['BtnOpslaan'])) {
        $scanName= $_POST['txtName'];
        $scanComment= $_POST['TxtComment'];
        $scanStatus= $_POST['cbxStatus'];
        $scanIntroductionText= $_POST['Txtintro'];
        $scanReminderText= $_POST['TxtReminder'];
        $scanStartDate= $_POST['DpStart'];
        $scanEndDate= $_POST['DpEnd'];
        $Scan->UpdateScan($id, $scanName,$scanComment, $scanStatus,$scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate);
}



