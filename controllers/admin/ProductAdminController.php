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
        // // Kiểm tra quyền của người dùng phải có role = 0 thì mới được vào admin
        if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 0) {
            header('location:?action=403'); // Chuyển hướng đến trang lỗi không đủ quyền
            exit();
        }
        // logic quyền admin
        if (!isset($_SESSION['name'])) {
            header('location:?action=login'); // Chuyển hướng đến trang đăng nhập
            exit();
        }
        
        // 1. Gọi xuống model để lấy danh sách product
        $danhSachProduct = $this->productQuery->getAllProduct();
        $variant = $this->productQuery->get_allvariant();
        $listCategories = $this->productQuery->getAllCategories();
        $product = $this->productQuery->render_allproduct();
        
        // Hiển thị file view
        include './views/admin/product/list.php'; // Gọi đến view danh sách sản phẩm
    }
    // Thêm mới sản phẩm vào database
    public function Create()
    {   
        // logic quyền admin
        if (!isset($_SESSION['name'])) {
            header('location:?action=login'); // Chuyển hướng đến trang đăng nhập
            exit();
        }
        // Kiểm tra quyền của người dùng phải có role =0 thì mới được vào admin
        if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 0) {
            header('location:?action=403'); // Chuyển hướng đến trang lỗi không đủ quyền
            exit();
        }
        if((isset($_POST['themmoi'])) && ($_POST['themmoi'])) {
            
                $name = $_POST['product_name'];
                $category_id = $_POST['category_id'];
                $price = $_POST['product_price'];
                $sale_price = $_POST['product_sale_price'];
                $description = $_POST['product_description'];

        // Xử lý tải lên ảnh chính
        $image = "";
            // luu hinh ảnh vao
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
            $product_id=$this->productQuery->addProduct($name, $image,	$price,$category_id,$sale_price, $description,$gallery);
            // $this->productQuery->insertAlbumAnhSan($product_id, $link_product_gallery);
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
        // lấy danh mục
        $listCategories = $this->productQuery->getAllCategories();
        $product = $this->productQuery->render_allproduct();
        include "./views/admin/product/create.php";
    }// END Create()
    public function Edit()
    {   
        // logic quyền admin
        if (!isset($_SESSION['name'])) {
            header('location:?action=login'); // Chuyển hướng đến trang đăng nhập
            exit();
        }
        // Kiểm tra quyền của người dùng phải có role =1 thì mới được vào admin
        if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 0) {
            header('location:?action=403'); // Chuyển hướng đến trang lỗi không đủ quyền
            exit();
        }
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $one =$this->productQuery->getone_product($id);
        }
            // if ($one) {
            //     // Sản phẩm được tìm thấy
            //     // Thực hiện xử lý tiếp
            //     print_r($one);die; // In thông tin sản phẩm (test)
            // } else {
            //     // Không tìm thấy sản phẩm
            //     echo "Không tìm thấy sản phẩm với ID: $id";
            // }

        // } else {
        //     // Tham số ID không được truyền qua URL
        //     echo "Tham số ID không tồn tại trong URL.";
        // }
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['capnhat'])) {
            $category_id = $_POST['category_id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['product_description'] ??null;
            $price = $_POST['product_price'] ??null;
            $sale_price = $_POST['product_sale_price'] ??null;
            $size = $_POST['size'] ?? null;
            $color = $_POST['color'] ??null;
            $quantity = $_POST['quantity'] ??null;

            // xu li tai len anh chinh
            $image = "";

                // luu hinh ảnh vao
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

                if($image != "" && $gallery_images != "") {
                    $this->productQuery->update_product($name, $image,	$price,$category_id,$sale_price, $description,$gallery, $id);
                } else {
                    $this->productQuery->update_product_noneimg($name,	$price,$category_id,$sale_price, $description,$id );
                }
            }
            header('Location: index.php?action=product');
        

        }

        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        echo "</pre>";
        
        $listCategories = $this->productQuery->getAllCategories();
        $variant = $this->productQuery->get_allvariant();
        $product = $this->productQuery->render_allproduct();
                
        include './views/admin/product/edit.php';
    }

    
    
    // Xóa sản phẩm
    // public function deleteProduct() {
    //     if (isset($_GET['id'])) {
    //         $product_id = $_GET['id'];
    
    //         // Gọi model để xóa sản phẩm
    //         $this->productQuery->delete($product_id);
    
    //         // Chuyển hướng về danh sách sản phẩm sau khi xóa
    //         header('Location: index.php?action=product');
    //         exit;
    //     }
    // }
    
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
