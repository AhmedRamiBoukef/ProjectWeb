<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/views/HomePageView.php');
class HomePageController
{
    public function showHomePage()
    {
        $view = new HomePageView();
        $view->showHomePage();
    }
}