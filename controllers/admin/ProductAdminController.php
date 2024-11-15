<?php 
require_once './models/Product.php';

class ProductAdminController  {
    public function index() {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        include './views/admin/product/list.php'; // Gọi đến view danh sách sản phẩm
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $image = $_FILES['image']['name'];
            $price = $_POST['price'];
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');

            // Upload hình ảnh
            move_uploaded_file($_FILES['image']['tmp_name'], "./upload/" . $image);

            $productModel = new ProductModel();
            if ($productModel->createProduct($name, $image, $price, $created_at, $updated_at)) {
                header('Location: index.php?action=product');
                exit();
            }
        }
        include './views/admin/product/create.php';
    }
    public function edit() {
        $product_id = $_GET['id'];
        $productModel = new ProductModel();
        $product = $productModel->getProductById($product_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $image = $_FILES['image']['name'];
            $price = $_POST['price'];

            // Xử lý upload ảnh mới nếu có, nếu không giữ nguyên ảnh cũ
            if (!empty($image)) {
                move_uploaded_file($_FILES['image']['tmp_name'], "./uploads/" . $image);
            } else {
                $image = $product['image'];
            }

            if ($productModel->updateProduct($product_id, $name, $image, $price)) {
                header('Location: index.php?action=product');
                exit();
            }
        }
        include './views/admin/product/edit.php';
    }
    public function hide() {
        $product_id = $_GET['id'];
        $productModel = new ProductModel();
        if ($productModel->hideProduct($product_id)) {
            header('Location: index.php?action=product');
            exit();
        }
    }

    public function unhide() {
        $product_id = $_GET['id'];
        $productModel = new ProductModel();
        if ($productModel->unhideProduct($product_id)) {
            header('Location: index.php?action=product');
            exit();
        }
    }
}



?>