<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class VehicleModel extends DBModel
{
    public function getVehicleByID($id)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT 
                    v.VehicleID,
                    v.VehiculeName,
                    v.Note,
                    v.IndicativePrice,
                    b.BrandName,
                    m.ModelName,
                    m.ModelYear,
                    v.Version,
                    v.Dimensions,
                    v.Capacity,
                    v.Consumption,
                    v.VitesseTYPE,
                    j.ImagePath AS Logo,
                    i.ImagePath AS VehicleImage,
                    p.Acceleration,
                    p.TopSpeed,
                    e.EngineName,
                    e.EngineType,
                    e.Power
                FROM 
                    VehicleInfo v
                JOIN 
                    Model m ON v.ModelID = m.ModelID
                JOIN 
                    Brand b ON m.BrandID = b.BrandID
                LEFT JOIN 
                    Image j ON b.Logo = j.ImageID
                LEFT JOIN 
                    Image i ON v.ImageID = i.ImageID
                LEFT JOIN 
                    Performance p ON v.PerformanceID = p.PerformanceID
                LEFT JOIN 
                    Engine e ON v.EngineID = e.EngineID
                WHERE VehicleID = :VehicleID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":VehicleID", $id);
        $stmt->execute();
        $vehicle = $stmt->fetch();
        $this->disconnect($db);
        return $vehicle;
    }
}
