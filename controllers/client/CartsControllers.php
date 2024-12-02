<?php 
require_once './models/cartsModels.php';

class CartsControllers {
    public $cartsControllers;

    public function __construct()
    {
        // 1. Khởi tạo giá trị cho thuộc tính productQuery
        $this->cartsControllers = new CartsControllers();
        // Mở trình duyệt lên để kiểm tra kết quả

    }

    // public function addGioHang() {
    //     if(isset($_POST['btn-addToCart'])) {
    //         // Thông tin sản phẩm lấy từ form
    //         $product_id = $_POST['product-id'];
    //         $variant_id = $_POST['variant-id'];
    //         $product_name = $_POST['product-name'];
    //         $product_size = $_POST['size'];
    //         $product_color = $_POST['color'];
    //         $product_quantity = $_POST['quantity'];
    //         $product_price = $_POST['product-price'];

    //         // Tất cả thông tin được lưu vào một mảng
    //         $product = [
    //             'product_id' => $product_id,
    //             'quantity' => $product_quantity,
    //             'variant_id' => $variant_id,
    //             "name" => $product_name,
    //             "size" => $product_size,
    //             "color" => $product_color,
    //             "quantity" => $product_quantity,
    //             "price" => $product_price,
    //         ];
    //         // Kiểm tra sự tồn tại của giỏ hàng:
    //         // Nếu $_SESSION["cart"] chưa tồn tại, nó được khởi tạo dưới dạng một mảng trống.

    //          // Kiểm tra nếu người dùng đã đăng nhập
    //         if (isset($_SESSION['user'])) {
    //             // Người dùng đã đăng nhập, lấy user_id từ session
    //             $user_id = $_SESSION['user']['user_id'];

    //             // Kết nối cơ sở dữ liệu và thêm sản phẩm vào bảng `carts`
    //             $created_at = date('Y-m-d H:i:s');
    //             $stmt = connect_db()->prepare("
    //                 INSERT INTO carts (user_id, product_id, variant_id, quantity, created_at, updated_at) 
    //                 VALUES (:user_id, :product_id, :variant_id, :quantity, :created_at, :created_at)
    //                 ON DUPLICATE KEY UPDATE 
    //                 quantity = quantity + :quantity
    //             ");
    //             $stmt->execute([
    //                 ':user_id' => $user_id,
    //                 ':product_id' => $product_id,
    //                 ':variant_id' => $variant_id,
    //                 ':quantity' => $product_quantity,
    //                 ':created_at' => $created_at,
    //             ]);
    //         } else {
    //             // Người dùng chưa đăng nhập: xử lý giỏ hàng bằng session
    //             if (!isset($_SESSION['cart'])) {
    //                 $_SESSION['cart'] = [];
    //             }

    //             $product_exists = false;
    //             foreach ($_SESSION['cart'] as &$item) {
    //                 if ($item['product_id'] == $product_id && $item['variant_id'] == $variant_id) {
    //                     $item['quantity'] += $product_quantity;
    //                     $product_exists = true;
    //                     break;
    //                 }
    //             }

    //             if (!$product_exists) {
    //                 $_SESSION['cart'][] = $product;
    //             }
    //         }

    //         // Chuyển hướng đến trang giỏ hàng
    //         header('Location: index.php?action=cart');
    //         exit;
    //     }
    // }
    



            

    
    //  Khi người dùng đăng nhập sau khi thêm vào giỏ hàng
    // Nếu người dùng đăng nhập sau khi thêm sản phẩm vào giỏ hàng trong session, bạn cần hợp nhất giỏ hàng từ session vào cơ sở dữ liệu.
    // function syncCart($user_id, $pdo) {
    //     if (!empty($_SESSION['cart'])) {
    //         foreach ($_SESSION['cart'] as $item) {
    //             $stmt = $pdo->prepare("INSERT INTO carts (user_id, product_id, variant_id, quantity, created_at, updated_at) 
    //                                    VALUES (:user_id, :product_id, :variant_id, :quantity, NOW(), NOW())
    //                                    ON DUPLICATE KEY UPDATE 
    //                                    quantity = quantity + :quantity");
    //             $stmt->execute([
    //                 ':user_id' => $user_id,
    //                 ':product_id' => $item['product_id'],
    //                 ':variant_id' => $item['variant_id'] ?? null,
    //                 ':quantity' => $item['quantity']
    //             ]);
    //         }
    //         // Xóa giỏ hàng tạm thời trong session
    //         unset($_SESSION['cart']);
    //     }
    // }
    

    // public function addToCart(){
    //     if (isset($_POST['btn-addToCart'])){
    //             $product_id = $_POST['product_id'];
    //             $product_img = $_POST['product-image'];
    //             $product_name = $_POST['product-name'];
    //             $product_size = $_POST['size'];
    //             $product_color = $_POST['color'];
    //             $product_quantity = $_POST['quantity'];
    //             $product_price = $_POST['product-price'];


    //     }
    //     var_dump($_POST);die;
    //     include './views/client/cart.php';
    // }
    
}







?>