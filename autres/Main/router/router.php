<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Main/controllers/HomePageController.php');
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case "/Project/Main/":
        $controller = new HomePageController();
        $controller->showHomePage();
        break;  
}