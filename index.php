<?php 
// Kết nối PDO
require_once "./commons/env.php";
require_once "./commons/function.php";
// Kết nối với model
require_once './models/categoryModel.php';
// Kết nối Controller
require_once './controllers/admin/ProductAdminController.php';

require_once './controllers/admin/categoryControllers.php   ';

require_once './models/ProductQuery.php';
require_once './models/Product.php';

// Lấy giá trị "id" từ đường dẫn url
$product_id = "";
if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
}

$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
$productAdmin = new ProductAdminController();
$categoryAdmin = new categoryControllers();
$loginAdmin = new loginController();
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
        
    case "category":
        include './views/admin/category/show-dm.php';
        break;
    case "client":
        include './views/client/dashboardClient.php';
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
    case "login";
        $loginAdmin->login();
        break;
    case "loginPost";
        $loginAdmin->loginPost();
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