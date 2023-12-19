<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class VehicleModel extends DBModel
{
    public function getVehicleByID($id)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT N.NewsID, N.Title, N.Content, N.Date, I.ImageID, I.ImagePath FROM News N LEFT JOIN NewsImage NI ON N.NewsID = NI.NewsID LEFT JOIN Image I ON NI.ImageID = I.ImageID WHERE N.NewsID = :NewsID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":NewsID", $id);
        $stmt->execute();
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array(
            'Title' => $news[0]['Title'],
            'Content' => $news[0]['Content'],
            'Date' => $news[0]['Date'],
            'Images' => array_map(function ($item) {
                return $item['ImagePath'];
            }, $news)
        );
        $this->disconnect($db);
        return $result;
    }
}
