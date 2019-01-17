<?php
class userModel
{

    // database connection and table name
    private $conn;
    private $table_name = "";

    // object properties
    public $id;
    public $username;
    public $password;
    public $status;
    
    public $prename;
    public $userlastname;
    public $userid;
    public $usermajer;
    public $useryear;
    public $usermoo;
    public $usertel;
    public $useremail;
    public $userpassword;
    public $img;

    public $user_password;
    public $user_lastname;
    public $user_email;
    public $user_name;
    public $pre_name;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // login 
    public function get()
    {
        $query = "SELECT * FROM tb_user WHERE user_email = :username AND user_password = :password";

           $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);

            try {
                $stmt->execute();
                $num = $stmt->rowCount();
                if ($num == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    // set values to object properties
                    $this->user_password = $row['user_password'];
                    $this->user_lastname = $row['user_lastname'];
                    $this->user_email    = $row['user_email'];
                    $this->user_name     = $row['user_name'];
                    $this->pre_name      = $row['pre_name'];
                    $this->status        = $row['user_status'];
                    $this->img           = $row['user_img'];
                    $this->id            = $row['id'];
                
                } else {
                    return $stmt;
                }
            }
        
         catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    // insert  new user
    public function insert()
    {
            // query to insert record
            $query = "INSERT INTO tb_user (pre_name,user_name,user_lastname,user_id,user_majer,user_year,user_moo,user_tel,user_email,user_password,user_status,user_img) VALUES(?,?,?,?,?,?,?,?,?,?,'1',?)";

            // prepare query
           $stmt = $this->conn->prepare($query);    
            // bind values
            $stmt->bindParam(1, $this->prename);
            $stmt->bindParam(2, $this->username);
            $stmt->bindParam(3, $this->userlastname);
            $stmt->bindParam(4, $this->userid);
            $stmt->bindParam(5, $this->usermajer);
            $stmt->bindParam(6, $this->useryear);
            $stmt->bindParam(7, $this->usermoo);
            $stmt->bindParam(8, $this->usertel);
            $stmt->bindParam(9, $this->useremail);
            $stmt->bindParam(10, $this->userpassword);
            $stmt->bindParam(11, $this->img);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
    }

    public function getAll()
    {
        $query = "SELECT * FROM tb_activities WHERE activities_status = '0' AND activities_max ='N' ORDER BY activities_hour DESC,activities_join DESC";

        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
