<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/N4_401_model.php';
include '../../utils/base_function.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/N4_401.html')
);

//get database connection
$database = new Database();
$db = $database->getConnection();


// prepare product object
$model = new N4_401_model($db);

if (isset($_POST["search"])) {

    $model->req_no = isNotEmpty($_POST["req_no"]);
    $model->dept_name = isNotEmpty($_POST["dept_name"]);
    $model->emp_name = isNotEmpty($_POST["emp_name"]);
    $model->emp_name_1 = isNotEmpty($_POST["emp_name_1"]);
    
    $model->sdate = strToDateSdate(isNotEmpty($_POST["sdate"]));
    $model->edate = strToDateEdate(isNotEmpty($_POST["edate"]));
    $model->req_status_list = $_POST["req_status"];
    $stmt = $model->search();

    $filter_req_status = implode(",", $model->req_status_list);

    if (is_array($model->req_status_list)) {
        foreach ($model->req_status_list as $item) {
            if ($item == "0") {
                $template->assign_var("checked_0", "checked=''");
            } elseif ($item == "A") {
                $template->assign_var("checked_1", "checked=''");
            }
        }
    }
    $rpt_url = RPT_SERVER_ADDRESS;
    $rpt_url = str_replace("{reportUnit}", "/reports/project/page4_1_1", $rpt_url);
    $rpt_url = str_replace("{req_no}", isNotEmpty($_POST["req_no"]), $rpt_url);
    $rpt_url = str_replace("{id}", "", $rpt_url);
    $rpt_url = str_replace("{sdate}", str_replace("-", "/", isNotEmpty($_POST["sdate"])), $rpt_url);
    $rpt_url = str_replace("{edate}", str_replace("-", "/", isNotEmpty($_POST["edate"])), $rpt_url);
    $rpt_url = str_replace("{emp_name}", isNotEmpty($_POST["emp_name"]), $rpt_url);
    $rpt_url = str_replace("{dept_name}", isNotEmpty($_POST["dept_name"]), $rpt_url);
    $rpt_url = str_replace("{req_status}", $filter_req_status, $rpt_url);
    $rpt_url = $rpt_url . "&emp_name_1=" .$_POST["emp_name_1"];

    $template->assign_var("dept_name", isNotEmpty($_POST["dept_name"]));
    $template->assign_var("req_no", isNotEmpty($_POST["req_no"]));
    $template->assign_var("emp_name", isNotEmpty($_POST["emp_name"]));
    $template->assign_var("sdate", isNotEmpty($_POST["sdate"]));
    $template->assign_var("edate", isNotEmpty($_POST["edate"]));
    $template->assign_var("emp_name_1", isNotEmpty($_POST["emp_name_1"]));
    $template->assign_var("rpt_url", $rpt_url);

} else {

    $rpt_url = RPT_SERVER_ADDRESS;
    $rpt_url = str_replace("{reportUnit}", "/reports/project/page4_1_1", $rpt_url);
    $rpt_url = str_replace("{req_no}", "",$rpt_url);
    $rpt_url = str_replace("{sdate}", "",$rpt_url);
    $rpt_url = str_replace("{id}", isNotEmpty($_SESSION["id"]), $rpt_url);
    $rpt_url = str_replace("{edate}", "",$rpt_url);
    $rpt_url = str_replace("{emp_name}", "",$rpt_url);
    $rpt_url = str_replace("{dept_name}", "", $rpt_url);
    $rpt_url = str_replace("{req_status}", "0" ,$rpt_url);
    $rpt_url = $rpt_url . "&emp_name_1=" ."";
    $template->assign_var("rpt_url", $rpt_url);
    $template->assign_var("checked_0", "checked='0'");
    $stmt = $model->getAll();
}

$template->assign_var("xlsx_url", str_replace("output=pdf", "output=xlsxNoPag", $rpt_url));

$num = $stmt->rowCount();
if ($num > 0) {
    $response_data = array();
    $count = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row["no"] = $count;
        $row["jo_statusadmin"] = reformatStatus($row["jo_statusadmin"]);
        $row["activities_enddate"] = date("Y-m-d H:i", strtotime($row["activities_enddate"]));
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