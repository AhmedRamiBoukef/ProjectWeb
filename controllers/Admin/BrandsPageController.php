<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/BrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/VehiculePageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/BrandModel.php');

class AdminBrandsPageController
{
    public function getBrands()
    {
        $model = new BrandModel();
        return $model->getBrands();
    }
    public function getVehiculeInfo($AdminVehiculeid)
    {
        $model = new BrandModel();
        return $model->getVehiculeInfo($AdminVehiculeid);
    }
    public function showBrandsPage()
    {
        $view = new AdminBrandPageView();
        $view->showBrandsPage();
    }
    public function showVehiculePage($AdminVehiculeid)
    {
        $view = new AdminVehiculePageView();
        $view->showVehiculePage($AdminVehiculeid);
    }
}