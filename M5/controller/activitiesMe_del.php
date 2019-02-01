<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/activties_ModelMe.php';
include '../../utils/base_function.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/activitiesMe.html')
);

//get database connection
$database = new Database();
$db       = $database->getConnection();

$model             = new activties_ModelMe($db);
$model->jo_activties = isset($_GET['id']) ? $_GET['id'] : $http_response->print_error(400);
$model->id =  isset($_GET['id']) ? $_GET['id'] : $http_response->print_error(400);

$model->OneAll();


$model->activities_join2 = $model->activities_join - 1 ;
$model->jo_userid = $_SESSION["id"];

$model->DELETE();

$model->update_max();

$empid = $_SESSION["id"];
$model->empid = $empid;

$stmt = $model->getAll();

$num = $stmt->rowCount();

if ($num > 0) {
      $count = 1;

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if($row["status"] == null || $row["status"] == "") {
      
        } else {

          $row["no"] = $count;
          $row["activities_createdate"] = date("d-m-Y", strtotime($row["activities_createdate"]));
          $row["activities_enddate"] = date("d-m-Y", strtotime($row["activities_enddate"]));
          $row["statusTallo"] = reformatStatusMedical($row["status"]);
          $template->assign_block_vars('request', $row);
          unset($rows);
          $count++;
      
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
