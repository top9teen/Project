<?php
class Pro_activties_Model
{

    // database connection and table name
    private $conn;
    
    // object properties
    public $user_lastname;
    public $user_password;
    public $user_status;
    public $user_majer;
    public $user_email;
    public $user_name;
    public $user_year;
    public $pre_name;
    public $user_moo;
    public $user_img;
    public $user_tel;
    public $user_id;
    public $branch;
    public $user_date;
    public $id;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function OneAll()
    {
        $query = "SELECT us.*,br.br_name AS branch 
        FROM tb_user AS us
        LEFT JOIN tb_branch AS br ON us.user_majer = br.user_majer
        WHERE id = :id";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $num = $stmt->rowCount();

            if ($num == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // set values to object properties
                $this->user_lastname    = $row['user_lastname'];
                $this->pre_name         = $row['pre_name'];
                $this->user_name        = $row['user_name'];
                $this->user_id          = $row['user_id'];
                $this->user_majer       = $row['user_majer'];
                $this->user_year        = $row['user_year'];
                $this->user_moo         = $row['user_moo'];
                $this->user_tel         = $row['user_tel'];
                $this->user_email       = $row['user_email'];
                $this->user_password    = $row['user_password'];
                $this->user_img         = $row['user_img'];
                $this->user_status      = $row['user_status'];
                $this->branch           = $row['branch'];
                $this->id               = $row['id'];
                $this->branch_id        = $row['user_majer'];

            } else {
                return $stmt;
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // insert  new user
    public function update()
    {
                // query to insert record
                $query = "UPDATE tb_user  SET pre_name = ?, user_name = ?, user_lastname = ?,
                user_id = ? ,user_majer = ?, user_year = ?, user_moo = ?, user_tel = ?,
                user_email = ?, user_password = ?, user_status = '1', user_img = ?,user_date = ?  WHERE id = ? ";
    
                // prepare query
                $stmt = $this->conn->prepare($query);
                // bind values

                $stmt->bindParam(1, $this->pre_name);
                $stmt->bindParam(2, $this->user_name);
                $stmt->bindParam(3, $this->user_lastname);
                $stmt->bindParam(4, $this->user_id);
                $stmt->bindParam(5, $this->user_majer);
                $stmt->bindParam(6, $this->user_year);
                $stmt->bindParam(7, $this->user_moo);
                $stmt->bindParam(8, $this->user_tel);
                $stmt->bindParam(9, $this->user_email);
                $stmt->bindParam(10, $this->user_password);
                $stmt->bindParam(11, $this->user_img);
                $stmt->bindParam(12, $this->user_date);
                $stmt->bindParam(13, $this->id);

                // execute query
                if ($stmt->execute()) {
                    return $stmt;
                }
            
                return $stmt;
        }
    
// end class
}