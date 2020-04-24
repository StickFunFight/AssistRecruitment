<?php
include '../functions/datalayer/customerDatabase.php';

class customerAdd {
    private $custAdd;

    public function __construct() {
        $this->custAdd = new customerDatabase();
    }

    //This function creates a new customer using the values obtained from the customerDatabase (createCustomer) function.
    //Also gives an echo as feedback to assure the user that the statement has succesfully been executed or not.
    public function createCustomer($customerName, $customerComment, $customerReference) {
        if($this->custAdd->createCustomer($customerName, $customerComment, $customerReference)){
            echo "Customer succesfully added!";
        } else {
            echo "An error occured in the createCustomer function within the customerAdd class.";
        }
    }
}
?>