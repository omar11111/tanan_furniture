<?php
include_once "connection.php";
include_once "operation.php";
class Address extends connection implements operation
{
    private $id;
    private $street;
    private $floor;

    private $flat;
    private $type;
    private $notes;

    private $lat;
    private $logitude;
    private $building;

    private $region_id;
    private $user_id;
    private $created_at;
    private $updated_at;

    //getters
    public function getId()
    {
       return $this->id;
    }
    public function getStreet()
    {
       return $this->street;
    }
    public function geFloor()
    {
       return $this->floor;
    }

    public function getFlat()
    {
       return $this->flat;
    }
    public function getType()
    {
       return $this->type;
    }
    public function getNotes()
    {
       return $this->notes;
    }

    public function getLat()
    {
       return $this->lat;
    
    }
    public function getLogitude()
    {
       return $this->logitude;
    }
    public function getBuilding()
    {
       return $this->building;
    }
    public function getRegionId()
    {
       return $this->region_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getCreateAt()
    {
       return $this->created_at;
    }
    public function getUpdatedAt()
    {
       return $this->updated_at;
    }


    // setters 
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setStreet($street)
    {
        $this->street = $street;
    }
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    public function setFlat($flat)
    {
        $this->flat = $flat;
    }public function setType($type)
    {
        $this->type = $type;
    }
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }
    public function setLogitude($logitude)
    {
        $this->logitude = $logitude;
    }
    public function setBuilding($building)
    {
        $this->building = $building;
    }

    public function setRegionId($region_id)
    {
        $this->region_id = $region_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }
    public function setUpdatedAt($updatedAt)
    {

        $this->updated_at = $updatedAt;
    }

    public function selectAllData(){
        $query = " SELECT `addresses`.* FROM `addresses` WHERE `addresses`.`user_id` = $this->id ";
       
        return $this->runDQL($query);
    }
    public function deleteData(){
        $query = "DELETE FROM `addresses` WHERE `addresses`.`id` = $this->id";
        return $this->runDML($query);
    }
    public function updateData(){
        $query = "UPDATE `addresses` SET `addresses`.`street` = '$this->street' , `addresses`.`building` = $this->building , `addresses`.`floor` = $this->floor,
        `addresses`.`flat` = $this->flat , `addresses`.`type` = '$this->type' , `addresses`.`notes` = '$this->notes' , `addresses`.`region_id` = $this->region_id
        WHERE `addresses`.`id` = $this->id
        ";
        // echo $query;
        return $this->runDML($query);
    }
    public function insertData(){
        $query = "INSERT INTO `addresses` (`addresses`.`street`,`addresses`.`building`,`addresses`.`floor`,`addresses`.`flat`,
        `addresses`.`type`,`addresses`.`notes`,`addresses`.`region_id` , `addresses`.`user_id` ) VALUES ('$this->street',
        $this->building,$this->floor,$this->flat,'$this->type','$this->notes',$this->region_id,$this->user_id) ";
        // echo $query;
        return $this->runDML($query);
    }



}