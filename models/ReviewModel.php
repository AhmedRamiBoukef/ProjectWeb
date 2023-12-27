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
    public function getReviews() {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT R.ReviewID, U.IsBlocked, U.username, U.UserID, V.VehicleID, V.VehiculeName, R.Comment, R.Rating, R.Status FROM Review R JOIN User U ON R.UserID = U.UserID JOIN VehicleInfo V ON R.VehicleID = V.VehicleID";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $reviews = $stmt->fetchAll();
        $this->disconnect($db);
        return $reviews;
    }
    public function updateReview($reviewID, $newStatus) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "UPDATE Review SET Status = :newStatus WHERE ReviewID = :reviewID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reviewID", $reviewID);
        $stmt->bindParam(":newStatus", $newStatus);
        $stmt->execute();
        $this->disconnect($db);
    }
    public function deleteReview($reviewID) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "DELETE FROM Review WHERE ReviewID = :reviewID;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reviewID", $reviewID);
        $stmt->execute();
        $this->disconnect($db);
    }
    public function getVehicleReviews($id, $page = 1, $pageSize = 5) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);        
        $offset = ($page - 1) * $pageSize;
    
        $sql = "SELECT R.Date, R.ReviewID, R.Comment, R.Rating, U.UserName 
                FROM Review R 
                JOIN User U ON R.UserID = U.UserID 
                WHERE R.Status = 'Approved' AND R.VehicleID = :id 
                ORDER BY R.Date DESC
                LIMIT :pageSize OFFSET :offset";
    
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        $reviews = $stmt->fetchAll();
        $this->disconnect($db);
    
        return $reviews;
    }
    public function getNombreReviewsByID($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
    
        $sql = "SELECT VehicleID, COUNT(ReviewID) AS NombreReviews FROM Review WHERE Status = 'Approved' AND VehicleID = :id GROUP BY VehicleID";
    
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
        $reviews = $stmt->fetch();
        $this->disconnect($db);
    
        return $reviews['NombreReviews'];
    }
    
}    