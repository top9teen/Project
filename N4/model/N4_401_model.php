<?php
class N4_401_model
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
    public $emp_name_1;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get table
    public function getAll()
    {
        $query = "SELECT 
                    jo.*,CONCAT(us.user_name,' ',user_lastname) AS name ,br.*,ac.*
                    FROM tb_joinactivity AS jo
                    LEFT JOIN tb_user AS us ON us.id = jo.jo_userid
                    LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
                    LEFT JOIN tb_activities AS ac ON ac.id = jo.jo_activties
                    WHERE  ac.activities_status = '1' AND jo.jo_statusadmin = '0'
                    ORDER BY  ac.activities_enddate DESC";
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
        jo.*,CONCAT(us.user_name,' ',user_lastname) AS name ,br.*,ac.*
        FROM tb_joinactivity AS jo
        LEFT JOIN tb_user AS us ON us.id = jo.jo_userid
        LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
        LEFT JOIN tb_activities AS ac ON ac.id = jo.jo_activties
        WHERE  ac.activities_status = '1'";

        if (isset($this->req_no)) {
            $query .= " AND ac.activities_name like '%" . $this->req_no . "%' ";
        }

        if (isset($this->emp_name)) {
            $query .= " AND br.br_name like '%" . $this->emp_name . "%' ";
        }

        if (isset($this->emp_name_1)) {
            $query .= "  AND CONCAT(us.user_name,' ',us.user_lastname) like '%" . $this->emp_name_1 . "%' ";
        }

        if (isset($this->dept_name)) {
            $query .= " AND ac.activities_trem like '%" . $this->dept_name . "%' ";
        }

        if (!empty($this->sdate) && !empty($this->edate)) {
            $query .= " AND ac.activities_enddate between '" . $this->sdate . "' AND '" . $this->edate . "'";
        }

        if (isset($this->req_status_list)) {
            $array = str_repeat('?,', count($this->req_status_list) - 1) . '?';
            $query .= " AND  jo.jo_statusadmin IN (" . $array . ") ";
        }

        $query .= " ORDER BY ac.activities_enddate DESC";
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

    public function value()
    {
        $query = "SELECT 
                    jo.*, CONCAT(us.pre_name,' ',us.user_name,' ',us.user_lastname) AS name,
                    br.br_name AS br_name
                    FROM tb_joinactivity AS jo 
                    LEFT JOIN tb_user AS us ON us.id = jo.jo_userid
                    LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
                    WHERE  jo.jo_statusadmin = '0' AND jo.jo_activties =:id
                    ORDER BY  jo.jo_crdate ASC";
// 0 เปิด , 1 ปิด

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
   
    public function updateadmin()
    {
        
        $query = "UPDATE tb_joinactivity SET jo_statusadmin = 'T' WHERE 1 = 1 ";             

        if (isset($this->req_status_list)) {
            $array = str_repeat('?,', count($this->req_status_list) - 1) . '?';
            $query .= " AND  id IN (" . $array . ") ";
        }
        $stmt = $this->conn->prepare($query);

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

        
    public function updateact()
    {    
        $query = "UPDATE tb_activities SET activities_adminstatus = 'A' WHERE id = :id ";           

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
// end class  tb_activities
}
