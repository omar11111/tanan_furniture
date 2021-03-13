<?php
include_once "connection.php";
include_once "operation.php";
class Subcat extends connection implements operation
{
    private $id;
    private $name_en;
   private $category_id;

    //getters
    public function getId()
    {
       return $this->id;
    }
    public function getNameEn()
    {
       return $this->name_en;
    }
    public function getCategoryId()
    {
       return $this->category_id;
    }
   


    // setters 
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNameEn($name_en)
    {
        $this->name_en = $name_en;
    }
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }
  

    public function selectAllData(){
      $query = "SELECT `subcats`.* FROM `subcats` WHERE `subcats`.`category_id` = $this->category_id";
      return $this->runDQL($query);
    }
    public function deleteData(){

    }
    public function updateData(){

    }
    public function insertData(){

    }



}