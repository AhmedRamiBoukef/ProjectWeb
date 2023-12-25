<?php
require_once("../controllers/Admin/LoginPageController.php");
require_once("../controllers/Admin/BrandsPageController.php");
require_once("../controllers/User/NewsPageController.php");
require_once("../controllers/User/ReviewPageController.php");

if (isset($_POST['login'])) {
    $controller = new AdminLoginPageController();
    $controller->handleLogin();
}

if (isset($_POST['signup'])) {
    $controller = new AdminLoginPageController();
    $controller->handleSignup();
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


if(isset($_GET['offset']) && isset($_GET['limit'])) {
    $controller = new NewsPageController();
    $news = $controller->getNews($_GET['offset'],$_GET['limit']);
    echo json_encode($news);
}


if(isset($_GET['getNews']) ) {
    $controller = new NewsPageController();
    $news = $controller->getNombreNews();
    echo json_encode($news);
}

if(isset($_GET['getReviewsbyID']) ) {
    $controller = new ReviewPageController();
    $reviews = $controller->getNombreReviewsByID($_GET['getReviewsbyID']);
    echo json_encode($reviews);
}

if(isset($_GET['id']) && isset($_GET['showReviewPage'])) {
    $controller = new ReviewPageController();
    echo $controller->getVehicleReviews($_GET['id'],$_GET['showReviewPage']);
}


if(isset($_POST['note']) && isset($_POST['review'])) {
    $controller = new AdminBrandsPageController();
    $models = $controller->getModelsByBrand($_POST['brandID']);
}