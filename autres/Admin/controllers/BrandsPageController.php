<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/views/BrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/Models/BrandModel.php');

class BrandsPageController
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