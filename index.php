<?php 
require_once './controllers/admin/ProductAdminController.php';

$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
$productAdmin = new ProductAdminController();
switch ($action) {
    case "admin":
        include './views/admin/dashboard.php';
        break;
    case "product":
        $productAdmin->index();
        break;
    case "product-create":
        $productAdmin->create();
        break;
    case "product-edit":
        $productAdmin->edit();
        break;
    case "hide-product":
        $productAdmin->hide();
        break;
    case "unhide-product":
        $productAdmin->unhide();
        break;
   
    
}


?>