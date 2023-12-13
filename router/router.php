<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/User/HomePageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/User/ComparePageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/Admin/LoginPageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/Admin/HomePageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/Admin/BrandsPageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/controllers/Admin/ReviewPageController.php');
session_start();
$request = $_SERVER['REQUEST_URI'];
$error = 0;
$AdminVehiculeid = 0;
if (isset($_GET['AdminVehiculeid'])) {
    $AdminVehiculeid = $_GET['AdminVehiculeid'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    $request = explode('?', $request)[0];
}else{
    $error=0;
}


if (strpos($request, "Admin") && isset($_SESSION['admin']) && ($request == "/Project/Admin/" || $request == "/Project/Admin/login/") && $request != "/Project/Admin/Api/api.php") {
    header("Location: /Project/Admin/home/");
    exit();
}

if (strpos($request, "Admin") && !isset($_SESSION['admin']) && !($request == "/Project/Admin/" || $request == "/Project/Admin/login/"&& $request != "/Project/Admin/Api/api.php")) {
    header("Location: /Project/Admin/login/");
    exit();
}

switch ($request) {
    case "/Project/Admin/":
        $controller = new AdminLoginPageController();
        $controller->showLoginPage($error);
        break;  
    case "/Project/Admin/login/":
        $controller = new AdminLoginPageController();
        $controller->showLoginPage($error);
        break;  
    case "/Project/Admin/home/":  
        $controller = new AdminHomePageController();
        $controller->showHomePage();
        break;  
    case "/Project/Admin/brands/":  
        $controller = new AdminBrandsPageController();
        $controller->showBrandsPage();
        break;  
    case "/Project/Admin/vehicule/":  
        $controller = new AdminBrandsPageController();
        $controller->showVehiculePage($AdminVehiculeid);
        break;  
    case "/Project/Admin/review/":  
        $controller = new AdminReviewPageController();
        $controller->showReviewPage();
        break;  
    case "/Project/":
        $controller = new HomePageController();
        $controller->showHomePage();
        break;  
    case "/Project/compare/":
        $controller = new ComparePageController();
        $controller->showComparePage();
        break;  
}