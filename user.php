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
    $query=" INSERT INTO
     `users`( `users`.`first_name`, `users`.`last_name`, `users`.`email`,
              `users`.`phone`, `users`.`password`,   `users`.`gender`,  `users`.`code`)
     VALUES ('$this->first_name','$this->last_name','$this->email',
            '$this->phone','$this->password','$this->gender','$this->code')";

     echo $query;
     
     return  $this->runDML($query);
     
 }

    public function selectAllData(){

    }
    public function deleteData(){

    }
    public function updateData(){
        $query = "UPDATE `users` SET `users`.`first_name` = '$this->first_name' , `users`.`last_name` = '$this->last_name' 
        , `users`.`phone` = $this->phone, `users`.`gender` = '$this->gender'";
        if($this->photo){
            $query .= ", `users`.`photo` = '$this->photo' ";
        }
        $query .= "WHERE `users`.`id` = $this->id ";
        // echo $query;
        return $this->runDML($query);
    }

    public function checkEmail()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' ";
        // echo $query;die;
        return $this->runDQL($query);
    }

    public function setUserActive()
    {
        $query = "UPDATE `users` SET `users`.`status` = $this->status WHERE `users`.`id` = $this->id";
        // echo $query;die;
        return $this->runDML($query);
    }

    public function userLogin()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password' ";
        return $this->runDQL($query);
    }

    public function updateCode()
    {
        $query = "UPDATE `users` SET `users`.`code` = $this->code WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);    
    }
    public function updatePassword()
    {
        $query = "UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`email` = '$this->email' ";
        $this->runDML($query);
        $query1 = "SELECT `users`.* FROM `users` WHERE `users`.`email`= '$this->email' ";
        return $this->runDQL($query1); 
    }

    public function changePassword()
    {
        $query = "UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`id` = $this->id";
        return $this->runDML($query);
    }

    public function changeEmail()
    {
        $query = "UPDATE `users` SET `users`.`email` = '$this->email', `users`.`status` = $this->status ,
        `users`.`code` = $this->code  WHERE `users`.`id` = $this->id  ";
        // echo $query;die;
        return $this->runDML($query);
    }
    // insertData
    // deleteData
    // updateData
    // SelectAllData

}