<?php
class activties_ModelMe
{

    // database connection and table name
    private $conn;
    
    // object properties
    public $empid;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get table
    public function getAll()
    {
        $query = "SELECT 
                    ac.*,
                    jo.jo_status AS status
                    FROM tb_activities AS ac  
                    LEFT JOIN tb_joinactivity AS jo ON ac.id = jo.jo_activties
                    WHERE jo.jo_userid = :id AND jo.jo_status = '1'
                    ORDER BY ac.activities_hour DESC, 
                    ac.activities_join DESC";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->empid);
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
