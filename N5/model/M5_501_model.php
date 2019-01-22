<?php
class M5_501_model
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

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // insert  new user
    public function insert()
    {
      // query to insert record
            $query = "INSERT INTO tb_activities (activities_name,activities_location,activities_aspect,activities_timeday,activities_detill,activities_createdate,
            activities_enddate,activities_year,activities_trem,activities_hour,activities_join,activities_total,activities_status,activities_max,activities_timenint,activities_adminstatus)
                    VALUES(?,?,?,?,?,?,?,?,?,?,'0',?,'0','N',?,'N')";

            // prepare query
           $stmt = $this->conn->prepare($query);    
            // bind values
            $stmt->bindParam(1, $this->activities_name);
            $stmt->bindParam(2, $this->activities_location);
            $stmt->bindParam(3, $this->activities_aspect);
            $stmt->bindParam(4, $this->activities_timeday);
            $stmt->bindParam(5, $this->activities_detill);
            $stmt->bindParam(6, $this->activities_createdate);
            $stmt->bindParam(7, $this->activities_enddate);
            $stmt->bindParam(8, $this->activities_year);
            $stmt->bindParam(9, $this->activities_trem);
            $stmt->bindParam(10, $this->activities_hour);
            $stmt->bindParam(11, $this->activities_total);
            $stmt->bindParam(12, $this->activities_timenint);
            // execute query
            if($stmt->execute()){
               
                return $stmt;
            }
            return $stmt;
    }
// end class  tb_activities
}
