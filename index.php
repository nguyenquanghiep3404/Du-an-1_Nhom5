<?php 
$action = isset($_GET["action"]) ? $_GET["action"] :'admin';
switch ($action) {
    case "admin":
        include './views/admin/dashboard.php';
        break;
    case "product":
        include './views/admin/product/list.php';
        break;
    case "product-create":
        include './views/admin/product/create.php';
        break;
    case "product-edit":
        include './views/admin/product/edit.php';
        break;
      case "login":
        include './views/auth/login.php'  ;
        break;
        case "register":
         include './views/auth/register.php';
         break;
}
?>