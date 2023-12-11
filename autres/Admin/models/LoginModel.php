<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/Admin/Models/DBModel.php');
class LoginModel extends DBModel
{
    public function login($username, $password)
    {
        $db = $this->connect($this->host, $this->dbname, $this->user, $this->password);
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['Password'])) {
            $this->disconnect($dataBase);
            return $user;
        } else {
            $this->disconnect($dataBase);
            return false;
        }
    }
}    