<?php 
require_once './models/Product.php';
require_once './models/ProductQuery.php';

class ProductAdminController  {

    public $productQuery;

    // Khai báo phương thức 
    public function __construct()
    {
        // 1. Khởi tạo giá trị cho thuộc tính bookQuery
        $this->productQuery = new ProductQuery();
        // Mở trình duyệt lên để kiểm tra kết quả
    }
    public function showList()
    {
        // 1. Gọi xuống model để lấy danh sách book
        $danhSachProduct = $this->productQuery->all();
        
        // Hiển thị file view
        include './views/admin/product/list.php'; // Gọi đến view danh sách sản phẩm
    }
    public function Create()
    {
        $product = new Product();
        $thongBaoLoi = "";
        $thongBaoThanhCong = ""; // Hiển thị thành khi có
        $thongBaoLoiUploadFile = "";

        // 2. Kiểm tra người dùng ấn submit form chưa
        if (isset($_POST["submitForm"])) {
            // $product->product_id = $_POST["product_id"];
            $product->name = trim($_POST["name"]);
            $product->content = trim($_POST["content"]);
            $product->price = trim($_POST["price"]);
            // $product->sale_price = trim($_POST["sale_price"]);
            $product->image = trim($_POST["image"]);
            // $product->updated_at = trim($_POST["updated_at"]);
            // $product->created_at = trim($_POST["created_at"]);
            // $product->status = trim($_POST["status"]);

            // 4. Validate form
            // Validate bắt buộc: title, author, publisher, publish_date
            if ($product->name === "" || $product->content === "" || $product->price === "" ) {
                $thongBaoLoi = "Tên sách, Tác giả, Nhà xuất bản, Ngày xuất bản là thông tin bắt buộc. Mời bạn nhập đầy đủ thông tin và thử lại.";
                // Mở file view để hiển thị biến $thongBaoLoi ra
            }
            // 6. Xử lý upload file
            var_dump($_FILES);
            // Lưu ý 2 thông tin
            // name: tên file mà bạn lựa chọn upload
            // tmp_name: vị trí bộ nhớ tạm đang lưu trữ file upload
            // Kiểm tra xem người dùng có chọn file không

            if ($_FILES["file_anh_upload"]["name"] !== "") {
                // Thực hiện upload
                // Tham số 1: Vị trí bộ nhớ tạm đang lưu trữ file
                // Tham số 2: Vị trí bạn muốn lưu file vào. Chọn là thư mục upload trong source code
                $thamSo1 = $_FILES["file_anh_upload"]["tmp_name"];
                $thamSo2 = "./uploads/" . $_FILES["file_anh_upload"]["name"];
                $ketQuaUploadFile = move_uploaded_file($thamSo1, $thamSo2);
                // Kiểm tra kết quả upload
                if ($ketQuaUploadFile) {
                    // Gán giá trị đường vẫn file biến để lưu xuống csdl
                    $product->image = $thamSo2;

                } else {
                    // Upload thất bài
                    // Hiển thị lỗi
                    $thongBaoLoiUploadFile = "Upload file không thành công. Mời bạn thử lại.";
                }
            }
            // 7. Kiểm tra trạng thái thông báo lỗi hiện tại đã hết chưa
            if ($thongBaoLoi === "" && $thongBaoLoiUploadFile === "") {
                // 8. Gọi xuống model để insert dữ liệu
                $ketQua = $this->productQuery->insert($product);

                // 9. Hiển thị thông báo
                if ($ketQua === "success") {
                    // Hiển thị thông báo thành công
                    $thongBaoThanhCong = "Tạo mới thành công. Mời bạn tiếp tục tạo mới hoặc quay lại danh sách.";

                    // Reset form
                    $product = new Product();

                } else {
                    // Hiển thị thông báo lỗi
                    $thongBaoLoi = "Tạo mới thất bại. Mời bạn kiểm tra lỗi và thực hiện lại.";

                }

            }
        }// END if submit form
        // Hiển thị file view
        include "./views/admin/product/create.php";
    }
    // END showCreate()

    public function edit($product_id)
    {
        if ($product_id !== "") {
        
            $product = new Product();
            $thongBaoLoi = "";
            $thongBaoThanhCong = ""; // Hiển thị thành khi có
            $thongBaoLoiUploadFile = "";

        // Gọi xuống model để lấy chi tiết bản ghi và lưu vào biến $book
        $product = $this->productQuery->find($product_id);
        // --> Mở trình duyệt và f5, sẽ thầy input đã hiển thị được giá trị bản ghi

        // 2. Kiểm tra người dùng ấn submit form chưa
        if (isset($_POST["submitForm"])) {
            // $product->product_id = $_POST["product_id"];
            $product->name = trim($_POST["name"]);
            $product->content = trim($_POST["content"]);
            $product->price = trim($_POST["price"]);
            // $product->sale_price = trim($_POST["sale_price"]);
            $product->image = trim($_POST["image"]);
            // $product->updated_at = trim($_POST["updated_at"]);
            // $product->created_at = trim($_POST["created_at"]);
            // $product->status = trim($_POST["status"]);

            // 4. Validate form
            // Validate bắt buộc: title, author, publisher, publish_date
            if ($product->name === "" || $product->content === "" || $product->price === "" ) {
                $thongBaoLoi = "Tên sách, Tác giả, Nhà xuất bản, Ngày xuất bản là thông tin bắt buộc. Mời bạn nhập đầy đủ thông tin và thử lại.";
                // Mở file view để hiển thị biến $thongBaoLoi ra
            }
            // 6. Xử lý upload file
            var_dump($_FILES);
            // Lưu ý 2 thông tin
            // name: tên file mà bạn lựa chọn upload
            // tmp_name: vị trí bộ nhớ tạm đang lưu trữ file upload
            // Kiểm tra xem người dùng có chọn file không

            if ($_FILES["file_anh_upload"]["name"] !== "") {
                // Thực hiện upload
                // Tham số 1: Vị trí bộ nhớ tạm đang lưu trữ file
                // Tham số 2: Vị trí bạn muốn lưu file vào. Chọn là thư mục upload trong source code
                $thamSo1 = $_FILES["file_anh_upload"]["tmp_name"];
                $thamSo2 = "./uploads/" . $_FILES["file_anh_upload"]["name"];
                $ketQuaUploadFile = move_uploaded_file($thamSo1, $thamSo2);
                // Kiểm tra kết quả upload
                if ($ketQuaUploadFile) {
                    // Gán giá trị đường vẫn file biến để lưu xuống csdl
                    $product->image = $thamSo2;

                } else {
                    // Upload thất bài
                    // Hiển thị lỗi
                    $thongBaoLoiUploadFile = "Upload file không thành công. Mời bạn thử lại.";
                }
            }
            // 7. Kiểm tra trạng thái thông báo lỗi hiện tại đã hết chưa
            if ($thongBaoLoi === "" && $thongBaoLoiUploadFile === "") {
                // 8. Gọi xuống model để insert dữ liệu
                $ketQua = $this->productQuery->edit($product_id,$product);

                // 9. Hiển thị thông báo
                if ($ketQua === "success") {
                    // Hiển thị thông báo thành công
                    $thongBaoThanhCong = "sua thành công. Mời bạn tiếp tục tạo sua hoặc quay lại danh sách.";

                    

                } else {
                    // Hiển thị thông báo lỗi
                    $thongBaoLoi = "Tạo mới thất bại. Mời bạn kiểm tra lỗi và thực hiện lại.";

                }

            }
        }// END if submit form
        // Hiển thị file view
        include "./views/admin/product/edit.php";
    } else {
        echo "<h1> Lỗi: Tham số id trống. Mời bạn kiểm tra tham số id trên đường dẫn url. </h1>";
    }
        
        
    } // end showupdate
    
//     public function edit() {
//         $product_id = $_GET['product_id'];
//         $productModel = new ProductModel();
//         $product = $productModel->getProductById($product_id);

//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $name = $_POST['name'];
//             $image = $_FILES['image']['name'];
//             $price = $_POST['price'];

//             // Xử lý upload ảnh mới nếu có, nếu không giữ nguyên ảnh cũ
//             if (!empty($image)) {
//                 move_uploaded_file($_FILES['image']['tmp_name'], "./uploads/" . $image);
//             } else {
//                 $image = $product['image'];
//             }

//             if ($productModel->updateProduct($product_id, $name, $image, $price)) {
//                 header('Location: index.php?action=product');
//                 exit();
//             }
//         }
//         include './views/admin/product/edit.php';
//     }
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
    
    public function __destruct()
        {
            // Code...
        }

}

?>