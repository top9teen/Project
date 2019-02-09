<?php
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
    'body' => 'index.html')
);


$stmt = $model->getAll();

$num = $stmt->rowCount();

if ($num > 0) {
      $response_data = array();
      $count = 1;
      $max = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if ($max<=3) {
            $row["no"] = reformatCertificate($max);
          }else{
            $row["no"] = "<td><span style=\"margin-left: 35%;\"> $count </span></td>";
          }
          $row["activities_createdate"] = date("d-m-Y", strtotime($row["activities_createdate"]));
          $row["activities_enddate"] = date("d-m-Y", strtotime($row["activities_enddate"]));

          $template->assign_block_vars('request', $row);
          unset($rows);
          $count++;
          $max++;
      }
  }

  $template->pparse('body');
