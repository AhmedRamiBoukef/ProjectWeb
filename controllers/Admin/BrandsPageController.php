<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/BrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/AddBrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/UpdateBrandPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/BrandDetailsPageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/AddVehiclePageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/Admin/UpdateVehiclePageView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/BrandModel.php');

class AdminBrandsPageController
{
    public function getBrands()
    {
        $model = new BrandModel();
        return $model->getBrands();
    }
    public function getBrandsData()
    {
        $model = new BrandModel();
        return $model->getBrandsData();
    }
    public function getVehiculeInfo($AdminVehiculeid)
    {
        $model = new BrandModel();
        return $model->getVehiculeInfo($AdminVehiculeid);
    }
    public function getVehiculeByID($id)
    {
        $model = new BrandModel();
        return $model->getVehiculeByID($id);
    }
    public function getModelsByBrand($brandID) {
        $model = new BrandModel();
        return $model->getModelsByBrand($brandID);
    }
    public function getYearsByModel($modelID) {
        $model = new BrandModel();
        return $model->getYearsByModel($modelID);
    }
    public function getVersionByModel($modelID) {
        $model = new BrandModel();
        return $model->getVersionByModel($modelID);
    }
    public function AddBrand() {
        $model = new BrandModel();
        if (!empty($_FILES['logo']['name'])) {
            
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/Project/public/images/';
            
            $tempFile = $_FILES['logo']['tmp_name'];
            $targetFile = $targetFolder . $_FILES['logo']['name'];
            if (move_uploaded_file($tempFile, $targetFile)) {
            }
            $model->AddBrand($_POST['Name'],$_POST['CountryOfOrigin'],$_POST['Siegesocial'],$_POST['YearOfEstablishment'],$_FILES['logo']['name']);
        }
        header('Location: /Project/Admin/brands/');
        exit();
    }
    public function UpdateBrand() {
        $model = new BrandModel();
        $imageID = $_POST['ImageID'];
        if (!empty($_FILES['BrandLogo']['name'])) {
            
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/Project/public/images/';
            
            $tempFile = $_FILES['BrandLogo']['tmp_name'];
            $targetFile = $targetFolder . $_FILES['BrandLogo']['name'];
            if (move_uploaded_file($tempFile, $targetFile)) {
                $model->updateImage($imageID,$_FILES['BrandLogo']['name']);
                $imagePath = $targetFolder . $_POST['ImagePath'];

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        $model->UpdateBrand($_POST['BrandID'],$_POST['Name'],$_POST['CountryOfOrigin'],$_POST['Siegesocial'],$_POST['YearOfEstablishment'],$imageID);
        header('Location: /Project/Admin/brands/');
        exit();
    }
    public function AddVehicle() {
        $model = new VehicleModel();
        if (!empty($_FILES['VehicleImage']['name'])) {
            
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/Project/public/images/';
            
            $tempFile = $_FILES['VehicleImage']['tmp_name'];
            $targetFile = $targetFolder . $_FILES['VehicleImage']['name'];
            if (move_uploaded_file($tempFile, $targetFile)) {
            }
            $model->AddVehicle($_POST['BrandID'],$_POST['ModelName'],$_POST['Version'],$_POST['ModelYear'],$_POST['IndicativePrice'],$_POST['EngineName'],$_POST['EnginType'],$_POST['Power'],$_POST['Acceleration'],$_POST['TopSpeed'],$_POST['Consumption'],$_POST['Dimensions'],$_POST['Capacity'],$_POST['VitesseTYPE'],$_FILES['VehicleImage']['name']);
        }
        header('Location: /Project/Admin/brands/details/?id=' . $_POST['BrandID']);
        exit();
    }
    public function showBrandsPage()
    {
        $view = new AdminBrandPageView();
        $view->showBrandsPage();
    }
    public function showAddBrandPage()
    {
        $view = new AdminAddBrandPageView();
        $view->showAddBrandPage();
    }
    public function showUpdateBrandPage($id)
    {
        $view = new AdminUpdateBrandPageView();
        $view->showUpdateBrandPage($id);
    }
    
    public function showBrandDetailsPage($AdminVehiculeid)
    {
        $view = new AdminBrandDetailsPageView();
        $view->showBrandDetailsPage($AdminVehiculeid);
    }
    public function showAddVehiclePage()
    {
        $view = new AdminAddVehiclePageView();
        $view->showAddVehiclePage();
    }
    public function showUpdateVehiclePage($id)
    {
        $view = new AdminUpdateVehiclePageView();
        $view->showUpdateVehiclePage($id);
    }

}