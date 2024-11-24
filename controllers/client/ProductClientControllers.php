<?php 
require_once './models/ProductClientModels.php';
require_once './models/ProductQuery.php';
require_once './commons/function.php';
class ProductClientControllers {

    public $productQuery;
    public $categoryQuery;
   
    public function __construct() {
        $this->productQuery = new ProductQuery();
    }

    // trang sản phẩm hiện thị view trang chủ
    public function home(){
        $listProductLastes = $this->productQuery->getTop4ProductLastes();
        include './views/client/dashboardClient.php';
    }

}



?> 