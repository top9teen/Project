<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../../M4/model/Pro_activties_Model.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/pro_activity.html')
);

//get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$model = new Pro_activties_Model($db);

  if (isset($_POST["search"])) {

 
    $model->user_lastname  = $_POST["user_lastname"];
    $model->user_password  = $_POST["user_password"];
    $model->user_majer     = $_POST["user_majer"];
    $model->user_email     = $_POST["user_email"];
    $model->user_name      = $_POST["user_name"];
    $model->user_year      = $_POST["user_year"];
    $model->pre_name       = $_POST["pre_name"];
    $model->user_tel       = $_POST["user_tel"];
    $model->user_id        = $_POST["user_id"];
    $model->user_moo       = $_POST["user_moo"];
    $file_path             = $_POST["file_path"];
    $model->id             = $_SESSION["id"];
    $model->user_img       = $file_path;
    
    if (isset($_FILES['file']) && !empty($_FILES["file"])) {
      
        if(empty($file_path)){
            
            $model->user_img = uploadFile(
                basename($_FILES['file']['name']),
                $_FILES['file']['tmp_name'],
                $_FILES['file']['size']
            );
           
           
        }else{
        editFile(
                basename($_FILES['file']['name']),
                $_FILES['file']['tmp_name'],
                $_FILES['file']['size'],
                $file_path
            );
        
        }
       
    }

   $model->update();

   

   $model->id = $_SESSION["id"];

   $model->OneAll();

   $_SESSION["user_lastname"]  = $model->user_lastname;
   $_SESSION["user_name"]      = $model->user_name;
   $_SESSION["password"]       = $model->user_password;
   $_SESSION["username"]       = $model->user_email;
   $_SESSION["pre_name"]       = $model->pre_name;
   $_SESSION["status"]         = $model->user_status;
   $_SESSION["img"]            = $model->user_img;
   $_SESSION["id"]             = $model->id;
   
   $response_data["user_lastname"]     = $model->user_lastname;
   $response_data["user_password"]     = $model->user_password;
   $response_data["user_status"]       = $model->user_status;
   $response_data["user_majer"]        = $model->user_majer;
   $response_data["user_email"]        = $model->user_email;
   $response_data["user_name"]         = $model->user_name;
   $response_data["user_year"]         = $model->user_year;
   $response_data["pre_name"]          = $model->pre_name;
   $response_data["user_moo"]          = $model->user_moo;
   $response_data["user_img"]          = $model->user_img;
   $response_data["user_tel"]          = $model->user_tel;
   $response_data["user_id"]           = $model->user_id;
   $response_data["branch"]            = $model->branch;
   $response_data["id"]                = $model->id;
   
   $template->assign_vars($response_data);


   $data = array(
    "username" => $_SESSION["username"],
    "type"     => $_SESSION["type"],
    "pre_name" => $_SESSION["pre_name"],
    "user_name" => $_SESSION["user_name"],
    "user_lastname" => $_SESSION["user_lastname"],
    "img" => $_SESSION["img"],

);


}

$template->assign_vars($data);

$template->pparse('body');

function uploadFile($file_name, $file_tmp, $file_size)
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

function editFile($file_name, $file_tmp, $file_size, $file_path)
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
            move_uploaded_file($file_tmp, $file_path);
            return $file_path;
        } else {
            return $errors;
        }
    }
}





    