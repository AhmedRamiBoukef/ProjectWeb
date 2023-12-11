<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/views/HomePageView.php');
class AdminHomePageController
{
    public function showHomePage()
    {
        $view = new HomePageView();
        $view->showHomePage();
    }
}