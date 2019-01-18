<?php
session_start();
require_once 'config/database.php';
require_once 'models/userModel.php';
require_once 'models/activities.php';


if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    //get database connection
    $database = new Database();
    $db = $database->getConnection();
    // // //prepare object
    $userModel = new userModel($db);
    $activities = new activities($db);


    $datenew  =  Date('Y-m-d H:i:s');
    $stmt = $activities->getAll();

    $num = $stmt->rowCount();

    if ($num > 0) {

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                if ($datenew > $row["activities_enddate"]) {
                    $activities->id = $row["id"];
                    $activities->update();
                }   
        }
    }


    $userModel->username = $username;
    $userModel->password = $password;

    $userModel->get();

    if (($userModel->id > 0))
    {
        // var_dump($userModel);
        $_SESSION["user_lastname"]  = $userModel->user_lastname;
        $_SESSION["user_name"]      = $userModel->user_name;
        $_SESSION["password"]       = $userModel->user_password;
        $_SESSION["username"]       = $userModel->user_email;
        $_SESSION["pre_name"]       = $userModel->pre_name;
        $_SESSION["status"]         = $userModel->status;
        $_SESSION["img"]            = $userModel->img;
        $_SESSION["img"]            = $userModel->img;
        $_SESSION["id"]             = $userModel->id;
    
        if ($_SESSION["status"] == "1") {
        
            $_SESSION["type"] = "นักศึกษา";
            header("location: /Projected/M0/controller/indexmember.php");
        } elseif ($_SESSION["status"] == "2") {  
            $_SESSION["type"] = "ผู้ดูแลระบบ";
            header("location: /Projected/N0/controller/indexadmin.php");
        }
    }
    else
    {
       echo "<script>alert('ชื่อผู้เข้าใช้หรือรหัสผ่านไม่ถูกต้อง');location.href='login.php?e=mismatch'</script>";
    }


}
?>