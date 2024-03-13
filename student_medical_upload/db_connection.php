<?php

class DB
{
    private $conn;
    private $hostname = "127.0.0.1";
    private $dbusername = "root";
    private $dbpaassword = "";
    private $db = "user";   // database eka

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->hostname,
            $this->dbusername,
            $this->dbpaassword,
            $this->db
        ) or die("Connection Error");
    }
    public function getConnection()
    {
        return $this->conn;
    }
}

$db_obj = new DB();
//$conn = $db_obj->getConnection();