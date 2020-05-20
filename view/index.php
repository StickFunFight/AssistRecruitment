<?php 
    // Starting the session
    $_SESSION['user'] = 568;
    //session_start();

    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Including controller
    require '../functions/controller/UserController.php';
    require '../functions/controller/ScanController.php';
    // Including entity classes
    require '../functions/models/entContact.php';
    require '../functions/models/entScan.php';

    // Including the head and menu
    require 'menu.php';

    // Creating connections with the classes
    $UserCtrl = new UserController();
    $ScanCtrl = new ScanController();

    // Getting the user and the details of that user
    $userID = null;

    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
    } else {
        // Sending user to login page
        echo '<script> location.replace("loginScreen"); </script>;';
    }

    // Getting the user info
    $detailsUser = $UserCtrl->getDetailsUser($userID);

    // Looping through the results
    foreach ($detailsUser as $user) {
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <link rel="stylesheet" href="../assests/styling/customer.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Overview Scans<h1>
                    </div>
                </div>

                <section class="dashboard__department">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="dashboard--subtitle">Scans for you</h2>
                        </div>
                    </div>
                    <?php
                        // Getting the scans linked to the contact and user
                        $listScansUser = $ScanCtrl->getScansUser($user->getUserID());

                        // Looping through the results
                        foreach ($listScansUser as $scanUser) {
                            ?>

                            <?php
                        // ending scan user foreach
                        }
                    ?>
                </section>
                    <?php

                    // Getting the deparments of the user
                    $listDepartments = $UserCtrl->getDepartmentsUser($user->getUserID(), 'Active');
                    
                    // Looping through the results
                    foreach ($listDepartments as $departmentUser) {

                        // Getting the scans for every department
                        $listScansDepartment = $ScanCtrl->getScansDepartment($user->getuserDepartmentID());

                        if (!empty($listScansDepartment)) {
                        ?>
                            <section class="dashboard__department">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 class="dashboard--subtitle"><?php echo $departmentUser->getUserDepartmentName(); ?></h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                        // Looping through the departmentscans
                                        foreach ($listScansDepartment as $scanDP) {
                                        ?>
                                            <div class="col-sm-12">
                                                
                                            </div>
                                        <?php
                                        // ending department scan foreach
                                        }
                                    ?>
                                </div>
                            </section>
                        <?php
                        }
                    // ending department user foreach
                    }
                ?>
            </div>
        </div> 
    </body>
</html>
<?php
    // Ending foreach loop
    }
?>
