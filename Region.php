<?php
include_once "connection.php";
include_once "operation.php";
class Region extends connection implements operation
{
    private $id;
    private $name;
    private $city_id;

    //getters
    public function getId()
    {
       return $this->id;
    }
    public function getName()
    {
       return $this->name;
    }
    public function getCityId()
    {
       return $this->city_id;
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
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }
  

    public function selectAllData(){
        $query = "SELECT `regions`.* FROM `regions` WHERE `regions`.`city_id` = $this->city_id " ;
        return $this->runDQL($query);
    }
    public function deleteData(){

    }
    public function updateData(){

    }
    public function insertData(){

    }



}