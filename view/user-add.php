<?php 
    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Including controller
    require '../functions/controller/contactController.php';
    require '../functions/controller/CustomerController.php';
    require '../functions/controller/userController.php';
    // Including entity classes
    require '../functions/models/entUser.php';

    // Including the head and menu
    require 'menu.php';

    // Creating connections with the classes
    $UserCtrl = new UserController();
    $ContactCtrl = new ContactController();

    // Creating a customer id to fil it later
    $customerID;

    // If there is a customer id, it will be of the customer, else it will be 0
    // This is to later check wich functions shouldn't be activeted
    if(isset($_POST['submitCreateUser'])){
        $UserName = $_POST['userName'];
        $UserEmail = $_POST['userEmail'];
        $UserType = $_POST['userType'];
        $userPassword = $_POST['']

        $UserCtrl->createUser($UserName, $UserEmail, $UserType, $userPassword);
    }

    // Creating the list for the customer details
    $customerDetails;

    // getting the customer details
    // Looping through the results at the end of the file
    if ($customerID != 0) {
        // Filling the list
        $customerDetails = $CustomerCtrl->getCustomerDetails($customerID); 
    }  
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <link rel="stylesheet" href="../assests/styling/customer.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Overview Users<h1>
                    </div>
                </div>

                <!-- <form method="POST" autocomplete="off" action="?customer=<?php echo $customerID; ?>"> -->
                    <!-- Customer ID for refrence -->
                    <!-- <input type="hidden" name="txtCustomerID" value="">

                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <label for="existingUsers" class="au__label">Choose an existing user</label>
                            <input type="text" class="form-control au--input" name="txtSearchUser" id="searchUser" placeholder="type a name">
                        </div>
                    </div>
                </from> -->
                <form method="post" class="user-form">
                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">E-mail:</label>
                            <input name="userEmail" class="form-control user-add__input" type="text" value="<?php echo $UserEmail; ?>">
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Username:</label>
                            <input name="userName" class="form-control user-add__input" type="text" value="<?php echo $UserName; ?>">
                        </div>
                    </div>
                
                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Type:</label>
                            <input name="userType" class="form-control user-add__input" type="text" value="<?php echo $UserType; ?>">
                        </div>
                    </div>

                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Phone number:</label>
                            <input name="userPhonenumber" class="form-control user-add__input" type="text" required>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Date of birth:</label>
                            <input name="userBirthdate" class="form-control user-add__input" type="date" required>
                        </div>
                    </div>

                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Comment:</label>
                            <textarea name="userComment" class="form-control user-add__input" rows="5"></textarea>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Customer:</label>
                            <select class="form-control" name="cbxCustomer" id="customerSelect" onchange="changeSelectCustomer()">
                                <?php 
                                    // Checking for customer. If there is, lock it in that customer
                                    // Creating an variable to fill it later
                                    $listCustomers;

                                    if (!empty($user->getUserCustomerID())) {
                                        // Filling the list
                                        $listCustomers =  $CustomerCtrl->getCustomerDetails($user->getUserCustomerID()); 
                                        //Showing a select where you can't pick a customer
                                        echo "<script> setCustomerSelectDisabeld(); </script>";
                                    }  else {
                                        $listCustomers = $CustomerCtrl->getCustomers('Active');
                                    }
                                    
                                    foreach($listCustomers as $customer){
                                        if($customer->getCustomerID() == $user->getUserCustomerID()) {
                                            ?>
                                                <option selected="selected" value="<?php echo $customer->getCustomerID(); ?>"><?php echo $customer->getCustomerName(); ?></option>
                                            <?php
                                        } else {
                                            ?>
                                                <option value="<?php echo $customer->getCustomerID(); ?>"><?php echo $customer->getCustomerName(); ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <input name="submitCreateUser" class="btn btn-add" type="submit" id="createUserButton" value="Add user">
                        </div>
                    </div>
            </div>
        </div> 
    </body>

    <?php
        // Creating the list for the excisting user
        $listExcistingUsers;

        // getting the excisting user minus the one already connected to the user
        if ($customerID != 0) {
            // Filling the list
            $listExcistingUsers = $CustomerCtrl->getCustomerDetails($customerID); 
        } else {
            // Filling the list with user linked to a customer
        }
    ?>

    <script>      
        /*An array containing all the country names in the world:*/
        var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("searchUser"), countries);
    </script>
</html>
