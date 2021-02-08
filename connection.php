<?php 

class connection {
    public $localhost = 'localhost';
    public $dbname = 'nti_ecommerce';
    public $user = 'root';
    public $password = '';
    public $con;

    public function __construct()
    {
        //
        $this->con = new mysqli($this->localhost,$this->user,$this->password,$this->dbname);
        
        if ($this->con->connect_error) {
           die('connection failed'.$this->con->connect_error);
        }else{}
    }

    public function runDML($query)
    {
        // insert / update / delete
        $result = $this ->con->query($query);
        if ($result === true) {
            return true;
        }else{
            return false;
        }



    }

    public function runDQL($query)
    {
       // select

       $result = $this->con->query($query);
       if ($result->num_rows > 0)
       {
           return $result;
       }else
       {
          return [];
       }

    }
}