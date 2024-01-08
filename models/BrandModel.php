<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class BrandModel extends DBModel
{
    public function getBrands()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT B.BrandID,I.ImagePath, B.BrandName AS Brand FROM Brand B JOIN Image I ON B.Logo = I.ImageID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $brands = $stmt->fetchAll();
        $this->disconnect($db);
        return $brands;
    }
    public function getVehiculeInfo($AdminVehiculeid)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT VI.VehicleID, VI.VehiculeName, VI.ImageID, VI.Note, VI.IndicativePrice, VI.Dimensions, VI.Capacity, VI.Consumption, VI.VitesseTYPE, E.EngineName, E.EngineType, E.Power, P.Acceleration, P.TopSpeed FROM VehicleInfo VI JOIN Model M ON VI.ModelID = M.ModelID JOIN Brand B ON M.BrandID = B.BrandID JOIN Engine E ON VI.EngineID = E.EngineID JOIN Performance P ON VI.PerformanceID = P.PerformanceID where VI.VehicleID = :AdminVehiculeid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':AdminVehiculeid', $AdminVehiculeid);
        $stmt->execute();
        $infos = $stmt->fetchAll();
        $this->disconnect($db);
        return $infos;
    }
    public function getModelsByBrand($brandID)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT ModelID, ModelName, ModelYear FROM Model WHERE BrandID = :BrandID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':BrandID', $brandID);
        $stmt->execute();
        $models = $stmt->fetchAll();
        $this->disconnect($db);
        return $models;
    }
    public function getYearsByModel($modelID)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT ModelID, ModelYear FROM Model WHERE ModelID = :ModelID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ModelID', $modelID);
        $stmt->execute();
        $years = $stmt->fetchAll();
        $this->disconnect($db);
        return $years;
    }
    public function getVersionByModel($modelID)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT VehicleID, Version FROM VehicleInfo WHERE ModelID = :ModelID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ModelID', $modelID);
        $stmt->execute();
        $versions = $stmt->fetchAll();
        $this->disconnect($db);
        return $versions;
    }
    public function getBrandByID($id)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT B.*, I.ImagePath FROM Brand B JOIN Image I ON B.Logo = I.ImageID WHERE B.BrandID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $brand = $stmt->fetch();
        $this->disconnect($db);
        return $brand;
    }
    public function getVehiculesByBrandID($id, $userID)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT
                    VI.VehicleID,
                    VI.VehiculeName,
                    VI.IndicativePrice,
                    M.ModelYear,
                    I.ImagePath,
                    AVG(R.Rating) AS Note,
                    CASE WHEN F.UserID IS NOT NULL THEN 1 ELSE 0 END AS favorite
                FROM
                    VehicleInfo VI
                JOIN Image I ON VI.ImageID = I.ImageID
                JOIN Model M ON VI.ModelID = M.ModelID
                JOIN Brand B ON M.BrandID = B.BrandID
                LEFT JOIN Review R ON VI.VehicleID = R.VehicleID
                LEFT JOIN Favorite F ON VI.VehicleID = F.VehicleID AND F.UserID = :userID
                WHERE
                    B.BrandID = :id
                GROUP BY
                    VI.VehicleID, VI.VehiculeName, VI.IndicativePrice, M.ModelYear, I.ImagePath
                ORDER BY
                    Note DESC;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $vehicules = $stmt->fetchAll();
        $this->disconnect($db);
        return $vehicules;
    }
}
