<?php
class orgChartModel
{
    // database connection and table name
    private $conn;
    private $table_name = "";

        // object properties
        public $id;
        public $dept_code;
        public $dept_name;
        public $parent_code;
        public $parent_name;
        public $pos_code;
        public $pos_name;
        public $emp_code;
        public $emp_name;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getORG()
    {
        $query = "SELECT TOP 10 activities_name, id
         FROM tb_activities WHERE activities_name LIKE '%".$this->dept_name."%'
         Group by activities_name, id
         ORDER BY activities_name";
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        try {
            $stmt->execute();
            return $stmt;

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}
