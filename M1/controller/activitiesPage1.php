<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/activties_Model.php';
include '../../utils/base_function.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/activitiesPage1.html')
);

//get database connection
$database = new Database();
$db       = $database->getConnection();

$model             = new activties_Model($db);
$model->id         = isset($_GET['id']) ? $_GET['id'] : $http_response->print_error(400);

$model->OneAll();

$response_data = array();
$response_data["activities_createdate"] = $model->activities_createdate;
$response_data["activities_location"] = $model->activities_location;
$response_data["activities_enddate"] = $model->activities_enddate;
$response_data["activities_status"] = $model->activities_status;
$response_data["activities_aspect"] = $model->activities_aspect;
$response_data["activities_detill"] = $model->activities_detill;
$response_data["activities_total"] = $model->activities_total;
$response_data["activities_name"] = $model->activities_name;
$response_data["activities_timenint"] = $model->activities_timenint;
$response_data["activities_timeday"] = $model->activities_timeday;
$response_data["activities_year"] = $model->activities_year;
$response_data["activities_trem"] = $model->activities_trem;
$response_data["activities_hour"] = $model->activities_hour;
$response_data["activities_join"] = $model->activities_join;
$response_data["activities_max"] = $model->activities_max;
$response_data["id"] = $model->id;


$template->assign_vars($response_data);

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
