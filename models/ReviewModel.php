<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class ReviewModel extends DBModel
{
    public function getPopularReviews($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT R.Date,R.ReviewID, R.Comment, R.Rating, U.UserName FROM Review R JOIN User U ON R.UserID = U.UserID WHERE R.Status = 'Approved' AND R.VehicleID = :id ORDER BY R.Rating DESC LIMIT 3";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $reviews = $stmt->fetchAll();
        $this->disconnect($db);
        return $reviews;
    }
}    