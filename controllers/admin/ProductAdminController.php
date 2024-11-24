<?php 
require_once './models/Product.php';
require_once './models/ProductQuery.php';

ob_start();



class ProductAdminController {

    public $productQuery;
    
    // Khai báo phương thức 
    public function __construct()
    {
        // 1. Khởi tạo giá trị cho thuộc tính productQuery
        $this->productQuery = new ProductQuery();
        // Mở trình duyệt lên để kiểm tra kết quả

    }
    // Hiện sản phẩm
    public function showList()
    {
        // 1. Gọi xuống model để lấy danh sách product
        $danhSachProduct = $this->productQuery->all();
        $variant = $this->productQuery->get_allvariant();
        $listCategories = $this->productQuery->getAllCategories();
        $product = $this->productQuery->render_allproduct();
        
        // Hiển thị file view
        include './views/admin/product/list.php'; // Gọi đến view danh sách sản phẩm
    }
    // Thêm mới sản phẩm vào database
    public function Create()
    {   
        if((isset($_POST['themmoi'])) && ($_POST['themmoi'])) {

                $name = $_POST['product_name'];
                $category_id = $_POST['category_id'];
                $price = $_POST['product_price'];
                $sale_price = $_POST['product_sale_price'];
                $description = $_POST['product_description'];
            
        // Xử lý tải lên ảnh chính
        $image = "";

        if($_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "./uploads/product/";
            $target_file = $target_dir.basename($_FILES["product_image"]["name"]);

            if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $message = "Lỗi khi tải lên ảnh.";
            }
        }
        // Xử lý việc tải nhiều ảnh
        $gallery_images = [];
        $target_dir_gallery = "./uploads/product_gallery/";

        if(isset($_FILES["product_gallery"])) {
            foreach($_FILES["product_gallery"]["tmp_name"] as $key => $tmp_name) {
                $gallery_image_name = $_FILES["product_gallery"]["name"][$key];
                $gallery_target_file = $target_dir_gallery.basename($gallery_image_name);

                // Chỉ xử lý ảnh nếu người dùng đã tải lên
                if($_FILES["product_gallery"]["error"][$key] == UPLOAD_ERR_OK) {
                    if(move_uploaded_file($tmp_name, $gallery_target_file)) {
                        $gallery_images[] = $gallery_target_file;
                    } else {
                        $message = "Lỗi khi tải lên ảnh trong gallery.";
                        break;
                    }
                }
            }
        }
        if(empty($message)) {
            $galleryData = ["images" => $gallery_images];
            $gallery = json_encode($gallery_images);
            $product_id=$this->productQuery->addProduct($name, $image,	$price,$category_id,$sale_price, $description, $gallery);
           
            $size = $_POST['size'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            // Insert data into the 'variant' table
            $this->productQuery->addProductVariants($product_id,	$size,	$color,	$quantity);
            header('Location: index.php?action=product');
         }

        }// END if submit form
        // Hiển thị file view
        $variant = $this->productQuery->get_allvariant();
        $listCategories = $this->productQuery->getAllCategories();
        $product = $this->productQuery->render_allproduct();
        include "./views/admin/product/create.php";
    }// END Create()

    public function edit($product_id)
    {

        if(isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $one = $this->productQuery->getone_product($product_id);
        }
        if((isset($_POST['capnhat'])) && ($_POST['capnhat'])) {
            $name = $_POST['product_name'];
            $category_id = $_POST['category_id'];
            $price = $_POST['product_price'];
            $sale_price = $_POST['product_sale_price'];
            $description = $_POST['product_description'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            // Xử lý tải lên ảnh chính
            $image = "";

            if($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                $target_dir = "./uploads/product/";
                $target_file = $target_dir.basename($_FILES["image"]["name"]);

                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                } else {
                    $message = "Lỗi khi tải lên ảnh.";
                }
            }

            // Xử lý việc tải nhiều ảnh
            $gallery_images = [];
            $target_dir_gallery = "./uploads/product_gallery/";

            if(isset($_FILES["product_gallery"])) {
                foreach($_FILES["product_gallery"]["tmp_name"] as $key => $tmp_name) {
                    $gallery_image_name = $_FILES["product_gallery"]["name"][$key];
                    $gallery_target_file = $target_dir_gallery.basename($gallery_image_name);

                    // Chỉ xử lý ảnh nếu người dùng đã tải lên
                    if($_FILES["product_gallery"]["error"][$key] == UPLOAD_ERR_OK) {
                        if(move_uploaded_file($tmp_name, $gallery_target_file)) {
                            $gallery_images[] = $gallery_target_file;
                        } else {
                            $message = "Lỗi khi tải lên ảnh trong gallery.";
                            break;
                        }
                    }
                }
            }

            if(empty($message)) {
                $galleryData = ["images" => $gallery_images];
                $gallery = json_encode($gallery_images);
                if($image != "" && $gallery != "") {
                    $this->productQuery->update_product($name, $image,	$price,$category_id,$sale_price, $description, $gallery, $product_id);
                } else {
                    $this->productQuery->update_product_noneimg($name,	$price,$category_id,$sale_price, $description,$product_id);
                }
            }
            header('Location: index.php?action=product');
        

           
        }// END if submit form capnhat
        // Hiển thị file view
        $variant = $this->productQuery->get_allvariant();
        $listCategories = $this->productQuery->getAllCategories();
        $product = $this->productQuery->render_allproduct();
        include "./views/admin/product/edit.php";

    } // end edit sản phẩm
    public function showsp(){
        $spmoi = $this->productQuery->render_allproduct();
    }

//     public function hide() {
//         $product_id = $_GET['id'];
//         $productModel = new ProductModel();
//         if ($productModel->hideProduct($product_id)) {
//             header('Location: index.php?action=product');
//             exit();
//         }
//     }

//     public function unhide() {
//         $product_id = $_GET['id'];
//         $productModel = new ProductModel();
//         if ($productModel->unhideProduct($product_id)) {
//             header('Location: index.php?action=product');
//             exit();
//         }
//     }
// }
    
    // public function __destruct()
    //     {
    //         // Code...
    //     }

}
ob_end_flush();
?>
