<?php
require_once("../controllers/Admin/LoginPageController.php");


if (isset($_POST['login'])) {
    $controller = new LoginPageController();
    $controller->handleLogin();
}

if (isset($_GET['logout'])) {
    $controller = new LoginPageController();
    $controller->handleLogout();
}
