<?php
class activities
{

    // database connection and table name
    private $conn;
    private $table_name = "";

    // object properties
    public $id;
    

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }



    public function getAll()
    {
        $query = "SELECT * FROM tb_activities WHERE activities_status = '0' ";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
   
    public function update()
    {
        $query = "UPDATE tb_activities SET activities_status = '1' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
             
        // bind values
        $stmt->bindParam(1, $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function update_joinactivity()
    {
        $query = "UPDATE tb_joinactivity SET jo_status = '0' WHERE jo_activties = ?";
        $stmt = $this->conn->prepare($query);
             
        // bind values
        $stmt->bindParam(1, $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    // end class 
}
