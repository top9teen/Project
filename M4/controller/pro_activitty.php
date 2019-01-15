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

$model->id = $_SESSION["id"];

$model->OneAll();


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
$template->assign_vars($data);

$template->pparse('body');
