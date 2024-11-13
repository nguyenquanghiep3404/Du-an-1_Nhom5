<?php 

require_once '../commons/function.php';
require_once '../commons/env.php';

    // Lấy ra toàn bộ dữ liệu của bảng Product trong database
    class Product extends connect_db {
        public function listProduct() {
            $sql = 'select * from products';
            $stmt = $this->connect_db()->prepare($sql); 
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy dữ liệu từ ban
    public function addProduct($name, $image, $description, $short_description, $price, $content, $sale_price, $link) {
        $sql = 'INSERT INTO products (name, image, description, short_description, content, sale_price, price, link) VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $this->connect_db()->prepare($sql);
        return $stmt->execute([$name, $image, $description, $short_description, $price, $content, $sale_price, $link]);
    }
}
?>