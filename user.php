<?php
include_once "connection.php";
include_once "operation.php";
class user extends connection implements operation {

    
    private $id;
    private $first_name;
    private $last_name;

    private $password;
    private $photo;
    private $email;

    private $phone;
    private $gender;
    private $code;
    private $status;

    private $created_at;
    private $updated_at;

    //getters
    public function getId()
    {
       return $this->id;
    }
    public function getFirstName()
    {
       return $this->first_name;
    }
    public function getLastName()
    {
       return $this->last_name;
    }

    public function getPhone()
    {
       return $this->phone;
    }
    public function getEmail()
    {
       return $this->email;
    }
    public function getPassword()
    {
       return $this->password;
    }

    public function getCode()
    {
       return $this->code;
    
    }
    public function getStatus()
    {
       return $this->status;
    }
    public function getPhoto()
    {
       return $this->photo;
    }
    public function getGender()
    {
       return $this->gender;
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
    public function setFirstName($fName)
    {
        $this->first_name = $fName;
    }
    public function setLastName($lName)
    {
        $this->last_name = $lName;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }public function setEmail($email)
    {
        $this->email = $email;
    }public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }
    public function setUpdatedAt($updatedAt)
    {

        $this->updated_at = $updatedAt;
    }

    public function insertData()
    {
        $query = "INSERT INTO `users` (`users`.`first_name`,`users`.`last_name`,`users`.`phone`,`users`.`email`,`users`.`gender`,
        `users`.`password`,`users`.`code`) VALUES ('$this->first_name','$this->last_name','$this->phone','$this->email',
        '$this->gender','$this->password','$this->code') ";
        // echo $query;
        return  $this->runDML($query);
        
    }

    public function selectAllData(){

    }
    public function deleteData(){

    }
    public function updateData(){
        
    }

    public function checkEmail()
    {
     $query="SELECT `users`.* FROM `users` WHERE  `users`.`email` =`$this->email`";
     return  $this->runDQL($query);

    }

    public function userLogin()
    {
      $query="SELECT `users`.* FROM `users` WHERE  `users`.`email` =`$this->email` &&`users`.`password`=`$this->password`";
      return  $this->runDQL($query);
    }

    // insertData
    // deleteData
    // updateData
    // SelectAllData

}