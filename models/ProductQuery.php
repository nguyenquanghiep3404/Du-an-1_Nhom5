<?php 

require_once './commons/function.php';
require_once './commons/env.php';


class ProductQuery {
    public $conn;
    public function __construct()
    {
        $this->conn = connect_db();
    }
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
                $product->content = $value["content"];
                $product->price = $value["price"];
                $product->sale_price = $value["sale_price"];
                $product->image = $value["image"];
                $product->updated_at = $value["updated_at"];
                $product->created_at = $value["created_at"];
                $product->status = $value["status"];

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

    public function insert (Product $product)
    {
        //khai bao try catch
        try{
            $sql = "INSERT INTO `products`(`product_id`, `name`, `image`,`content`, `price`) VALUES (not null, '$product->name','$product->image','$product->content','$product->price')";
             // 2. Thực hiện truy vấn
            $data = $this->conn->query($sql);
            // 3. Return kết quả
             if ($data === 1) {
                return "success";
            }
        }catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm insert trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }// END function insert

    public function find($product_id)
    {
        try{
            $sql = "SELECT * FROM products WHERE product_id = $product_id";
            $data = $this->conn->query($sql)->fetch();
            // 3. Convert dữ liệu từ array sang object
            if ($data !== false) {
                $product = new Product();
                $product->product_id = $data["product_id"];
                $product->name = $data["name"];
                $product->image = $data["image"];
                $product->price = $data["price"];
                // $product->publisher = $data["publisher"];
                // $product->publish_date = $data["publish_date"];

                // 4. Return kết quả
                return $product;
            } else {
                echo "Lỗi: ID không tồn tại. Mời bạn kiểm tra lại.";
            }
        } catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm find trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }
    public function edit($product_id, Product $product)
    {
        try{
            $sql = "UPDATE `products` SET `name`='$product->name',`image`='$product->image',`price`='$product->price' WHERE product_id = $product_id";

            // 2. Thực hiện truy vấn
            $data = $this->conn->query($sql);

            // 3. Return kết quả
            // = 1 khi có chỉnh sửa dữ liệu
            // = 0 khi không chỉnh sửa dữ liệu nào cả
            if ($data === 1 || $data === 0) {
                return "success";
            }
        }catch (Exception $error) {
            echo "<h1>";
            echo "Lỗi hàm update trong model: " . $error->getMessage();
            echo "</h1>";
        }
    }

    
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
    
    public function __destruct()
    {
        $this->conn = null;
    }



}
?>