<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class ReviewModel extends DBModel
{
    public function getReviews() {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT Review.ReviewID, User.username, VehicleInfo.VehiculeName, Review.Comment, Review.Rating, Review.Status FROM Review JOIN User ON Review.UserID = User.UserID JOIN VehicleInfo ON Review.VehicleID = VehicleInfo.VehicleID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $reviews = $stmt->fetchAll();
        $this->disconnect($db);
        return $reviews;
    }
}    