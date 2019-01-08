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

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


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
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->status   = $row['status'];

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
            $query = "INSERT INTO tb_user (pre_name,user_name,user_lastname,user_id,user_majer,user_year,user_moo,user_tel,user_email,user_password) VALUES(?,?,?,?,?,?,?,?,?,?)";

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
            // execute query
            if($stmt->execute()){
                return true;
            }
    
            return false;
        }
}
