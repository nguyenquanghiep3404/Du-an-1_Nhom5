<?php 

require_once './commons/function.php';
require_once './commons/env.php';


class ProductQuery  {
    public $conn;
    public function __construct()
    {
        $this->conn = connect_db();
    }
    // ### ADMIN

    // getall sản phẩm (lấy tất cả thông tin từ bảng san pham)
    public function getAllProduct()
    {
        //khai báo try catch
        try{
            // 1. Khai báo câu sql
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products INNER JOIN categories ON products.category_id = categories.category_id ";
             // 2. Thực hiện truy vấn
             $stmt = $this->conn->prepare($sql);

             $stmt->execute();
 
             return $stmt->fetchAll();
        }
        catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm all trong model: " . $error->getMessage();
            echo "</h1>";
        }
    } // END FUNCTION ALL()
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
            $sql= "INSERT INTO products (name, image, price, category_id, sale_price, description,gallery, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                // lay id sp vua them
            return pdo_last_insert_id($sql,$name, $image,$price,$category_id,$sale_price,$description,$gallery);
            // 3. Return kết quả
        }catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm insert trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }
    public function getDetailSan($product_id) {
        try {
            $sql = '
                SELECT 
                    p.*, 
                    c.name AS category_name, 
                    pv.color, 
                    pv.size, 
                    pv.quantity
                FROM products AS p
                INNER JOIN categories AS c ON p.category_id = c.category_id
                LEFT JOIN product_variant AS pv ON p.product_id = pv.product_id
                WHERE p.product_id = :product_id
            ';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':product_id' => $product_id]);
    
            return $stmt->fetch(); // Trả về dữ liệu của sản phẩm
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
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
    function find($product_id) {
        $sql = "
            SELECT 
                p.*, 
                pv.color, 
                pv.size, 
                pv.quantity 
            FROM products AS p
            LEFT JOIN product_variant AS pv ON p.product_id = pv.product_id
            WHERE p.product_id = $product_id
        ";
        $data = $this->conn->query($sql)->fetch();
        if ($data) {
            $product = convertToObjectProduct($data); // Chuyển đổi dữ liệu thành đối tượng
            var_dump($product); // Debug dữ liệu trả về
            return $product;
        } else {
            return null; // Không tìm thấy sản phẩm
        }
    }
    // Truy xuất tất cả sản phẩm từ bảng product biến thể
        function get_allvariant()
    {
        $sql = "SELECT * FROM product_variant";
        return pdo_query($sql);
    }
    // Cập nhật cả ảnh sản phẩm.(khi người dùng tải lên hình ảnh mới hoặc thay đổi thư viện ảnh.)
    // function update_product($name, $image,	$price,$category_id,$sale_price, $description,$gallery, $product_id)
    // {
    //     try {
    //         $sql = "UPDATE products SET  name = ?, image = ?,	price =?,category_id = ?,sale_price =?, description = ?, gallery = ?, created_at=NOW(), updated_at=NOW() WHERE product_id=?";
    //         pdo_execute($sql, $name, $image,$price,$category_id,$sale_price, $description,$gallery, $product_id);
    //         echo "Chỉnh sửa thành công";
    //     } catch (PDOException $e) {
    //         echo "Chỉnh Sửa thất bại! ".$e->getMessage();
    //     }       
    // }
    function update_product($name, $image, $price, $category_id, $sale_price, $description, $gallery, $product_id) {
        $sql = "UPDATE products 
                SET name = ?, image = ?, price = ?, category_id = ?, sale_price = ?, description = ?, gallery = ?,created_at=NOW(), updated_at = NOW() 
                WHERE product_id = ?";
        return pdo_execute($sql, $name, $image, $price, $category_id, $sale_price, $description, $gallery, $product_id);
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

    ### TRANG CHU
    // Lấy top 4 sp moi nhat
    //  p.*: Lấy tất cả các cột từ bảng products.
    // vp.size, vp.color: Lấy cột size và color từ bảng variant_product.
    // INNER JOIN: Chỉ lấy những dòng mà products.id khớp với variant_product.product_id.
    // ORDER BY p.created_at: Sắp xếp sản phẩm theo thời gian tạo.
    // LIMIT 4: Giới hạn kết quả trả về chỉ 4 dòng.
    public function getTop4ProductLastes() {
        try {
            $sql = "
                SELECT 
                    p.*, 
                    vp.size, 
                    vp.color,
                    vp.quantity
                FROM 
                    products AS p 
                INNER JOIN 
                    product_variant AS vp 
                ON 
                    p.product_id = vp.product_id 
                ORDER BY 
                    p.created_at 
                LIMIT 8
            ";
            $data = $this->conn->query($sql)->fetchAll();
            $ds = [];
            // Chuyển dữ liệu sang object product
            foreach ($data as $row) {
                $product = convertToObjectProduct($row); // Cần sửa hàm này để xử lý thêm size và color
                $product->size = $row['size']; // Thêm thông tin size
                $product->color = $row['color']; // Thêm thông tin color
                $product->quantity = $row['quantity'];
                $ds[] = $product;
            }
            return $ds;
        } catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm getTop4ProductLastes trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }
    function get_product_by_variant($product_id)
    {
        $sql = "SELECT products.product_id, product_variant.* FROM products
        INNER JOIN product_variant ON products.product_id = product_variant.product_variant_id
        WHERE products.product_id = ? AND quantity > 0";

        return pdo_query($sql, $product_id);
    }
    function get_product_by_id($product_id)
    {
        $sql = "SELECT p.*, c.name AS category_name, c.category_id AS id_category
                FROM products AS p
                JOIN categories AS c ON p.category_id = c.category_id
                WHERE p.product_id = ?";
        return pdo_query_one($sql, $product_id);
    }
    
// }
// show sản phẩm

    
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
   
    // Hàm tìm kiếm sản phẩm theo từ khóa
    public function searchProducts($keyword) {
        $query = "SELECT * FROM products WHERE name LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>