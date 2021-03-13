<?php
include_once "connection.php";
include_once "operation.php";

class Order extends connection implements operation
{
    private $id;
   
    public function getID()
    {
       return $this->id;
    }
    public function setID($id)
    {
        $this->id = $id;
    }
  

    public function selectAllData(){}
    public function deleteData(){}
    public function updateData(){}
    public function insertData(){}
 
 

}
?>