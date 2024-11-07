<?php
session_start();
ob_start();

//connect db
require_once "models/pdo.php";
//user
require_once "models/user.php";
//category
require_once 'models/category.php';
//product
require_once "models/product.php";
//cart
require_once "models/cart.php";
//bill
require_once "models/bill.php";
// checkout
require_once "models/checkout.php";
//feedback
require_once "models/feedback.php";




require_once "views/header.php";

//data home page

//router
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
            //trang chủ
        case 'home':

            require_once 'views/home.php';
            break;

            //trang đăng nhập
        case 'login':

            require_once 'views/login.php';
            break;

            //chức năng đăng nhập
        case 'login-function':

            break;

        case 'login-bill':

            break;

            //trang đằng ký
        case 'register':
            require_once 'views/register.php';
            break;

            //chức năng đăng ký
        case 'register-function':

            // kiểm tra tồn tại nút đăng kí và nút đăng ký đc nhấn
            break;

            //đăng xuất
        case 'logout':
            
            break;

            //trang đổi mật khẩu
        case 'changePassword':
            require_once "views/changePassword.php";
            break;

            //chức năng đổi mật khẩu
        case 'change-function':
        
            break;

            //trang sản phẩm
        case 'product':
            require_once 'views/product.php';
            break;

        case 'profile':
            require_once 'views/profile.php';
            break;

            //trang chi tiết sản phẩm
        case 'details':
            
            require_once 'views/details.php';
            break;


        case 'checkout':

            require_once 'views/checkout.php';
            break;

        case 'order':
            //check session user
            

            require_once 'views/order.php';
            break;

        case 'order-success':
            require_once 'views/order_success.php';
            break;

            //thêm vào giỏ hàng
        case 'addToCart':
           
            break;


        case 'cart':
           

            require_once "views/cart.php";
            break;

        case 'update_user':
            
            break;

        case "search":

            require_once 'views/search.php';
            break;

        case 'search_bill':
            require_once 'views/search_bill.php';
            break;

        case 'acp_bill':
           
            break;

        case 'vote':

          

            require_once 'views/vote.php';
            break;

        default:
            http_response_code(404);
            require_once "views/404page.php";
            break;
    }
} else {
    require_once 'views/home.php';
}

require_once "views/footer.php";

ob_end_flush();
