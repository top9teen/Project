<?php

header('Content-Type: application/json');

require_once '../../config/database.php';
require_once '../../models/userModel.php';
require_once '../../common.php';

//get database connection
  $database          = new Database();

  
  $db                = $database->getConnection();
  $model             = new userModel($db);


  if (isset($_POST["search"])) {


    $model->userlastname  = $_POST["user_lastname"];
    $model->userpassword  =$_POST["user_password"];
    $model->usermajer     = $_POST["user_majer"];
    $model->useremail     = $_POST["user_email"];
    $model->username      = $_POST["user_name"];
    $model->useryear      = $_POST["user_year"];
    $model->prename       = $_POST["pre_name"];
    $model->usertel       = $_POST["user_tel"];
    $model->userid        = $_POST["user_id"];
    $model->usermoo       = $_POST["user_moo"];

    if (isset($_FILES['file']) && !empty($_FILES["file"])) {
    
          $model->img = uploadFile23(
              basename($_FILES['file']['name']),
              $_FILES['file']['tmp_name'],
              $_FILES['file']['size']
          );
  }else{
    $model->img ="../../assets/upload/img/avatar-6.jpeq";
  }
   $model->insert();
    
    header("location:/Projected/login.php");
    exit;
}

function uploadFile23($file_name, $file_tmp, $file_size)
{
    if (isset($file_name) && isset($file_tmp)) {
        $errors   = array();
        $file_ext = strtolower(end(explode('.', $file_name)));

        $expensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }
        
        if (empty($errors) == true) {
           
            $tmppath = "../../assets/upload/img/" . uniqid() . '.' . $file_ext;
           move_uploaded_file($file_tmp, $tmppath);
       
            return $tmppath;
        } else {
            return $errors;
        }
    }
}
