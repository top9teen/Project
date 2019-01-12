<?php
 ob_start();
 session_start();
require 'session.php';
require_once 'common.php';
require_once 'lib/template.php';
require_once 'config/database.php';
require_once 'models/userModel.php';
include 'utils/base_function.php';

$template = new template();
   
//get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$model = new userModel($db);

$template->set_filenames(array(
    'body' => 'indexmember.html')
);


$stmt = $model->getAll();

$num = $stmt->rowCount();

if ($num > 0) {
      $count = 1;
      $max = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if ($max<=3) {
            $row["no"] = reformatCertificate($max);
          }else{
            $row["no"] = "<td><span style=\"margin-left: 35%;\"> $count </span></td>";
          }
        
          $template->assign_block_vars('request', $row);
          unset($rows);
          $count++;
          $max++;
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