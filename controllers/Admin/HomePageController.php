<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/views/Admin/HomePageView.php');
class AdminHomePageController
{
    public function showHomePage()
    {
        $view = new AdminHomePageView();
        $view->showHomePage();
    }
}