<?php
class N1_101_Model
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

    public $req_no;
    public $dept_name;
    public $emp_name;
    public $sdate;
    public $edate;
    public $req_status_list;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get table
    public function getAll()
    {
        $query = "SELECT 
                    *
                    FROM tb_activities 
                    WHERE  activities_max = 'N'
                    ORDER BY  activities_enddate DESC";
// 0 เปิด , 1 ปิด

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    public function search()
    {
        $query = "SELECT 
        * 
        FROM tb_activities WHERE 1 = 1";

        if (isset($this->req_no)) {
            $query .= " AND activities_name like '%" . $this->req_no . "%' ";
        }

        if (isset($this->emp_name)) {
            $query .= " AND activities_year like '%" . $this->emp_name . "%' ";
        }

        if (isset($this->dept_name)) {
            $query .= " AND activities_trem like '%" . $this->dept_name . "%' ";
        }

        if (isset($this->req_status_list)) {
            $array = str_repeat('?,', count($this->req_status_list) - 1) . '?';
            $query .= " AND  activities_max IN (" . $array . ") ";
        }

        $query .= " ORDER BY activities_enddate DESC";
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    
        try {
            if (isset($this->req_status_list)) {
                $stmt->execute($this->req_status_list);
            } else {
                $stmt->execute();
            }

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
                $this->activities_timeday     = $row['activities_timeday'];
                $this->activities_timenint    = $row['activities_timenint'];
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

    public function value()
    {
        $query = "SELECT 
                    jo.*, CONCAT(us.pre_name,' ',us.user_name,' ',us.user_lastname) AS name,
                    br.br_name AS br_name
                    FROM tb_joinactivity AS jo 
                    LEFT JOIN tb_user AS us ON us.id = jo.jo_userid
                    LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
                    WHERE jo.jo_activties =:id
                    ORDER BY  jo.jo_crdate ASC";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function update_activities()
    {

        // query to update record
          $query = "UPDATE tb_activities SET activities_trem = ?,activities_name = ?,activities_location = ?, activities_timeday = ?, activities_timenint = ?, 
                    activities_hour = ?, activities_detill = ?, activities_aspect = ?, activities_year = ?,activities_enddate = ?
                    WHERE id = ? ";
          // prepare query
         $stmt = $this->conn->prepare($query);
  
          // sanitize
          $this->id=htmlspecialchars(strip_tags($this->id));
          $this->activities_name=htmlspecialchars(strip_tags($this->activities_name));
          $this->activities_location=htmlspecialchars(strip_tags($this->activities_location));
          $this->activities_timeday=htmlspecialchars(strip_tags($this->activities_timeday));
          $this->activities_timenint=htmlspecialchars(strip_tags($this->activities_timenint));
          $this->activities_hour=htmlspecialchars(strip_tags($this->activities_hour));
          $this->activities_detill=htmlspecialchars(strip_tags($this->activities_detill));
          $this->activities_aspect=htmlspecialchars(strip_tags($this->activities_aspect));
          $this->activities_year=htmlspecialchars(strip_tags($this->activities_year));
          $this->activities_trem=htmlspecialchars(strip_tags($this->activities_trem));
          $this->activities_enddate=htmlspecialchars(strip_tags($this->activities_enddate));
        
          // bind values
          $stmt->bindParam(1, $this->activities_trem);
          $stmt->bindParam(2, $this->activities_name);
          $stmt->bindParam(3, $this->activities_location);
          $stmt->bindParam(4, $this->activities_timeday);
          $stmt->bindParam(5, $this->activities_timenint);
          $stmt->bindParam(6, $this->activities_hour);
          $stmt->bindParam(7, $this->activities_detill);
          $stmt->bindParam(8, $this->activities_aspect);
          $stmt->bindParam(9, $this->activities_year);
          $stmt->bindParam(10, $this->activities_enddate);
          $stmt->bindParam(11, $this->id);
  
          // execute query
          if($stmt->execute()){
              return true;
          }
  
          return false;
    }
   
// end class
}
