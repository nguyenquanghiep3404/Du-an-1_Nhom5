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
        $showCheckout = $this->checkModel->getUserName($_SESSION['name']['name']);
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
    }
}
?>