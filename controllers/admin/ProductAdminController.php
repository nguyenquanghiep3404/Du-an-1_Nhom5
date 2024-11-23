<?php 
require_once './models/Product.php';
require_once './models/ProductQuery.php';

ob_start();



class ProductAdminController extends Product {

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

    // public function edit($product_id)
    // {
    //     if ($product_id !== "") {
        
    //         $product = new Product();
    //         $thongBaoLoi = "";
    //         $thongBaoThanhCong = ""; // Hiển thị thành khi có
    //         $thongBaoLoiUploadFile = "";

    //     // Gọi xuống model để lấy chi tiết bản ghi và lưu vào biến $book
    //     $product = $this->productQuery->find($product_id);
    //     // --> Mở trình duyệt và f5, sẽ thầy input đã hiển thị được giá trị bản ghi

    //     // 2. Kiểm tra người dùng ấn submit form chưa
    //     if (isset($_POST["submitForm"])) {
    //         // $product->product_id = $_POST["product_id"];
    //         $product->name = trim($_POST["name"]);
    //         $product->content = trim($_POST["content"]);
    //         $product->price = trim($_POST["price"]);
    //         // $product->sale_price = trim($_POST["sale_price"]);
    //         $product->image = trim($_POST["image"]);
    //         // $product->updated_at = trim($_POST["updated_at"]);
    //         // $product->created_at = trim($_POST["created_at"]);
    //         // $product->status = trim($_POST["status"]);

    //         // 4. Validate form
    //         // Validate bắt buộc: title, author, publisher, publish_date
    //         if ($product->name === "" || $product->content === "" || $product->price === "" ) {
    //             $thongBaoLoi = "Tên sách, Tác giả, Nhà xuất bản, Ngày xuất bản là thông tin bắt buộc. Vui lòng nhập đầy đủ thông tin và thử lại.";
    //             // Mở file view để hiển thị biến $thongBaoLoi ra
    //         }
    //         // 6. Xử lý upload file
    //         var_dump($_FILES);
    //         // Lưu ý 2 thông tin
    //         // name: tên file mà bạn lựa chọn upload
    //         // tmp_name: vị trí bộ nhớ tạm đang lưu trữ file upload
    //         // Kiểm tra xem người dùng có chọn file không

    //         if ($_FILES["product_image"]["name"] !== "") {
    //             // Thực hiện upload
    //             // Tham số 1: Vị trí bộ nhớ tạm đang lưu trữ file
    //             // Tham số 2: Vị trí bạn muốn lưu file vào. Chọn là thư mục upload trong source code
    //             $thamSo1 = $_FILES["product_image"]["tmp_name"];
    //             $thamSo2 = "./uploads/" . $_FILES["product_image"]["name"];
    //             $ketQuaUploadFile = move_uploaded_file($thamSo1, $thamSo2);
    //             // Kiểm tra kết quả upload
    //             if ($ketQuaUploadFile) {
    //                 // Gán giá trị đường vẫn file biến để lưu xuống csdl
    //                 $product->image = $thamSo2;

    //             } else {
    //                 // Upload thất bài
    //                 // Hiển thị lỗi
    //                 $thongBaoLoiUploadFile = "Upload file không thành công. Vui lòng thử lại.";
    //             }
    //         }
    //         // 7. Kiểm tra trạng thái thông báo lỗi hiện tại đã hết chưa
    //         if ($thongBaoLoi === "" && $thongBaoLoiUploadFile === "") {
    //             // 8. Gọi xuống model để insert dữ liệu
    //             $ketQua = $this->productQuery->edit($product_id,$product);

    //             // 9. Hiển thị thông báo
    //             if ($ketQua === "success") {
    //                 // Hiển thị thông báo thành công
    //                 $thongBaoThanhCong = "sua thành công. Vui lòng tiếp tục tạo sua hoặc quay lại danh sách.";

                    

    //             } else {
    //                 // Hiển thị thông báo lỗi
    //                 $thongBaoLoi = "Tạo mới thất bại. Vui lòng kiểm tra lỗi và thực hiện lại.";

    //             }

    //         }
    //     }// END if submit form
    //     // Hiển thị file view
    //     include "./views/admin/product/edit.php";
    // } else {
    //     echo "<h1> Lỗi: Tham số id trống. Vui lòng kiểm tra tham số id trên đường dẫn url. </h1>";
    // }
        
        
    // } // end showupdate
    

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
