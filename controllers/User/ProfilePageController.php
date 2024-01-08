<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/ProfilePageView.php');


class ProfilePageController
{
    public function getFavorite()
    {
        $model = new VehicleModel();
        return $model->getFavorite($_SESSION['UserID']);
    }
    public function showProfilePage()
    {
        $view = new ProfilePageView();
        $view->showProfilePage();
    }
}