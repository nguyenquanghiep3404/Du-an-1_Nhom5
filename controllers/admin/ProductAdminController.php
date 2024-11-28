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
        // // mảng hình ảnh 
        // $img_array = $_FILES['product_gallery'];
        // // Xử lý thêm album ảnh sản phẩm img_array
        // if (!empty($img_array['name'])) {
        //     foreach ($img_array['name'] as $key => $value) {
        //         $file = [
        //             'name' => $img_array['name'][$key],
        //             'type' => $img_array['type'][$key],
        //             'tmp_name' => $img_array['tmp_name'][$key],

        //         ];

        //         $link_product_gallery = uploadFile($file, './uploads/product_gallery/');
                
        //     }
        // }
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
            // $galleryData = ["images" => $gallery_images];
            // $gallery = json_encode($gallery_images);
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
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $price = $_POST['product_price'];
        $sale_price = $_POST['product_sale_price'];
        $description = $_POST['product_description'];

        // Xử lý cập nhật ảnh chính
        $image = $_POST['current_image']; // Giữ ảnh cũ
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "./uploads/product/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file; // Ghi đè nếu có ảnh mới
            }
        }

        // Xử lý cập nhật album ảnh
        $gallery_images = [];
        $target_dir_gallery = "./uploads/product_gallery/";

        if (isset($_FILES["product_gallery"])) {
            foreach ($_FILES["product_gallery"]["tmp_name"] as $key => $tmp_name) {
                if ($_FILES["product_gallery"]["error"][$key] == UPLOAD_ERR_OK) {
                    $gallery_image_name = $_FILES["product_gallery"]["name"][$key];
                    $gallery_target_file = $target_dir_gallery . basename($gallery_image_name);

                    if (move_uploaded_file($tmp_name, $gallery_target_file)) {
                        $gallery_images[] = $gallery_target_file;
                    }
                }
            }
        }

        // Cập nhật dữ liệu sản phẩm
        $this->productQuery->updateProduct($product_id, $name, $image, $price, $category_id, $sale_price, $description);

        // Xóa ảnh cũ trong gallery và thêm ảnh mới nếu cần
        if (!empty($gallery_images)) {
            $this->productQuery->deleteGalleryImages($product_id);
            $this->productQuery->addGalleryImages($product_id, $gallery_images);
        }

        // Cập nhật biến thể sản phẩm
        $size = $_POST['size'];
        $color = $_POST['color'];
        $quantity = $_POST['quantity'];
        $this->productQuery->updateProductVariants($product_id, $size, $color, $quantity);

        header('Location: index.php?action=product');
        exit;
    }

    // Lấy dữ liệu cần thiết để hiển thị form
    $product_id = $_GET['id'];
    $product = $this->productQuery->getProductById($product_id);
    $listCategories = $this->productQuery->getAllCategories();
    $variant = $this->productQuery->get_allvariant();
    include "./views/admin/product/edit.php";
}

    // public function formEditProduct($product_id)
    // {
    //     // Hàm này dùng để hiển thị form nhập
    //     // Lấy ra thông tin của sản phẩm cần sửa
    //     $product_id = $_GET['product_id'];
    //     $variant = $this->productQuery->get_allvariant();
    //     $listCategories = $this->productQuery->getAllCategories();
    //     $product = $this->productQuery->getDetailSanPham($product_id);
    //     $listAnhSanPham = $this->productQuery->getListAnhSanPham($product_id);
    //     include "./views/admin/product/edit.php";
    // } // end formEdit sản phẩm
    // public function postEditSanPham()
    // {
    //     // Kiểm tra xem dữ liệu có phải đc submit lên không
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
    //         $product_id = $_POST['product_id'];
    //         // Truy vấn  
    //         $sanOld = $this->productQuery->getDetailSanPham($product_id);
    //         $old_file = $sanOld['image']; // Lấy ảnh cũ để phục vụ cho sửa ảnh

    //         $name = $_POST['product_name'];
    //         $category_id = $_POST['category_id'];
    //         $price = $_POST['product_price'];
    //         $sale_price = $_POST['product_sale_price'];
    //         $description = $_POST['product_description'];
    //         $size = $_POST['size'] ?? null; // Đảm bảo có giá trị mặc định nếu không nhập
    //         $color = $_POST['color'] ?? null;
    //         $quantity = $_POST['quantity'] ?? null;

    //         // sua anh chinh
    //         $image = $_FILES['image'] ?? null;

    //         // logic sửa ảnh 
    //         if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
    //             // upload ảnh mới lên 
    //             $new_file = uploadFile($image, './uploads/product/');
    //             if (!empty($old_file)) { // Nếu có ảnh cũ thì xóa đi
    //                 deleteFile($old_file);
    //             }
    //         } else {
    //             $new_file = $old_file;
    //         }


    //             $this->productQuery->updateSanPham(
    //                 $name,
    //                 $new_file,
    //                 $price,
    //                 $category_id,
    //                 $sale_price,
    //                 $description,
    //                 $product_id,
                    
    //             );

    //         }
           

    // }
    public function productDetails()
    {
        $product_id = $_GET['product_id'];
        $product = $this->productQuery->getDetailSan($product_id);
        
        // $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        // $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        
        
        include "./views/client/product-details.php";
        
    }
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
