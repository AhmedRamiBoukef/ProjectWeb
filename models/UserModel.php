<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Models/DBModel.php');
class UserModel extends DBModel
{
    public function getUsers() {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT * FROM user";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $this->disconnect($db);
        return $users;
    }
    public function getUserById($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "SELECT * FROM user WHERE UserID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch();
        $this->disconnect($db);
        return $user;
    }
    public function deleteUser($id) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "DELETE FROM user WHERE UserID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $this->disconnect($db);
    }
    public function modifyUser( $id, $username, $FirstName, $LastName, $Email, $DateOfBirth, $Gender ) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "UPDATE user
        SET
            username = :username,
            FirstName = :FirstName,
            LastName = :LastName,
            Email = :Email,
            DateOfBirth = :DateOfBirth,
            Gender = :Gender
        WHERE
            UserID = :id;
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':FirstName', $FirstName);
        $stmt->bindParam(':LastName', $LastName);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':DateOfBirth', $DateOfBirth);
        $stmt->bindParam(':Gender', $Gender);

        $stmt->execute();
        $this->disconnect($db);
    }
    public function toggleUser($id,$IsBlocked) {
        $db = $this->connect($this->host, $this->dbname, $this->username, $this->password);
        $sql = "UPDATE user
        SET
            IsBlocked = :IsBlocked
        WHERE
            UserID = :id;
        ";
        print_r($IsBlocked);
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':IsBlocked', $IsBlocked);
        $stmt->execute();
        $this->disconnect($db);
    }
}    