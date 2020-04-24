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
            $query = "SELECT c.contactID, c.contactName, c.contactPhoneNumber, c.contactEmail, c.contactStatus, cust.customerName
                        FROM contact c
                        INNER JOIN customer cust 
                        ON c.customerID = cust.customerID
                        UNION ALL
                        SELECT c.contactID, c.contactName, c.contactPhoneNumber, c.contactEmail, c.contactStatus, dp.departmentName
                        FROM contact c
                        INNER JOIN department_contact dc
                        ON dc.contactID = c.contactID
                        INNER JOIN department dp 
                        ON dc.departmentID = dp.contactID";
                        
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                $result= $stm->fetchAll(PDO::FETCH_OBJ);

                foreach ($result as $item){
                    $entContact = new entContact($item->contactID, $item->contactName, $item->contactPhoneNumber, $item->contactEmail, $item->contactComment, $item->contactStatus, $item->customerName, $item->departmentName);
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