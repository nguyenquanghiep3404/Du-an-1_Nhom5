<?php
class checkoutModel{
    public $conn;
    public function __construct()
    { 
        $this-> conn = connect_db();  
    }
    
    public function getOrder_details_user_id($user_id)
    {
        $sql = "SELECT * FROM `order_details` WHERE `order_details` . `user_id` = '$user_id'";
        $data = $this->conn->query($sql);
        return $data->fetch();
    }

    public function getUserName($name)
    {
        $sql = "SELECT * FROM `users` WHERE `users`.`name` = '$name' ";
        $data = $this->conn->query($sql);
        return $data->fetch();
    }

    public function insetOrderDetails($name,$email,$phone,$address,$note,$id)
    {
        $sql = "INSERT INTO `order_details` (`name`, `email`, `phone`, `address`, `note`, `user_id`) VALUE ('$name', '$email', '$phone', '$address', '$note', '$id')";
        $this->conn->exec($sql);
    }
    
    public function insetOrder($id, $product_id,$order_details_id,$quantity,$price)
    {
        $sql = "INSERT INTO `orders` (`user_id`, `product_id`, `order_detail_id`, `quantity`, `price`) VALUE ('$id', '$product_id', '$order_details_id', '$quantity', '$price') ";
        $this->conn->exec($sql);
    }

    public function __destruct()
    {
        $this -> conn = null;
    }
}
?>