<?php 
class historicModel {
    public $conn;
    public function __construct()
    { 
        $this-> conn = connect_db();  
    }
    // Lấy thông tin chi tiết đơn hàng của người dùng theo user_id
    // public function getOrderHistory($user_id)
    // {
    //     $sql = "
    //         SELECT 
    //             orders.order_id, 
    //             orders.product_id, 
    //             orders.quantity, 
    //             orders.price,
    //             order_details.name, 
    //             order_details.email, 
    //             order_details.phone, 
    //             order_details.address, 
    //             order_details.note 
    //         FROM 
    //             orders 
    //         INNER JOIN 
    //             order_details 
    //         ON 
    //             orders.order_detail_id = order_details.order_detail_id
    //         WHERE 
    //             orders.user_id = '$user_id'
    //     ";
    //     $data = $this->conn->query($sql);
    //     return $data->fetchAll();
    // }
    public function getOrderHistoryByUserId($user_id) {
        $sql = "SELECT o.order_id, o.product_id, o.quantity, o.price, od.name, od.email, od.phone, od.address, od.note
                FROM orders o
                JOIN order_details od ON o.order_detail_id = od.order_detail_id
                WHERE o.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách đơn hàng
    }
    public function __destruct()
    {
        $this -> conn = null;
    }

}



?>