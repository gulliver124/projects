<?php
    class Errand{
        public $senderId;
        public $item;
        public $destination;
        public $receiverName;
        public $receiverPhone;
        public $errandDate;
        public $status;
    

        public function __construct($senderId,$item,$destination,$receiverName,$receiverPhone){
            $this->senderId = $senderId;
            $this->item= $item;
            $this->destination = $destination;
            $this->receiverName = $receiverName;
            $this->receiverPhone = $receiverPhone;
            $this->errandDate = date('d-m-Y h:i:s');
            $this->status = "In Transit";

        }


    }

    
    
?>