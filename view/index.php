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
                        <?php
                            // Getting the scans linked to the contact and user
                            $listScansUser = $ScanCtrl->getScansUser($user->getUserID());

                            if (array_filter($listScansUser) != []) {
                                // Looping through the results
                                foreach ($listScansUser as $scanUser) {
                                    ?>
                                        <div class="col-sm-12">
                                            <div class="scan">
                                                <div class="scan__inner">
                                                    <div class="scan__progress">
                                                        <!-- Drawing a process circle -->
                                                        <svg
                                                            class="scan__progress-ring"
                                                            height="200"
                                                            width="200"
                                                            >
                                                            <circle
                                                                id="<?php echo "scan" . $user->getUserId() . $scanUser->getScanID(); ?>"
                                                                class="scan__progress-circle"
                                                                stroke-width="10"
                                                                r="80"
                                                                cx="100"
                                                                cy="100"/>
                                                        </svg>

                                                        <script>
                                                            // Setting the progress
                                                            setProgressbarScan("<?php echo 'scan' . $user->getUserId() . $scanUser->getScanID(); ?>", <?php echo $ScanCtrl->getScanProgres($user->getUserID(), $scanUser->getScanID()); ?>);
                                                        </script>
                                                        
                                                        <div class="scan__prograss-container">
                                                            <label class="scan__progress-procent"><?php echo $ScanCtrl->getScanProgres($user->getUserID(), $scanUser->getScanID()); ?>&#37;</label>
                                                        </div>
                                                    </div>

                                                    <div class="scan__info">
                                                        <div class="scan-info-top">
                                                            <div class="scan-info__title">
                                                                <h3 class="scan--title"><?php echo $scanUser->getScanName(); ?></h3>
                                                            </div>
                                                            
                                                            <div class="scan-info__dates">
                                                                <label class="scan-info--dates"><?php echo $scanUser->getScanStartDate() . " - " . $scanUser->getScanEndDate(); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="scan-middle">
                                                            <p class="scan-info--text">
                                                                <?php echo $scanUser->getScanIntroductionText(); ?>
                                                            </p>
                                                        </div>

                                                        <div class="scan-bottom">
                                                            <a class="btn btn-status">continue scan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                // ending scan user foreach
                                }
                            } else {
                                ?>
                                    <span class="scan--feedback">There are no scan for you right now. </span>
                                <?php
                            }
                        ?>
                    </div>
                </section>
                    <?php

                    // Getting the deparments of the user
                    $listDepartments = $UserCtrl->getDepartmentsUser($user->getUserID(), 'Active');
                    
                    // Looping through the results
                    foreach ($listDepartments as $departmentUser) {

                        // Getting the scans for every department
                        $listScansDepartment = $ScanCtrl->getScansDepartment($departmentUser->getuserDepartmentID());

                        //var_dump($listScansDepartment);

                        // Only showing departments with active scans
                        if (array_filter($listScansDepartment) != []) {
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
                                                <div class="scan">
                                                    <div class="scan__inner">
                                                        <div class="scan__progress">
                                                            <!-- Drawing a process circle -->
                                                            <svg
                                                                class="scan__progress-ring"
                                                                height="200"
                                                                width="200"
                                                                >
                                                                <circle
                                                                    id="<?php echo "scan" . $departmentUser->getUserDepartmentName() . $scanDP->getScanID(); ?>"
                                                                    class="scan__progress-circle"
                                                                    stroke-width="10"
                                                                    r="80"
                                                                    cx="100"
                                                                    cy="100"/>
                                                            </svg>

                                                            <script>
                                                                // Setting the progress
                                                                setProgressbarScan("<?php echo 'scan' . $departmentUser->getUserDepartmentName() . $scanDP->getScanID(); ?>", <?php echo $ScanCtrl->getScanProgres($user->getUserID(), $scanDP->getScanID()); ?>);
                                                            </script>
                                                            
                                                            <div class="scan__prograss-container">
                                                                <label class="scan__progress-procent"><?php echo $ScanCtrl->getScanProgres($user->getUserID(), $scanDP->getScanID()); ?>&#37;</label>
                                                            </div>
                                                        </div>

                                                        <div class="scan__info">
                                                            <div class="scan-info-top">
                                                                <div class="scan-info__title">
                                                                    <h3 class="scan--title"><?php echo $scanDP->getScanName(); ?></h3>
                                                                </div>
                                                                
                                                                <div class="scan-info__dates">
                                                                    <label class="scan-info--dates"><?php echo $scanDP->getScanStartDate() . " - " . $scanDP->getScanEndDate(); ?></label>
                                                                </div>
                                                            </div>

                                                            <div class="scan-middle">
                                                                <p class="scan-info--text">
                                                                    <?php echo $scanDP->getScanIntroductionText(); ?>
                                                                </p>
                                                            </div>

                                                            <div class="scan-bottom">
                                                                <a class="btn btn-status">continue scan</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
