<?php
class OrderControllers{
    public $orderModel;
    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }
    // Lấy danh sách của order
    public function listOrder()
    {
        $orders = $this->orderModel->allOrder();
        require_once './views/admin/Order/showOrder.php';
    }
    public function updateOrder()
    {
        $id =  $_GET['id'];
        $orderEdit = $this->orderModel->find($id);
        require_once './views/admin/Order/Order.php';
    }
    public function updateOrder_POST()
    {   
        
        // var_dump( $id =  $_POST['order_detail_id']);
        $id = $_GET['id'];
        $status = $_POST['status'];
        $this->orderModel->updateOrder($id,$status);
        // require_once './views/admin/Order/Order.php';
        header('location:?action=listOrders');
} 
    } 
    
?>