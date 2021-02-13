<?php
include_once "connection.php";
include_once "operation.php";
class City extends connection implements operation
{
    private $id;
    private $name;
   

    //gett
   
    public function getId()
    {
       return $this->id;
    }
    public function getName()
    {
       return $this->name;
    }
   


    // setters 
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
  

    public function selectAllData(){
        $query = "SELECT `cities`.* FROM `cities`";
        return $this->runDQL($query);
    }
    public function deleteData(){

    }
    public function updateData(){

    }
    public function insertData(){

    }



}