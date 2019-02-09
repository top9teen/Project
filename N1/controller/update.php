<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require '../../session.php';
require_once '../../common.php';
require_once '../../config/database.php';
require_once '../../N1/model/N1_101_Model.php';

//Make sure that it is a POST request.
if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
    die('Request method must be POST!');
}

//get database connection
$database = new Database();
$db = $database->getConnection();

// Get Model
$model = new N1_101_Model($db);

// get posted data
$input = file_get_contents('php://input');

$data = json_decode($input);


// make sure data is not empty
if (
    !empty($data->id) &&
    !empty($data->activities_name) &&
    !empty($data->activities_location) &&
    !empty($data->activities_timeday) &&
    !empty($data->activities_timenint) &&
    !empty($data->activities_hour) &&
    !empty($data->activities_detill) &&
    !empty($data->activities_aspect) &&
    !empty($data->activities_year) &&
    !empty($data->activities_trem) &&
    !empty($data->activities_enddate)
  ) {

    // Defined result var
    $result = [];

    $model->id                       = $data->id;
    $model->activities_name          = $data->activities_name;
    $model->activities_location      = $data->activities_location;
    $model->activities_timeday       = $data->activities_timeday;
    $model->activities_timenint      = $data->activities_timenint;
    $model->activities_hour          = $data->activities_hour;
    $model->activities_detill        = $data->activities_detill;
    $model->activities_aspect        = $data->activities_aspect;
    $model->activities_year          = $data->activities_year;
    $model->activities_trem          = $data->activities_trem;

    $var = $data->activities_enddate;
    $date = str_replace('/', '-', $var);
    $newDate = date('Y-m-d H:i:s', strtotime($date));
    $model->activities_enddate   =   $newDate;

    $model->update_activities();
    $resp["result"] = true;

} else {
    $resp["result"] = false;
}
 echo json_encode($resp);
