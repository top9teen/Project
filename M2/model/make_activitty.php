<?php
class make_activitty
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
                    ac.*,
                    jo.jo_statusadmin AS adminstatus, jo.jo_status AS status
                    FROM tb_activities AS ac  
                    LEFT JOIN tb_joinactivity AS jo ON ac.id = jo.jo_activties
                    WHERE  jo.jo_userid = :id AND ac.activities_status = '0'
                    ORDER BY  ac.activities_enddate DESC ";
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


    public function search()
    {
        $query = "SELECT
                    ac.activities_name AS activities_name,
                    ac.activities_enddate AS activities_enddate,
                    ac.activities_year AS activities_year,
                    ac.activities_trem AS activities_trem,
                    jo.jo_statusadmin AS adminstatus,
                    ac.activities_join AS activities_join,
                    ac.activities_total AS activities_total,
                    ac.activities_hour  AS activities_hour,
                    ac.activities_enddate AS activities_enddate,
                    jo.jo_status AS status
                    FROM tb_activities AS ac  
                    LEFT JOIN tb_joinactivity AS jo ON ac.id = jo.jo_activties
                    WHERE 1=1 ";

        if (isset($this->req_no)) {
            $query .= " AND ac.activities_name like '%" . $this->req_no . "%' ";
        }

        if (isset($this->id)) {
            $query .= " AND  jo.jo_userid  = " . $this->id;
        }

        if (isset($this->emp_name)) {
            $query .= " AND ac.activities_year like '%" . $this->emp_name . "%' ";
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
// end class
}
