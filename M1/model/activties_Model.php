<?php
class activties_Model
{

    // database connection and table name
    private $conn;
    
    // object properties


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get table
    public function getAll()
    {
        $query = "SELECT * FROM tb_activities WHERE activities_status = '0' AND activities_max ='A' ORDER BY activities_hour DESC,activities_join DESC";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
