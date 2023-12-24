<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/BrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/BrandsPageView.php');


class BrandsPageController
{
    public function showBrandsPage()
    {
        $view = new BrandsPageView();
        $view->showBrandsPage();
    }
    public function showBrandPage($id)
    {
        $view = new BrandPageView();
        $view->showBrandPage($id);
    }
}