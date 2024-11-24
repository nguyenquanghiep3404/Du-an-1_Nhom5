<?php 

require_once './commons/function.php';
require_once './commons/env.php';


class ProductQuery  {
    public $conn;
    public function __construct()
    {
        $this->conn = connect_db();
    }
    // Lấy ra tất cả các danh mục từ database
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   

    // thêm sản phẩm vào bảng product
    public function addProduct ($name, $image,	$price,$category_id,$sale_price, $description, $gallery)
    {
        //khai bao try catch
        try{
            $sql= "INSERT INTO products (name, image, price, category_id, sale_price, description, gallery, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
            return pdo_last_insert_id($sql,$name, $image,$price,$category_id,$sale_price,$description,$gallery);
            
            
            // 3. Return kết quả
        }catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm insert trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }
    // thêm sản phẩm vào bảng biến thể
    public function addProductVariants ($product_id,	$size,	$color,	$quantity)
    {
        //khai bao try catch
      
            $sql = "INSERT INTO product_variant( product_id,	size,	color,	quantity) VALUES (?,?,?,?)";

            
            // 3. Return kết quả
            pdo_execute($sql, $product_id,	$size,	$color,	$quantity);
            echo "Thêm thành công variant!";
        
    }
    // Truy xuất tất cả sản phẩm từ bảng product
        function render_allproduct()
    {
        $sql = "SELECT * FROM products";
        return pdo_query($sql);
    }
    // lấy chi tiết 1 số sản phẩm dựa trên ID
        function getone_product($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id=?";
        return pdo_query($sql, $product_id);
    }
    // Truy xuất tất cả sản phẩm từ bảng product biến thể
        function get_allvariant()
    {
        $sql = "SELECT * FROM product_variant";
        return pdo_query($sql);
    }
    // Cập nhật cả ảnh sản phẩm.(khi người dùng tải lên hình ảnh mới hoặc thay đổi thư viện ảnh.)
    function update_product($name, $image,	$price,$category_id,$sale_price, $description, $gallery, $product_id)
    {
        try {
            $sql = "UPDATE products SET  name = ?, image = ?,	price =?,category_id = ?,sale_price =?, description = ?, gallery = ?, created_at=NOW(), updated_at=NOW() WHERE product_id=?";
            pdo_execute($sql, $name, $image,$price,$category_id,$sale_price, $description, $gallery, $product_id);
            echo "Chỉnh sửa thành công";
        } catch (PDOException $e) {
            echo "Chỉnh Sửa thất bại! ".$e->getMessage();
        }
      
        
    }
    // Không cập nhật ảnh (Dùng để cập nhật sản phẩm không bao gồm hình ảnh (trong trường hợp hình ảnh không được tải lên mới).)
    function update_product_noneimg($name,	$price,$category_id,$sale_price, $description,$product_id){
        try {
            $sql = "UPDATE products SET name=?, price=?, category_id=?, sale_price=?, description=?, created_at=NOW(), updated_at=NOW() WHERE product_id=?";
            pdo_execute($sql, $name,	$price,$category_id,$sale_price, $description, $product_id);
            echo "Chỉnh sửa thành công";
        } catch (PDOException $e) {
            echo "Chỉnh Sửa thất bại! ".$e->getMessage();
        }
    }

    // Lấy sản phẩm kèm tên danh mục liên quan
        function get_product_by_id($product_id)
    {
        $sql = "SELECT p.*, c.name AS category_name,c.id AS id_category
                FROM product AS p
                JOIN category AS c ON p.id_category = c.id
                WHERE p.hide = 0 AND p.id=?";
        return pdo_query_one($sql, $product_id);
    }
    // Lấy top 4 sp moi nhat

    public function getTop4ProductLastes() {
        try{
            $sql = "SELECT * FROM products ORDER BY created_at LIMIT 4 ";
            $data = $this->conn->query($sql)->fetchAll();
            $ds = [];
            // chuyển dữ liệu sang object product
            foreach ($data as $row) {
                $product = convertToObjectProduct($row);
                $ds[] = $product;
            }
            return $ds;
        }catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm insert trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }
    

    // Hiển thị danh sách sản phẩm dưới dạng HTML
//     function show_product($list_product)
// {
//     $html_product = '';

//     foreach ($list_product as $pd) {
//         extract($pd);

//         if (isset($sale) && $sale > 0) {
//             $discountAmount = $sale * $price / 100;
//             $discountedPrice = $price - $discountAmount;

//             $boxPrice = '
//                 <div class="product-price">
//                     <span class="product-origin">' . number_format($discountedPrice, 0, ',', '.') . ' đ</span>
//                     <span class="product-discount">' . number_format($price, 0, ',', '.') . ' đ</span>
//                 </div>
//             ';

//             $boxSale = '
//                 <div class="product-status">
//                     <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
//                         <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
//                             <img alt="" aria-hidden="true" src="https://tokyolife.vn/_next/static/media/tagsale.0850a4f6.svg" style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
//                         </span>
//                         <img alt="" srcset="/_next/static/media/tagsale.0850a4f6.svg 1x, /_next/static/media/tagsale.0850a4f6.svg 2x" src="/_next/static/media/tagsale.0850a4f6.svg" decoding="async" data-nimg="intrinsic" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
//                     </span>
//                     <span class="percent-discount"> -' . $sale . '%</span>
//                 </div>';
//         } else {
//             $boxPrice = '
//                 <div class="product-price">
//                     <span class="product-origin">' . number_format($price, 0, ',', '.') . ' đ</span>
//                 </div>
//             ';

//             $boxSale = '';
//         }

//         if ($hot == 1) {
//             $hot = '                    
//                 <div class="selling">
//                     <span>Bán chạy</span>
//                 </div>
//             ';
//         } else {
//             $hot = '
//                 <div class="selling" style="opacity:0">
//                     <span>Bán chạy</span>
//                 </div>
//             ';
//         }

//         $currentDateTime = date('Y-m-d H:i:s');

//         $createdDate = strtotime($created_at);

//         $currentDate = strtotime($currentDateTime);
//         $newProduct = strtotime('-15 days', $currentDate);

//         if ($createdDate >= $newProduct) {
//             $new = '
//                 <div class="new-pd">
//                     <img class="new-icon" src="uploads/new-icon.png" />
//                 </div>
//             ';
//         } else {
//             $new = '';
//         }

//         // liên kêts
//         $link = "index.php?page=details&id=" . $id;

//         $html_product .= '
//             <div class="product-item">
//                 <a href="' . $link . '">
//                     <img class="product-image" src="uploads/' . $img . '" width="100%">
//                 </a>
//                 <div class="box-title flex">
//                         ' . $hot . '
//                         ' . $new . '
//                 </div>
//                 <div class="product-content">
//                     <a href="' . $link . '" class="name-product">' . $name . '</a>
//                     ' . $boxPrice . '
//                 </div>

//                 ' . $boxSale . '
//             </div>
//         ';
//     }

//     return $html_product;
// }
// show sản phẩm
public function all()
    {
        //khai báo try catch
        try{

            // 1. Khai báo câu sql
            $sql = "SELECT * FROM products";
             // 2. Thực hiện truy vấn
            $data = $this->conn->query($sql)->fetchAll();
            // var_dump($data);
            // 3. Convert array data sang object data
            $danhSachObject = [];

            foreach ($data as $value) {
                $product = new Product();

                // Gán giá trị vào cho $product
                $product->product_id = $value["product_id"];
                $product->name = $value["name"];
                
                $product->price = $value["price"];
                $product->sale_price = $value["sale_price"];
                $product->image = $value["image"];
                $product->updated_at = $value["updated_at"];
                $product->created_at = $value["created_at"];
                

                // Push product vào mảng object
                // Kéo lên đầu vòng foreach để khai báo biến danhSach
                array_push($danhSachObject, $product);  
            }
                return $danhSachObject;
        }
        catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm all trong model: " . $error->getMessage();
            echo "</h1>";
        }

    } // END FUNCTION ALL()
    
    // function hideProduct($product_id) {
    //     $conn = connect_db(); 
    //     $sql = "UPDATE products SET status = 1 WHERE product_id  = :product_id ";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':product_id ', $product_id);
    //     $stmt->execute();
    //     return $stmt->rowCount() > 0;
    // }
    // function unhideProduct($product_id) {
    //     $conn = connect_db();
    //     $sql = "UPDATE products SET status = 0 WHERE product_id  = :product_id ";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':product_id ', $product_id);
    //     $stmt->execute();
    //     return $stmt->rowCount() > 0;
    // }
    
    // public function __destruct()
    // {
    //     $this->conn = null;
    // }

     // Lấy ra tất cả các màu từ database
    // public function allColor()
    // {
    //         $sql = "SELECT * FROM variant_colors";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    // // Lấy ra tất cả các size từ database
    // public function allSize()
    // {
    //         $sql = "SELECT * FROM variant_sizes";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

}
?>