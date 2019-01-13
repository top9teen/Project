<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/activties_Model.php';
include '../../utils/base_function.php';

$template = new template();
   
//get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$model = new activties_Model($db);

$template->set_filenames(array(
    'body' => '../view/activities.html')
);

$stmt = $model->getAll();

$num = $stmt->rowCount();

if ($num > 0) {
      $count = 1;
      $max = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if($row["status"] == null || $row["status"] == "") {
            if ($max<=3) {
                $row["no"] = reformatCertificate($max);
              }else{
                $row["no"] = "<td><span style=\"margin-left: 35%;\"> $count </span></td>";
              }
              $row["activities_createdate"] = date("Y-m-d H:i", strtotime($row["activities_createdate"]));
              $row["activities_enddate"] = date("Y-m-d H:i", strtotime($row["activities_enddate"]));
    
              $template->assign_block_vars('request', $row);
              unset($rows);
              $count++;
              $max++;
        }
        
      }
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