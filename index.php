<?php 
session_start();
// Kết nối PDO
require_once "./commons/env.php";
require_once "./commons/function.php";
// Kết nối với model
require_once './models/Product.php';
require_once './models/categoryModel.php';

require_once './models/registerModels.php';
require_once './models/loginModel.php';
// Kết nối Controller
require_once './controllers/admin/ProductAdminController.php';
require_once './controllers/admin/categoryControllers.php';
require_once './controllers/admin/registerControllers.php';
require_once './controllers/admin/loginController.php';
$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
$productAdmin = new ProductAdminController();
$categoryAdmin = new categoryControllers();
$loginAdmin = new loginController();
$registerAdmin = new registerController();



// Lấy giá trị "id" từ đường dẫn url
$product_id = "";
if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
}

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
        $productAdmin->showList();
        break;
    case "product-create":
        $productAdmin->create();
        break;
    case "product-edit":
        $productAdmin->edit($product_id);
        break;
    // case "hide-product":
    //     $productAdmin->hide();
    //     break;
    // case "unhide-product":
    //     $productAdmin->unhide();
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

    // client
    case "client";
        include './views/client/dashboardClient.php';
        break;
    case "cart";
        include './views/client/cart.php';
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