<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class NewsModel extends DBModel
{
    public function getNews($offset, $limit)
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT N.NewsID, N.Title, I.ImageID, I.ImagePath, N.Content, N.Date
        FROM News N 
        JOIN (
            SELECT NewsID, ImageID 
            FROM NewsImage 
            GROUP BY NewsID 
        ) NI ON N.NewsID = NI.NewsID 
        JOIN Image I ON NI.ImageID = I.ImageID
        ORDER BY N.Date DESC 
        LIMIT :limit OFFSET :offset;
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetchAll();
        $this->disconnect($db);
        return $news;
    }
    public function getNewsByID($id)
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

    public function getNombreNews()
    {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT COUNT(*) AS NumberOfNews FROM News;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $news = $stmt->fetch();
        $this->disconnect($db);
        return $news;
    }
}
