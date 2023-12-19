<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class CompareModel extends DBModel
{
    public function getCompare($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT v.VehicleID, i.ImagePath, v.VehiculeName, b.BrandName, m.ModelName, m.ModelYear, v.Version, v.Note, v.Dimensions, e.Power, p.Acceleration, p.TopSpeed, v.VitesseTYPE, v.Consumption, v.Capacity, v.IndicativePrice FROM VehicleInfo v JOIN Model m ON v.ModelID = m.ModelID JOIN Brand b ON m.BrandID = b.BrandID JOIN Engine e ON v.EngineID = e.EngineID JOIN Performance p ON v.PerformanceID = p.PerformanceID LEFT JOIN Image i ON v.ImageID = i.ImageID WHERE v.VehicleID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $vehicule = $stmt->fetch();
        $this->disconnect($db);
        return $vehicule;
    }
    
}    