<?php
class checkoutModel{
    public $conn;
    public function __construct()
    { 
        $this-> conn = connect_db();  
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

    public function __destruct()
    {
        $this -> conn = null;
    }
}
?>