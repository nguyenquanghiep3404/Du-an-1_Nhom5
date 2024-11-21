<?php 
session_start();
// Kết nối PDO
require_once "./commons/env.php";
require_once "./commons/function.php";
// Kết nối với model
require_once './models/Product.php';
require_once './models/categoryModel.php';
require_once './models/loginModel.php';
require_once './models/registerModels.php';
// Kết nối Controller
require_once './controllers/admin/ProductAdminController.php';
require_once './controllers/admin/categoryControllers.php   ';
require_once './controllers/admin/loginController.php';
require_once './controllers/admin/registerControllers.php';
$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
$productAdmin = new ProductAdminController();
$categoryAdmin = new categoryControllers();
$loginAdmin = new loginController();
$registerAdmin = new registerController();
switch ($action) {
    case "admin":
        include './views/admin/dashboard.php';
        break;
    case "product":
        $productAdmin->index();
        break;
    case "product-create":
        $productAdmin->create();
        break;
    case "product-edit":
        $productAdmin->edit();
        break;
    case "hide-product":
        $productAdmin->hide();
        break;
    case "unhide-product":
        $productAdmin->unhide();
        break;
    // Danh muc
    case "home-dm";
        $categoryAdmin->all_dm();
        break;
    case "hide-dm";
        $categoryAdmin->hide_dm();
        break;
    case "show-dm";
        $categoryAdmin->show_dm();
        break;
    case "create-dm";
        $categoryAdmin->create_dm();
        break;
    case "createPost-dm";
        $categoryAdmin->createPost_dm();
        break;
    case "update-dm";
        $categoryAdmin->update_dm();
        break;
    case "updatePost-dm";
        $categoryAdmin->updatePost_dm();
        break;
    // Login
    case "home";
        $loginAdmin->home();
        break;
    case "login";
        $loginAdmin->login();
        break;
    case "loginPost";
        $loginAdmin->loginPost();
        break;
    case "logout";
        $loginAdmin->logout();
        break;
    // Register
    case "register";
        $registerAdmin->createRegister();
        break;
    case "registerPost";
        $registerAdmin->createRegisterPost();
        break;
    case "all_register";
        $registerAdmin->all_register();
        break;
    case "delete";
        $registerAdmin->delete();
        break;
}
?>
<?php
// // Kết nối với cơ sơ dự liệu PDO
// require_once "./commons/env.php";
// require_once "./commons/function.php";
// // Kết nối với các file Model
// require_once "./models/categoryModel.php";
// // Kết nối với các file Controller
// require_once "./controllers/admin/categoryControllers.php";
// $act = $_GET['act'] ?? '/';
// match($act){
//     // Quản lý danh mục
//     'home-dm'=>(new categoryControllers)->all_dm(),
//     // 'delete-dm'=>(new categoryControllers)->delete_dm(),
//     'hide-dm' => (new categoryControllers)->hide_dm(), 
//     'show-dm' => (new categoryControllers)->show_dm(),
//     'create-dm'=>(new categoryControllers)->create_dm(),
//     'createPost-dm'=>(new categoryControllers)->createPost_dm(),
//     'update-dm'=>(new categoryControllers)->update_dm(),
//     'updatePost-dm'=>(new categoryControllers)->updatePost_dm(),

// }
?>