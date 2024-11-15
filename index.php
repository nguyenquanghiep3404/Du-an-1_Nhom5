<?php 
$action = isset($_GET["action"]) ? $_GET["action"] :"admin";
switch ($action) {
    case "admin":
        include('./views/admin/dashboard.php');
        break;
}
?>
<?php
// Kết nối với cơ sơ dự liệu PDO
require_once "./commons/env.php";
require_once "./commons/function.php";
// Kết nối với các file Model
require_once "./models/categoryModel.php";
// Kết nối với các file Controller
require_once "./controllers/admin/categoryControllers.php";
$act = $_GET['act'] ?? '/';
match($act){
    // Quản lý danh mục
    'home-dm'=>(new categoryControllers)->all_dm(),
    // 'delete-dm'=>(new categoryControllers)->delete_dm(),
    'hide-dm' => (new categoryControllers)->hide_dm(), 
    'show-dm' => (new categoryControllers)->show_dm(),
    'create-dm'=>(new categoryControllers)->create_dm(),
    'createPost-dm'=>(new categoryControllers)->createPost_dm(),
    'update-dm'=>(new categoryControllers)->update_dm(),
    'updatePost-dm'=>(new categoryControllers)->updatePost_dm(),

}
?>