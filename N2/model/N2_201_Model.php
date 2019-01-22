<?php
class N2_201_Model
{

    // database connection and table name
    private $conn;
    
    // object properties

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
                    us.*,
                    br.br_name AS br_name
                    FROM tb_user AS us  
                    LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
                    WHERE  us.user_status = '1' AND us.user_year = '1'
                    ORDER BY  us.user_date DESC ";
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
        us.*,
        br.br_name AS br_name
        FROM tb_user AS us  
        LEFT JOIN tb_branch AS br ON br.user_majer = us.user_majer
        WHERE  us.user_status = '1' ";

        if (isset($this->req_no)) {
            $query .= " AND CONCAT(us.user_name,' ',us.user_lastname) like '%" . $this->req_no . "%' ";
        }

        if (isset($this->emp_name)) {
            $query .= " AND us.user_id like '%" . $this->emp_name . "%' ";
        }

        if (isset($this->dept_name)) {
            $query .= " AND  br.br_name like '%" . $this->dept_name . "%' ";
        }

        if (!empty($this->sdate) && !empty($this->edate)) {
            $query .= " AND us.user_date between '" . $this->sdate . "' AND '" . $this->edate . "'";
        }

        if (isset($this->req_status_list)) {
            $array = str_repeat('?,', count($this->req_status_list) - 1) . '?';
            $query .= " AND  us.user_year IN (" . $array . ") ";
        }

        $query .= " ORDER BY  us.user_date DESC";
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
