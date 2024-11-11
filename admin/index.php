<?php 
session_start();

// ket noi database
require_once "../models/pdo.php";

// Require toàn bộ file Controllers
require_once './controllers/CategoryControllers.php';
require_once './models/homeModels.php';

// Route
$act = $_GET['act'] ?? '/';

// match ($act) {
//     'home_admin' => (new CategoryControllers)->admin_dm(),
// }
?>