<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class GuideModel extends DBModel
{
    public function getGuides($offset, $limit)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT G.*, I.ImageID, I.ImagePath
        FROM guidesetting G 
        JOIN Image I ON G.ImageID = I.ImageID
        ORDER BY G.Date DESC 
        LIMIT :limit OFFSET :offset;
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        $guides = $stmt->fetchAll();
        $this->disconnect($db);
        return $guides;
    }
    public function getNombreGuides()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT COUNT(*) AS NumberOfGuides FROM guidesetting;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $guides = $stmt->fetch();
        $this->disconnect($db);
        return $guides;
    }
    public function getguideByID($id)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT G.*, I.ImageID, I.ImagePath FROM guidesetting G JOIN Image I ON G.ImageID = I.ImageID WHERE G.GuideSettingID = :GuideSettingID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":GuideSettingID", $id);
        $stmt->execute();
        $guide = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect($db);
        return $guide;
    }
}
