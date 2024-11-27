<?php

class loginController{
    public $loginModel;
    public function __construct()
    {
        $this->loginModel = new loginModel();
    }
    public function home()
    {
        require_once './views/client/dashboardClient.php';
    }
    public function login()
    {
        require_once './views/admin/login/login.php';
    }
    public function loginPost()
    {
        if(isset($_POST['btn-login'])){
            $username = $_POST['name'];
            $password = $_POST['password'];
            $user = $this->loginModel->check($username,$password);

            if($user){
               $_SESSION['name'] = $user;
               $_SESSION['user_id'] = $user;
               $_SESSION['role_id'] = $this->loginModel->Role($username)['role_id'];
            //    var_dump($_SESSION['id_role']);
               header('location:?action=client');
            }else{
               echo "Sai tên đăng nhập hoặc mất khẩu";
            }

        }
    }

    public function logout()
    {
        unset($_SESSION['name']);
        header('location:?action=client');
    } 
}

?>