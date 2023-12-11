<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/Models/DBModel.php');
class BrandModel extends DBModel
{
    public function getBrands() {
        $db = $this->connect($this->host, $this->dbname, $this->user, $this->password);
        $sql = "SELECT B.BrandID,B.Logo,VI.VehicleID, B.BrandName AS Brand, M.ModelName AS Model, VI.Version, VI.ModelID, M.ModelYear AS Year FROM VehicleInfo VI JOIN Model M ON VI.ModelID = M.ModelID JOIN Brand B ON M.BrandID = B.BrandID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $brands = $stmt->fetchAll();
        $this->disconnect($db);
        return $brands;
    }
}    