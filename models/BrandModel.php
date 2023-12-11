<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class BrandModel extends DBModel
{
    public function getBrands() {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT B.BrandID,I.ImagePath, VI.VehicleID, B.BrandName AS Brand, M.ModelName AS Model, VI.Version, VI.ModelID, M.ModelYear AS Year FROM VehicleInfo VI JOIN Model M ON VI.ModelID = M.ModelID JOIN Brand B ON M.BrandID = B.BrandID JOIN Image I ON B.Logo = I.ImageID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $brands = $stmt->fetchAll();
        $this->disconnect($db);
        return $brands;
    }
    public function getVehiculeInfo($AdminVehiculeid) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT VI.VehicleID, VI.VehiculeName, VI.ImageID, VI.Note, VI.IndicativePrice, VI.Dimensions, VI.Capacity, VI.Consumption, VI.VitesseTYPE, E.EngineName, E.EngineType, E.Power, P.Acceleration, P.TopSpeed FROM VehicleInfo VI JOIN Model M ON VI.ModelID = M.ModelID JOIN Brand B ON M.BrandID = B.BrandID JOIN Engine E ON VI.EngineID = E.EngineID JOIN Performance P ON VI.PerformanceID = P.PerformanceID where VI.VehicleID = :AdminVehiculeid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':AdminVehiculeid', $AdminVehiculeid);
        $stmt->execute();
        $infos = $stmt->fetchAll();
        $this->disconnect($db);
        return $infos;
    }
}    