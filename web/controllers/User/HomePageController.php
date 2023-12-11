<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/HomePageView.php');
class HomePageController
{
    public function showHomePage()
    {
        $view = new HomePageView();
        $view->showHomePage();
    }
}