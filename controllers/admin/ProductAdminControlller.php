<?php 
require_once './models/Product.php';
class ProductAdminController extends Product {
    public function admin_sp() {
        $listProducts = $this->listProduct();
        include './views/admin/product/list.php';
    }
}



?>