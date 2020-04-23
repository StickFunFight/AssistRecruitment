<?php
    include "../functions/models/entContact.php";

    class contactController
    {
        private $db;

        public function __construct()
        {
            include "../functions/datalayer/database.class.php";
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getContacts()
        {
            $lijst = array();
            $query = "SELECT * FROM contact WHERE contactStatus = 'active'";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                $result= $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $item){
                    $entContact = new entContact($item->contactID, $item->contactName, $item->contactEmail, $item->contactPhonenumber, $item->contactCustomer, $item->contactCustomerID, $item->contactUserID, $item->contactStatus);
                    array_push($lijst, $entContact);

                }
                return $lijst;
            }
            else{
                ECHO "Kapoet";
            }
        }
    }
?>