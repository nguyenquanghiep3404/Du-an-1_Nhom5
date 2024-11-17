<?php 
require_once './controllers/admin/ProductAdminController.php';
require_once './models/ProductQuery.php';
require_once './models/Product.php';

// Lấy giá trị "id" từ đường dẫn url
$product_id = "";
if (isset($_GET["product_id"])) {
    $id = $_GET["product_id"];
}

$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
$productAdmin = new ProductAdminController();
switch ($action) {
    case "admin":
        include './views/admin/dashboard.php';
        break;
    case "product":
        $productAdmin->showList();
        break;
    case "product-create":
        $productAdmin->create();
        break;
    case "product-edit":
        $productAdmin->edit($product_id);
        break;
    // case "hide-product":
    //     $productAdmin->hide();
    //     break;
    // case "unhide-product":
    //     $productAdmin->unhide();
        
    case "category":
        include './views/admin/category/show-dm.php';
        break;
    case "client":
        include './views/client/dashboardClient.php';
        break;
   
    
}


?>