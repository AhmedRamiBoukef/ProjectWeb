<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/BrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/Admin/BrandModel.php');

class AdminBrandsPageController
{
    public function getBrands()
    {
        $model = new BrandModel();
        return $model->getBrands();
    }
    public function showBrandsPage()
    {
        $view = new BrandPageView();
        $view->showBrandsPage();
    }
}