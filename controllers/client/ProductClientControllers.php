<?php 
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
    public function productDetails()
    {
        $product_id = $_GET['product_id'];
        $product = $this->productQuery->getDetailSan($product_id);
        $variant = $this->productQuery->get_product_by_variant($product_id);
        // if (isset($_GET['product_id'])) {
        //     $product_id = $_GET['product_id'];
        //     $product = $this->productQuery->get_product_by_id($product_id);
        //     $variant = $this->productQuery->get_product_by_variant($product_id);
        // }
        

        
        include "./views/client/product-details.php";
        
    }
    public function miniProduct(){
        $product_id = $_GET['product_id'];
        $product = $this->productQuery->getDetailSan($product_id);
        $variant = $this->productQuery->get_product_by_variant($product_id);
        include './views/client/layout/modalPoduct.php';
    }
    public function categoryProductClient(){
        $listCategories = $this->productQuery->getAllCategories();
        $variant = $this->productQuery->get_allvariant();
        $product = $this->productQuery->render_allproduct();
        include './views/client/categoryProductClient.php';
    }
    // 
    public function addToCart(){
        // Xóa toàn bộ giỏ hàng nếu được yêu cầu
        if (isset($_GET['emptyCart']) && ($_GET['emptyCart']) == 1) {
            unset($_SESSION['myCart']);
            header('Location: ?action=addToCart');
            exit();
        }
    
        // Xử lý khi người dùng thêm sản phẩm vào giỏ hàng
        if (isset($_POST['add_to_cart']) && $_POST['product_id'] > 0) {
            $product_id = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) && $_POST['quantity'] > 0 ? (int)$_POST['quantity'] : 1;
    
            // Tìm thông tin sản phẩm từ database
            $product = $this->productQuery->find($product_id);
            if (!$product) {
                // Nếu không tìm thấy sản phẩm, dừng xử lý
                header('Location: ?action=addToCart&error=notfound');
                exit();
            }
    
            // Khởi tạo giỏ hàng nếu chưa tồn tại
            if (!isset($_SESSION['myCart']) || !is_array($_SESSION['myCart'])) {
                $_SESSION['myCart'] = [];
            }
    
            // Kiểm tra sản phẩm có tồn tại trong giỏ hàng không
            $product_exists = false;
            foreach ($_SESSION['myCart'] as $key => $value) {
                if ($value['product_id'] == $product_id) {
                    $product_exists = true;
    
                    // Tăng số lượng sản phẩm
                    $_SESSION['myCart'][$key]['quantity'] += $quantity;
    
                    // Cập nhật lại tổng giá trị sản phẩm
                    $_SESSION['myCart'][$key]['total'] = $_SESSION['myCart'][$key]['quantity'] * $_SESSION['myCart'][$key]['price'];
                    break;
                }
            }
    
            // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
            if (!$product_exists) {
                $array_pro = [
                    "product_id" => $product->product_id,
                    "image" => $product->image,
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => $quantity, // Số lượng từ yêu cầu
                    "total" => $product->price * $quantity, // Tính tổng giá trị
                    "size" => $product->size,
                    "color" => $product->color
                ];
                array_push($_SESSION['myCart'], $array_pro);
            }
        }
    
        // Hiển thị trang giỏ hàng
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


}



?> 