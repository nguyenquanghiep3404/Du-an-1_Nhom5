<?php
class registerController{
    public $registerModel;
    public function __construct()
    { 
         $this->registerModel = new registerModel();  
    }
    public function all_register()
    {
        $register = $this->registerModel->all_register();
        require_once './views/admin/login/show-acc.php';
    }
    public function delete()
    {
        $id = $_GET['id'];
        $this->registerModel->delete($id);
        header('location:?action=all_register');
    }

    public function createRegister()
    {
        require_once './views/admin/login/register.php';
    }
    public function createRegisterPost()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $this->registerModel->inset($name,$email,$password,$phone,$address);
        header('location:?action=login');
    }
    
} 
 ?>