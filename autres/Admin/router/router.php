<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/controllers/LoginPageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/controllers/HomePageController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/controllers/BrandsPageController.php');
session_start();
$request = $_SERVER['REQUEST_URI'];
$error = 0;
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    $request = explode('?', $request)[0];
}else{
    $error=0;
}


if (isset($_SESSION['admin']) && ($request == "/Project/Admin/" || $request == "/Project/Admin/login/") && $request != "/Project/Admin/Api/api.php") {
    header("Location: /Project/Admin/home/");
    exit();
}

if (!isset($_SESSION['admin']) && !($request == "/Project/Admin/" || $request == "/Project/Admin/login/"&& $request != "/Project/Admin/Api/api.php")) {
    header("Location: /Project/Admin/login/");
    exit();
}




switch ($request) {
    case "/Project/Admin/":
        $controller = new LoginPageController();
        $controller->showLoginPage($error);
        break;  
    case "/Project/Admin/login/":
        $controller = new LoginPageController();
        $controller->showLoginPage($error);
        break;  
    case "/Project/Admin/home/":  
        $controller = new HomePageController();
        $controller->showHomePage();
        break;  
    case "/Project/Admin/brands/":  
        $controller = new BrandsPageController();
        $controller->showBrandsPage();
        break;  
}