<?php
class loginController{
    public $loginModel;
    public function __construct()
    {
        $this->loginModel = new loginModel();
    }
    public function login()
    {
        require_once './views/admin/login/login.php';
    }
    public function loginPost()
    {
        if(isset($_POST['btn-login'])){
            if($this->loginModel->check($_POST['name'],$_POST['password'] > 0)){
                 header('location:?action=admin');
                 $_SESSION['name'] = $_POST['name'];
            }else{
                echo '<label for="">Sai Tài khoản hoặc mk</label>';
            }
        }
    }
    
}
?>