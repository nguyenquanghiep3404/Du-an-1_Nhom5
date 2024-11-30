<?php 
require_once './models/ProductClientModels.php';
require_once './models/ProductQuery.php';
require_once './commons/function.php';
require_once './models/cartModels.php';
class HomeClientControllers {

    public $productQuery;
    public $categoryQuery;
    public $cartModels;
    public $loginModel;
   
    public function __construct() {
        $this->productQuery = new ProductQuery();
        $this->cartModels = new CartModels();
        $this->loginModel = new LoginModel();
    }

    // trang sản phẩm hiện thị view trang chủ
    public function home(){
        $listProductLastes = $this->productQuery->getTop4ProductLastes();
        include './views/client/dashboardClient.php';
    }
    public function productDetails(){
        // if (isset($_GET['id'])) {
        //     $product_id = $_GET['id'];
        //     // product_view($id_product);
        //     $details = get_product_by_id($id_product);
        //     $variant = get_product_by_variant($id_product);

        //     $feedback = show_feedback_by_id_product($id_product);
        // }
        include './views/client/product-details.php';
    }
    public function addToCart(){
        // var_dump($_POST);
        // them san pham khi khach nhanh nut mua ngay hoac them vao gio hang
        if(isset($_POST['add_to_cart']) && $_POST['product_id']>0){
            // tìm sp khách hàng đã bấm mua ngay bằng id
            $product = $this->productQuery->find($_POST['product_id']);
            $total = $product->price * $_POST['quantity'];
            // chèn thông tin vào giỏ hàng
            $array_pro = [
                "product_id"=>$product->product_id,
                "image" => $product->image,
                "name"=> $product->name,
                "price" => $product->price,
                "quantity" => $product->quantity,
                "total" => $total,
                "size" => $product->size,
                "color" => $product->color
            ];
            // push mảng lên session
            if (!isset($_SESSION['myCart']) || !is_array($_SESSION['myCart'])) {
                $_SESSION['myCart'] = []; // Khởi tạo giỏ hàng nếu chưa tồn tại
            }
            array_push($_SESSION['myCart'],$array_pro);
            // var_dump($_SESSION['myCart']);
            // echo "<pre>";
            // print_r($_SESSION['myCart']);
            


        }

        include './views/client/cart.php';
    }
    public function updateCartQuantity()
{
    if (isset($_POST['index']) && isset($_POST['quantity'])) {
        $index = (int)$_POST['index'];
        $quantity = (int)$_POST['quantity'];

        // Kiểm tra nếu giỏ hàng và sản phẩm tồn tại
        if (isset($_SESSION['myCart'][$index])) {
            $_SESSION['myCart'][$index]['quantity'] = $quantity;
            $_SESSION['myCart'][$index]['total'] = $_SESSION['myCart'][$index]['price'] * $quantity;

            // Tính tổng giỏ hàng
            $cartTotal = array_reduce($_SESSION['myCart'], function ($total, $item) {
                return $total + $item['total'];
            }, 0);

            // Trả về dữ liệu cập nhật
            echo json_encode([
                'status' => 'success',
                'productTotal' => $_SESSION['myCart'][$index]['total'],
                'cartTotal' => $cartTotal
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
    }
}
public function removeCartItem()
{
    if (isset($_POST['index'])) {
        $index = (int)$_POST['index'];

        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if (isset($_SESSION['myCart'][$index])) {
            unset($_SESSION['myCart'][$index]);
            $_SESSION['myCart'] = array_values($_SESSION['myCart']); // Sắp xếp lại chỉ số mảng

            // Tính tổng giỏ hàng
            $cartTotal = array_reduce($_SESSION['myCart'], function ($total, $item) {
                return $total + $item['total'];
            }, 0);

            // Trả về dữ liệu cập nhật
            echo json_encode(['status' => 'success', 'cartTotal' => $cartTotal]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
    }
}

    // public function cart(){
    //     if (isset($_GET['action']) && $_GET['action'] == 'del1' && isset($_GET['id'])) {
    //         $product_id = $_GET['id'];
    //         foreach ($_SESSION["myCart"] as $key => $array_pro) {
    //             if ($array_pro["id"] == $product_id) {
    //                 unset($_SESSION["myCart"][$key]);
    //             }
    //         }

    //         $total_price = 0;
    //         foreach ($_SESSION["myCart"] as $array_pro) {
    //             extract($array_pro);
    //             $subtotal = (float) $price * (float) $quantity;
    //             $total_price += $subtotal;
    //         }
    //     }

    //     if (isset($_GET['act']) && $_GET['act'] == 'del_all') {
    //         unset($_SESSION["myCart"]);
    //         unset($_SESSION["total_order"]);
    //         unset($_SESSION["total_price"]);
    //         unset($_SESSION["subtotal"]);
    //         unset($_SESSION["temporary"]);
    //         unset($_SESSION["discounted"]);
    //         $total_price = 0;
    //         header('Location: index.php?action=client');
    //     }    
    //     include './views/client/cart.php';
    // }
//     public function updateCart()
// {
//     if (isset($_POST['update_quantity']) && isset($_POST['product_id'])) {
//         $product_id = $_POST['product_id'];
//         $action = $_POST['update_quantity'];

//         foreach ($_SESSION['myCart'] as &$product) {
//             if ($product['id'] == $product_id) {
//                 if ($action == 'increase') {
//                     $product['quantity']++;
//                 } elseif ($action == 'decrease' && $product['quantity'] > 1) {
//                     $product['quantity']--;
//                 }
//                 $product['total'] = $product['price'] * $product['quantity'];
//                 break;
//             }
//         }
//     }

//     include './views/client/cart.php';
// }
// public function addGioHang(){
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         if (isset($_SESSION['user_client'])) {
//             $mail = $this->loginModel->getTaiKhoanFromEmail($_SESSION['user_client']);
//             // Lấy dữ liệu giỏ hàng của người dùng
            
//             $gioHang = $this->loginModel->getGioHangFromUser($mail['id']);
//             if (!$gioHang) {
//                 $gioHangId = $this->loginModel->addGioHang($mail['id']);
//                 $gioHang = ['id'=>$gioHangId];
//                 $chiTietGioHang = $this->loginModel->getDetailGioHang($gioHang['id']);
//             }else{
//                 $chiTietGioHang = $this->loginModel->getDetailGioHang($gioHang['id']);
//             }

//             $san_pham_id = $_POST['san_pham_id'];
//             $so_luong = $_POST['so_luong'];

//             $checkSanPham = false;
//             foreach($chiTietGioHang as $detail){
//                 if ($detail['san_pham_id'] == $san_pham_id) {
//                     $newSoLuong = $detail['so_luong'] + $so_luong;
//                     $this->loginModel->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
//                     $checkSanPham = true;
//                     break;
//                 }
//             }
//             if(!$checkSanPham){
//                 $this->loginModel->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
//             }
//             header("Location:" . BASE_URL . '?act=gio-hang');
//         }else{
//             var_dump('Chưa đăng nhập');die;
//         }
        

        
        
//     }
// }

// public function gioHang(){
//     if (isset($_SESSION['user_client'])) {
//         $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
//         // Lấy dữ liệu giỏ hàng của người dùng
        
//         $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
//         if (!$gioHang) {
//             $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
//             $gioHang = ['id'=>$gioHangId];
//             $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
//         }else{
//             $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
//         }
//         // var_dump($chiTietGioHang);die;

//         require_once './views/gioHang.php';

//     }else{
//         header("Location: ". BASE_URL . '?act=login');
//     }
// }


}



?> 