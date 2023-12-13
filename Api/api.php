<?php
require_once("../controllers/Admin/LoginPageController.php");
require_once("../controllers/Admin/BrandsPageController.php");

if (isset($_POST['login'])) {
    $controller = new AdminLoginPageController();
    $controller->handleLogin();
}

if (isset($_GET['logout'])) {
    $controller = new AdminLoginPageController();
    $controller->handleLogout();
}


if(isset($_POST['brandID'])) {
    $controller = new AdminBrandsPageController();
    $models = $controller->getModelsByBrand($_POST['brandID']);
    echo json_encode($models);
}
if(isset($_POST['modelID'])) {
    $controller = new AdminBrandsPageController();
    $years = $controller->getYearsByModel($_POST['modelID']);
    echo json_encode($years);
}
if(isset($_GET['modelID']) && isset($_GET['year'])) {
    $controller = new AdminBrandsPageController();
    $versions = $controller->getVersionByModel($_GET['modelID']);
    echo json_encode($versions);
}
