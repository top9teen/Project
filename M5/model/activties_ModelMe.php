<?php
class activties_ModelMe
{

    // database connection and table name
    private $conn;
    
    // object properties
    public $empid;
    public $activities_createdate;
    public $activities_location;
    public $activities_enddate;
    public $activities_status;
    public $activities_aspect;
    public $activities_detill;
    public $activities_total;
    public $activities_name;
    public $activities_timeday;
    public $activities_timenint;
    public $activities_year;
    public $activities_trem;
    public $activities_hour;
    public $activities_join;
    public $activities_max;
    public $id;

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

    public function OneAll()
    {
        $query = "SELECT * FROM tb_activities WHERE id = :id ";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $num = $stmt->rowCount();

            if ($num == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // set values to object properties
                $this->activities_createdate  = $row['activities_createdate'];
                $this->activities_location    = $row['activities_location'];
                $this->activities_enddate     = $row['activities_enddate'];
                $this->activities_status      = $row['activities_status'];
                $this->activities_aspect      = $row['activities_aspect'];
                $this->activities_detill      = $row['activities_detill'];
                $this->activities_total       = $row['activities_total'];
                $this->activities_name        = $row['activities_name'];
                $this->activities_timeday        = $row['activities_timeday'];
                $this->activities_timenint        = $row['activities_timenint'];
                $this->activities_year        = $row['activities_year'];
                $this->activities_trem        = $row['activities_trem'];
                $this->activities_hour        = $row['activities_hour'];
                $this->activities_join        = $row['activities_join'];
                $this->activities_max         = $row['activities_max'];
                $this->id                     = $row['id'];

            } else {
                return $stmt;
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
