<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/N3_301_Model.php';
include '../../utils/base_function.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/N3_301.html')
);

//get database connection
$database = new Database();
$db = $database->getConnection();


// prepare product object
$model = new N3_301_Model($db);

if (isset($_POST["search"])) {

    $model->req_status_list = isNotEmpty($_POST["req_status"]);
  
    // update people
    $model->updateadmin();

    $model->id  = $_POST["id"];
 
    // up date  work
    $model->updateact();
    
    $stmt = $model->getAll();
} else {

    $stmt = $model->getAll();
}
$rpt_url = RPT_SERVER_ADDRESS;
$rpt_url = str_replace("{reportUnit}", "/reports/project/page4_2", $rpt_url);
$rpt_url = str_replace("{req_no}", "",$rpt_url);
$rpt_url = str_replace("{id}", isNotEmpty($_SESSION["id"]), $rpt_url);
$rpt_url = str_replace("{emp_name}", "",$rpt_url);
$rpt_url = str_replace("{dept_name}", "", $rpt_url);
$rpt_url = str_replace("{req_status}", "N" ,$rpt_url);

$template->assign_var("rpt_url", $rpt_url);
$template->assign_var("checked_0", "checked='N'");

$num = $stmt->rowCount();
if ($num > 0) {
    $response_data = array();
    $count = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row["no"] = $count;
        $row["activities_adminstatus"] = reformatStatusBenefits($row["activities_adminstatus"]);
        $row["activities_enddate"] = date("d-m-Y", strtotime($row["activities_enddate"]));
        $template->assign_block_vars('request', $row);
        unset($rows);
        $count++;
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