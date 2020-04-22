<?php

    class EntCustomer {
        private $show_customerID;
        private $show_customerNaam;
        private $show_customerComment;
        private $show_customerRefrence;
        

        public function __construct(string $show_customerID, string $show_customerNaam, string $show_customerComment, string $show_customerRefrence) {
            $this->show_customerID = $show_customerID;
            $this->show_customerNaam = $show_customerNaam;
            $this->show_customerComment = $show_customerComment;
            $this->show_customerRefrence = $show_customerRefrence;
            
        }

        public function getCustomerID() : string
        {
            return $this->show_customerID;
        }

        public function getCustomerNaam() : string
        {
            return $this->show_customerNaam;
        }

        public function getCustomerComment() : string
        {
            return $this->show_customerComment;
        }

        public function getCustomerRefrence() : string
        {
            return $this->show_customerRefrence;
        }

    } 
?>