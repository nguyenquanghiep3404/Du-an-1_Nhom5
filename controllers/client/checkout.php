<?php
class checkoutController{
    public $checkModel;
    public function __construct()
    {
        $this->checkModel = new checkoutModel();
    }
    
    // public function checkout(){
    //     require_once './views/client/checkout.php';
        
    // }
    

    public function showOrderDetails()
    {   
        if(isset($_SESSION['name'])){
        $showCheckout = $this->checkModel->getUserName($_SESSION['name']['name']);
        
    }else{
        $showCheckout['name'] = '';
        $showCheckout['email'] = '';
        $showCheckout['phone'] = '';
        $showCheckout['address'] = '';
    }
        // var_dump($_SESSION['name']['name']);
        require_once './views/client/checkout.php';
    }
    
    
    public function CreateOrderDetails()
    {   
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $id = $_SESSION['name']['user_id'];
        $this->checkModel->insetOrderDetails($name,$email,$phone,$address,$note,$id);
        $order_details_id = $this->checkModel->getOrder_details_user_id($id)['order_detail_id'];
        if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
            foreach ($_SESSION['myCart'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        // var_dump($_SESSION['myCart']);
        $this->checkModel->insetOrder($id, $product_id,$order_details_id,$quantity,$price);
    }
}else{
    echo "Giỏ hàng rỗng hoặc dữ liệu không đúng!";
}
        // var_dump($order_details_id);
        // var_dump($_SESSION);
    }
}
?>