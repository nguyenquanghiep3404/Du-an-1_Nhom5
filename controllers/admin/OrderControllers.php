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
        // Tham chiếu giá trị status
        $statusShow = [
            0 => 'Chờ xác nhận',
            1 => 'Đã xác nhận',
            2 => 'Đang vận chuyển',
            3 => 'Hoàn thành',
         ];
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $updated_at = date('Y-m-d H:i:s');
        $this->orderModel->updateOrder($id,$status,$updated_at);
        // require_once './views/admin/Order/Order.php';
        header('location:?action=listOrders');
    }    
    
    
    } 
    
?>