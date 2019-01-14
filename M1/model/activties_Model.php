<?php
class activties_Model
{

    // database connection and table name
    private $conn;
    
    // object properties
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

    // table 2
    public $jo_activties2;
    public $jo_userid;
    public $jo_status;
    public $jo_crdate;
    public $jo_trem;
    public $jo_year;

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
                    WHERE ac.activities_status = '0' AND ac.activities_max ='A' 
                    ORDER BY ac.activities_hour DESC, 
                            ac.activities_join DESC";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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

    // insert
    public function create()
    {
        // query to insert record
        $query = "INSERT INTO tb_joinactivity (jo_activties,jo_userid,jo_status,jo_crdate,jo_trem,jo_year) VALUES(?,?,'1',?,?,?)";

        // prepare query
        $stmt = $this->conn->prepare($query);
       // sanitize
        $this->jo_activties2 = htmlspecialchars(strip_tags($this->jo_activties2));
        $this->jo_userid = htmlspecialchars(strip_tags($this->jo_userid));
        $this->jo_crdate  = htmlspecialchars(strip_tags($this->jo_crdate));
        $this->jo_trem  = htmlspecialchars(strip_tags($this->jo_trem));
        $this->jo_year  = htmlspecialchars(strip_tags($this->jo_crdate));
        // bind values
        $stmt->bindParam(1, $this->jo_activties2);
        $stmt->bindParam(2, $this->jo_userid);
        $stmt->bindParam(3, $this->jo_crdate);
        $stmt->bindParam(4, $this->jo_trem);
        $stmt->bindParam(5, $this->jo_year);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function update()
    {
        $query = "UPDATE tb_activities SET activities_join = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
             

        // bind values
        $stmt->bindParam(1, $this->activities_join);
        $stmt->bindParam(2, $this->jo_activties2);


        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
// end class
}
