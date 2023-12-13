<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class HomePageModel extends DBModel
{
    public function getSocialMedia()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT * FROM contact JOIN Image ON contact.Logo = Image.ImageID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $socialMedia = $stmt->fetchAll();
        $this->disconnect($db);
        return $socialMedia;
    }   
    public function getComparaison()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT C.Vehicle1ID AS VehicleID1, V1.VehiculeName AS VehicleName1, I1.ImagePath AS ImagePath1, C.Vehicle2ID AS VehicleID2, V2.VehiculeName AS VehicleName2, I2.ImagePath AS ImagePath2,C.ComparisonCount FROM Comparison C JOIN VehicleInfo V1 ON C.Vehicle1ID = V1.VehicleID JOIN Image I1 ON V1.ImageID = I1.ImageID JOIN VehicleInfo V2 ON C.Vehicle2ID = V2.VehicleID JOIN Image I2 ON V2.ImageID = I2.ImageID ORDER by C.ComparisonCount Limit 6";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $compareinfo = $stmt->fetchAll();
        $this->disconnect($db);
        return $compareinfo;
    }   
    public function getDiaporama()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT SS.SlideshowSettingID, SS.SlideshowImageURL, I.ImagePath AS SlideshowImagePath, SS.SlideshowLinkURL, SS.Publicite FROM SlideshowSetting SS JOIN Image I ON SS.SlideshowImageURL = I.ImageID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $slides = $stmt->fetchAll();
        $this->disconnect($db);
        return $slides;
    }   
}    