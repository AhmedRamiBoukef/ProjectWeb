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
}    