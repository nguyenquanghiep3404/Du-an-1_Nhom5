<?php 
session_start();
ob_start();

// Kết nối PDO
require_once "./commons/env.php";
require_once "./commons/function.php";
// Kết nối với model
require_once './models/Product.php';
require_once './models/categoryModel.php';
require_once './models/registerModels.php';
require_once './models/loginModel.php';
require_once './models/historicModel.php';
require_once './models/ProductQuery.php';
require_once './models/checkoutModel.php';
require_once './models/profileModel.php';
require_once './models/OrderModel.php';
// require_once './models/cartsModels.php';

// Kết nối Controller
// Controller bên admin
require_once './controllers/admin/ProductAdminController.php';
require_once './controllers/admin/categoryControllers.php';
require_once './controllers/admin/registerControllers.php';
require_once './controllers/admin/loginController.php';
require_once './controllers/admin/OrderControllers.php';

// Controller bên client
require_once './controllers/client/checkout.php';
require_once './controllers/client/profileController.php';
require_once './controllers/client/ProductClientControllers.php';
// require_once './controllers/client/historic.php';

// require_once './controllers/client/CartsControllers.php';
// Lấy giá trị "id" từ đường dẫn url
$product_id = "";
if (isset($_GET["id"])) {

    $product_id = $_GET["id"];}

    $product_id = $_GET["id"];
}    


require_once './controllers/client/historic.php';


if (!isset($_SESSION['myCart']) || !is_array($_SESSION['myCart'])) {
    $_SESSION['myCart'] = []; // Khởi tạo giỏ hàng nếu chưa tồn tại

}


$action = isset($_GET["action"]) ? $_GET["action"] :'client';
$productAdmin = new ProductAdminController();
$categoryAdmin = new categoryControllers();
$loginAdmin = new loginController();
$registerAdmin = new registerController();
$checkoutAdmin = new checkoutController();
$HomeClient = new HomeClientControllers();
$historicClient = new historicController();
$profileAdmin = new profileController();
$orderAdmin = new OrderControllers();
switch ($action) {
    case "admin":
        if (!isset($_SESSION['name'])) {
            header('location:?action=login'); // Chuyển hướng đến trang đăng nhập
            exit();
        }
        // Kiểm tra quyền của người dùng phải có role =1 thì mới được vào admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            header('location:?action=403'); // Chuyển hướng đến trang lỗi không đủ quyền
            exit();
        }
        include './views/admin/dashboard.php';
        break;
    case "product":
        $productAdmin->showList();
        break;
    case "product-create":
        $productAdmin->create();
        break;
    case "product-form-edit":
        $productAdmin->Edit();
        break;
    // case "delete-product":
    //     $productAdmin->deleteProduct();
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
    case "all_register":
        $registerAdmin->all_register();
        break;
    case "delete":
        $registerAdmin->delete();
        break;


    // client
    case "client":
        $HomeClient->home();
        break;
    case "addToCart":
        $HomeClient->addToCart();
        // $HomeClient->addCart();
        break;
    // case "addCartDetail":
    //     $HomeClient->AddCartDetail();
    //     break;
    case "update_cart_quantity":
            $HomeClient->updateCartQuantity();
            break;
    
    // Xóa sản phẩm khỏi giỏ hàng
    case "remove_cart_item":
            $HomeClient->removeCartItem();
            break;
    // case "cart";
    //     $HomeClient->cart();
    //     break;
    // case "update-cart";
    //     $HomeClient->cart();
    //     break;
    case "product-details":
        $HomeClient->productDetails();
        break;
    case "miniProduct":
        $HomeClient->productDetails();
        break;
    case "CategoryProductClient":
        $HomeClient->categoryProductClient();
        break;
    // Checkout
    // case 'checkout';
    //     $checkoutAdmin->checkout();
    //     break;
    case 'show_checkout';
        $checkoutAdmin->showOrderDetails();
        break;
    case 'createOrederDetails';
        $checkoutAdmin->CreateOrderDetails();
        break;
    // Thông tin cá nhân
    case 'profile';
        $profileAdmin->profile();
        break;
    // Quản lý đơn hàng
    case 'listOrders';
        $orderAdmin->listOrder();
        break;
    case 'updateOrder';
        $orderAdmin->updateOrder();
        break;
    case 'updateOrderPost';
        $orderAdmin->updateOrder_POST();

    case 'timkiemsanpham':
        $HomeClient->search();
        break;
    case 'historic':
        $historicClient->orderHistory();
        break;
    case 'viewOrderDetails':
        $historicClient->viewOrderDetails();
        break;
    case "403":
        include './views/client/403page.php';
        break;
        }
    
?>