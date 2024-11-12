<?php 
$action = isset($_GET["action"]) ? $_GET["action"] :"admin";
switch ($action) {
    case "admin":
        include('./views/admin/dashboard.php');
        break;
}


?>