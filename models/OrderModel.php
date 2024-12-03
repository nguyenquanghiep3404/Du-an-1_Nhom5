<?php
class OrderModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connect_db();
    }
    
    public function allOrder()
    {   
        $sql = "SELECT * FROM `order_details`";
        $data = $this->conn->query($sql);
        return $data->fetchAll();
    }
    
    public function updateOrder($id,$status,$updated_at)
    {
        $sql = "UPDATE `order_details` SET `status` = '$status' , `updated_at` = '$updated_at' WHERE `order_detail_id` = '$id' ";
        $this->conn->exec($sql);
    }
    public function find($id)
    {
        $sql = "SELECT * FROM `order_details` WHERE `order_details` . `order_detail_id` = '$id'";
        $stml = $this->conn->query($sql);
        $data = $stml->fetch();
        return $data;
    }
    public function __destruct()
    {
        $this->conn = null;
    }
}
?>