<?php
class report_activitty_Model
{

    // database connection and table name
    private $conn;
    
    // object properties
    public $year;
    public $Semester;
    public $id;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function search()
    {
        $query = "SELECT ac.*,us.*,jo.*,br.*  FROM tb_activities ac 
        LEFT JOIN tb_joinactivity jo ON jo.jo_activties = ac.id
        LEFT JOIN tb_user  us ON us.id = jo. jo_userid
        LEFT JOIN tb_branch  br ON br.user_majer = us.user_majer
        WHERE  jo.jo_statusadmin = '1'";

            if (isset($this->id)) {
                $query = $query . " AND us.id = ".$this->id;
            }
    
            if (isset($this->year)) {
                $query = $query . " AND ac.activities_year = ".$this->year;
            }
    
            if (isset($this->Semester)) {
                $query = $query . " AND ac.activities_trem = ".$this->Semester;
            }

            $query = $query . " ORDER BY ac.activities_enddate desc ";
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    
        try {
            $stmt->execute();
            return $stmt;
            } catch (PDOException $ex) {
            die($ex->getMessage());
            }

    }
// end class
}


