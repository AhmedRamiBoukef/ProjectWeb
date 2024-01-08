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
                    e.Power,
                    CASE WHEN f.VehicleID IS NOT NULL THEN 1 ELSE 0 END AS favorite
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
                LEFT JOIN 
                    Favorite f ON v.VehicleID = f.VehicleID AND f.UserID = :userID
                WHERE 
                    v.VehicleID = :VehicleID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":VehicleID", $id);
        $stmt->bindParam(":userID", $_SESSION['UserID']);
        $stmt->execute();
        $vehicle = $stmt->fetch();
        $this->disconnect($db);
        return $vehicle;
    }
    public function getFavorite($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT
                    VI.VehicleID,
                    VI.VehiculeName,
                    VI.IndicativePrice,
                    M.ModelYear,
                    I.ImagePath,
                    AVG(R.Rating) AS Note,
                    1 AS favorite
                FROM
                    Favorite F
                JOIN User U ON F.UserID = U.UserID
                JOIN VehicleInfo VI ON F.VehicleID = VI.VehicleID
                JOIN Model M ON VI.ModelID = M.ModelID
                JOIN Image I ON VI.ImageID = I.ImageID
                LEFT JOIN Review R ON VI.VehicleID = R.VehicleID
                WHERE
                    U.UserID = :userID
                GROUP BY
                    VI.VehicleID, VI.VehiculeName, VI.IndicativePrice, M.ModelYear, I.ImagePath;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":userID", $id);
        $stmt->execute();
        $vehicle = $stmt->fetchAll();
        $this->disconnect($db);
        return $vehicle;
    }
}
