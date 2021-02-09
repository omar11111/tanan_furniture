<?php

class connection {
    public $DBserverName = 'localhost';
    public $DBusername = 'root';
    public $DBpassword = '';
    public $DBname = 'nti_ecommerce_last';
    public $con;

    public function __construct()
    {
       $this->con =  new mysqli($this->DBserverName,$this->DBusername,$this->DBpassword,$this->DBname);
       if($this->con->connect_error){
           die("connection failed". $this->con->connect_error);
       }else{
          // echo "DB is connected";
       }
    }

    public function runDML($query)
    {
        # code... inseret / update / delete
        # $con 
        #  "DELETE FROM users"
        $result = $this->con->query($query);
        if($result === TRUE){
            return 1;
        }else{
            return 0;
        }
    }

    public function runDQL($query)
    {
        # code...  / selects
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            return $result;
        }else{
            return [];
        }
    }
    
}