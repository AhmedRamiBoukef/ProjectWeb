<?php
class DBModel
{
    protected $host = 'localhost';
    protected $dbname = 'ProjectTDW';
    protected $user = 'root';
    protected $password = '';
    protected function connect( $host, $dbname, $user, $password ) {
        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        } catch (PDOException $e) {
            echo "Database Connection Failed: " . $e->getMessage();
            exit;
        }
        return $db;
    }
    protected function query($db, $query)
    {
        return $db->query($query);
    }
    protected function disconnect(&$db)
    {
        $db = null;
    }
}