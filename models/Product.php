<?php 

require_once './commons/function.php';
require_once './commons/env.php';

class ProductModel {
    public function getAllProducts() {
        $conn = connect_db();
        $sql = "SELECT * FROM products WHERE status = 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductById($product_id){
        $conn = connect_db();
        $sql = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function createProduct($name, $image, $price, $created_at, $updated_at){
        $conn = connect_db();
        $sql = "INSERT INTO products (name, image, price, created_at, updated_at) VALUES (:name, :image, :price, :created_at, :updated_at)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);
        return $stmt->execute();
    }
    public function updateProduct($product_id, $name, $image, $price, $created_at, $updated_at){
        $conn = connect_db();
        $sql = "UPDATE products SET name = :name, image = :image, price = :price WHERE product_id  = :product_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id ', $product_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }
    function hideProduct($product_id) {
        $conn = connect_db(); 
        $sql = "UPDATE products SET status = 1 WHERE product_id  = :product_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id ', $product_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    function unhideProduct($product_id) {
        $conn = connect_db();
        $sql = "UPDATE products SET status = 0 WHERE product_id  = :product_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id ', $product_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    




}
?>