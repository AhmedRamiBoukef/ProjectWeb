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
                    b.BrandName AS Brand,
                    m.ModelName AS Model,
                    m.ModelYear AS Year,
                    v.Version,
                    v.Dimensions,
                    v.Capacity,
                    v.Consumption,
                    v.VitesseTYPE,
                    j.ImagePath AS Logo,
                    i.ImagePath AS VehicleImage,
                    p.Acceleration,
                    p.TopSpeed,
                    e.EngineName AS Engine,
                    e.EngineType AS Type,
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
    public function AddVehicle($BrandID,$ModelName,$Version,$ModelYear,$IndicativePrice,$EngineName,$EngineType,$Power,$Acceleration,$TopSpeed,$Consumption,$Dimensions,$Capacity,$VitesseTYPE,$VehicleImage)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "INSERT INTO Image (ImagePath) VALUES (:image);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":image", $VehicleImage);
        $stmt->execute();
        $imageID = $db->lastInsertId(); 
        $sql = "INSERT INTO Engine (EngineName, EngineType, Power) VALUES (:EngineName, :EngineType, :Power);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":EngineName", $EngineName);
        $stmt->bindParam(":EngineType", $EngineType);
        $stmt->bindParam(":Power", $Power);
        $stmt->execute();
        $engineID = $db->lastInsertId();
        $sql = "INSERT INTO Performance (Acceleration, TopSpeed) VALUES (:Acceleration, :TopSpeed);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":Acceleration", $Acceleration);
        $stmt->bindParam(":TopSpeed", $TopSpeed);
        $stmt->execute();
        $performanceID = $db->lastInsertId();
        $sql = "INSERT INTO Model (ModelName, ModelYear, BrandID) VALUES (:ModelName, :ModelYear, :BrandID);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":ModelName", $ModelName);
        $stmt->bindParam(":ModelYear", $ModelYear);
        $stmt->bindParam(":BrandID", $BrandID);
        $stmt->execute();
        $ModelID = $db->lastInsertId();
        $sql = "SELECT BrandName FROM Brand WHERE BrandID = :BrandID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":BrandID", $BrandID);
        $stmt->execute();
        $brandName = $stmt->fetch();


        $sql = "INSERT INTO VehicleInfo (VehiculeName, IndicativePrice, ModelID, EngineID, PerformanceID, ImageID, Dimensions, Capacity, Consumption, VitesseTYPE, Version) VALUES (:VehiculeName, :IndicativePrice, :ModelID, :EngineID, :PerformanceID, :ImageID, :Dimensions, :Capacity, :Consumption, :VitesseTYPE, :Version)";
        $stmt = $db->prepare($sql);
        $VehicleName = $brandName['BrandName'] . " " . $ModelName . " " . $Version;
        $stmt->bindParam(':VehiculeName', $VehicleName);
        $stmt->bindParam(':IndicativePrice', $IndicativePrice);
        $stmt->bindParam(':ModelID', $ModelID);
        $stmt->bindParam(':EngineID', $engineID);
        $stmt->bindParam(':PerformanceID', $performanceID);
        $stmt->bindParam(':ImageID', $imageID);
        $stmt->bindParam(':Dimensions', $Dimensions);
        $stmt->bindParam(':Capacity', $Capacity);
        $stmt->bindParam(':Consumption', $Consumption);
        $stmt->bindParam(':VitesseTYPE', $VitesseTYPE);
        $stmt->bindParam(':Version', $Version);
        $stmt->execute();
        $this->disconnect($db);

    }
}
