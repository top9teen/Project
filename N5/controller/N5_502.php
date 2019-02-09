<?php
ob_start();
session_start();

require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';

require_once '../model/M5_501_model.php';
include '../../utils/base_function.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/N5_501.html')
);
//get database connection
  $database          = new Database();

  
  $db                = $database->getConnection();
  $model             = new M5_501_model($db);


  if (isset($_POST["search"])) {


    $model->activities_name  = $_POST["activities_name"];
    $model->activities_location  = $_POST["activities_location"];
    $model->activities_aspect     = $_POST["activities_aspect"];
    $model->activities_timeday     = $_POST["activities_timeday"]." - ". $_POST["activities_timeday2"];
    $model->activities_detill      = $_POST["activities_detill"];
    $model->activities_year       = $_POST["activities_year"];
    $model->activities_trem        = $_POST["activities_trem"];
    $model->activities_hour       = $_POST["activities_hour"];

    $model->activities_total       = $_POST["activities_total"];
    $model->activities_timenint       = $_POST["activities_timenint"]." - ".$_POST["activities_timenint2"];

    $model->activities_createdate     = Date('Y-m-d H:i:s');

    $var = $_POST["activities_enddate"];
    $date = str_replace('/', '-', $var);
    $newDate = date('Y-m-d H:i:s', strtotime($date));
    $model->activities_enddate  =   $newDate;
    $model->insert();
    
}   

$data = array(
    "username" => $_SESSION["username"],
    "type"     => $_SESSION["type"],
    "pre_name" => $_SESSION["pre_name"],
    "user_name" => $_SESSION["user_name"],
    "user_lastname" => $_SESSION["user_lastname"],
    "img" => $_SESSION["img"],

);

$template->assign_vars($data);
$template->pparse('body');
