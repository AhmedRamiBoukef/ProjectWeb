<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/HomePageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/HomePageModel.php');
class HomePageController
{
    public function getSocialMedia()
    {
        $model = new HomePageModel();
        return $model->getSocialMedia();
    }
    public function getDiaporama()
    {
        $model = new HomePageModel();
        return $model->getDiaporama();
    }
    public function getComparaison()
    {
        $model = new HomePageModel();
        return $model->getComparaison();
    }
    public function showHomePage()
    {
        $view = new HomePageView();
        $view->showHomePage();
    }
}