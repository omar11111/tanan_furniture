<?php
include_once "connection.php";
include_once "operation.php";
class Product extends connection implements operation
{
    private $id;
    private $name_en;
    private $name_ar;
    private $price;
    private $photo;
    // private 
    private $subcat_id;

    //getters
    public function getId()
    {
       return $this->id;
    }
    public function getNameEn()
    {
       return $this->name_en;
    }
    public function getprice()
    {
       return $this->price;
    }
    public function getPhoto()
    {
       return $this->photo;
    }
    public function getNameAr()
    {
       return $this->name_ar;
    }
    public function getCategoryId()
    {
       return $this->category_id;
    }
    public function getSubCategoryId()
    {
       return $this->subcat_id;
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
    public function setNameAr($name_ar)
    {
        $this->name_ar = $name_ar;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }
    public function setSubCategoryId($subcat_id)
    {
        $this->subcat_id = $subcat_id;
    }
  

    public function selectAllData(){
        $query = "SELECT * FROM `products_details`";
        return $this->runDQL($query);
    }
    public function deleteData(){

    }
    public function updateData(){

    }
    public function insertData(){

    }


    public function selectPorductsSub()
    {
        $query = "SELECT * FROM `products_details` WHERE `products_details`.`subcat_id` = $this->subcat_id";
        return $this->runDQL($query);

    }

    public function getProById()
    {
       $query = "SELECT `products_details`.* FROM `products_details` WHERE `products_details`.`id` = $this->id ";
       return $this->runDQL($query);
    }

    public function getReviewsByProId()
    {
        $query = "SELECT `reviews`.* , `users`.`first_name` , `users`.`last_name`
        FROM `reviews`
        JOIN `users`
        ON `reviews`.`user_id` = `users`.`id`
        WHERE `reviews`.`product_id` = $this->id
        ";
        return $this->runDQL($query);
    }

    public function selectRelatedProducts()
    {
        $query = "SELECT * FROM `products_details` WHERE `products_details`.`subcat_id` = $this->subcat_id AND `products_details`.`id` <> $this->id LIMIT 4";
        return $this->runDQL($query);

    }

    public function getProductSpecs()
    {
        $query = "SELECT  `products_specs`.* , `specs`.`key_en` , `specs`.`key_ar`
        FROM `products_specs`
        JOIN `specs`
        ON `specs`.`id` = `products_specs`.`spec_id`
        WHERE  `products_specs`.`product_id` = $this->id";
        return $this->runDQL($query);
    }

}