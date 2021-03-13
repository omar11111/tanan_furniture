<?php
include_once "connection.php";
include_once "operation.php";
include_once "product.php";
include_once "order.php";

class Product_Order extends connection implements operation
{
    private $order_id;
    private $product_id;
    public function getOID()
    {
       return $this->order_id;
    }
    public function getPID()
    {
       return $this->product_id;
    }
    public function setOID($order_id)
    {
        $this->order_id = $order_id;
    }
    public function setPID($product_id)
    {
        $this->product_id =$product_id;
    }

    public function selectAllData(){}
    public function deleteData(){}
    public function updateData(){}
    public function insertData(){}
    public function getProductOrder(){
        $query="SELECT *, COUNT(`orders`.`id`) AS counter FROM `products`
        JOIN `order_product`
        ON `products`.`id` = `order_product`.`product_id`
        JOIN `orders` 
        on `orders`.`id` = `order_product`.`order_id`
        GROUP BY `products`.`name_ar`
        ORDER BY counter  DESC  LIMIT 4";
         return $this->runDQL($query);
     
     }
     public function getProductReview(){
         $query ="SELECT `products`.*, MAX(`reviews`.`value`) AS maxR FROM `reviews`
         JOIN `products`
         ON `reviews`.`product_id` = `products`.`id`
         JOIN `users` 
         on `reviews`.`user_id` = `users`.`id`
         GROUP BY `products`.`name_ar`
         ORDER BY maxR  DESC  LIMIT 4";
         
         return $this->runDQL($query);
     }
     public function getProductNew(){

     $query="SELECT * FROM `products`
     ORDER BY `products`.`created_at` DESC
     LIMIT 4";
     return $this->runDQL($query);
     }
     public function getProductView(){

        $query="SELECT * FROM `products`
        ORDER BY `products`.`viewer` DESC
        LIMIT 4";
        return $this->runDQL($query);
        }
}
?>