<?php 
require_once './models/ProductClientModels.php';
require_once './models/ProductQuery.php';
require_once './commons/function.php';
class HomeClientControllers {

    public $productQuery;
    public $categoryQuery;
   
    public function __construct() {
        $this->productQuery = new ProductQuery();
    }

    // trang sản phẩm hiện thị view trang chủ
    public function home(){
        $listProductLastes = $this->productQuery->getTop4ProductLastes();
        include './views/client/dashboardClient.php';
    }
    public function cart(){
        var_dump($_POST);
        // them san pham khi khach nhanh nut mua ngay hoac them vao gio hang
        if(isset($_POST['add_to_cart']) && $_POST['product_id']>0){
            // tìm sp khách hàng đã bấm mua ngay bằng id
            $product = $this->productQuery->find($_POST['product_id']);
            $total = $product->price * $_POST['quantity'];
            // chèn thông tin vào giỏ hàng
            $array_pro = [
                "image" => $product->image,
                "name"=> $product->name,
                "price" => $product->price,
                "quantity" => $product->quantity,
                "total" => $total,
            ];
            // push mảng lên session
            if (!isset($_SESSION['myCart']) || !is_array($_SESSION['myCart'])) {
                $_SESSION['myCart'] = []; // Khởi tạo giỏ hàng nếu chưa tồn tại
            }
            array_push($_SESSION['myCart'],$array_pro);
            // echo "<pre>";
            // print_r($_SESSION['myCart']);



        }

        include './views/client/cart.php';
    }

}



?> 