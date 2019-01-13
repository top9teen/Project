<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../../M1/model/activties_Model.php';
include_once '../../utils/base_function.php';
include_once '../../utils/http_response.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/activitiesPage1.html')
);

// prepare http_response
$http_response = new http_response();

//get database connection
$database = new Database();
$db       = $database->getConnection();

$model             = new activties_Model($db);
$model->id         = isset($_GET['id']) ? $_GET['id'] : $http_response->print_error(400);

$model->get();
if (isset($model->req_no)) {

    $response_data                  = array();
    $response_data["id"]            = $model->id;
    $response_data["emp_id"]        = $model->emp_id;
    $response_data["emp_name"]      = $model->emp_name;
    $response_data["pos_name"]      = $model->pos_name;
    $response_data["dept_name"]     = $model->dept_name;
    $response_data["req_no"]        = $model->req_no;
    $response_data["req_datetime"]  = reformatDate($model->req_datetime);
    $response_data["document_lang"] = reformatDate($model->document_lang);
    $response_data["amount"] = reformatDate($model->amount);
    $response_data["country_name"] = reformatDate($model->country_name);
    $response_data["startDate"] = reformatDate($model->startDate);
    $response_data["endDate"] = reformatDate($model->endDate);
    $response_data["reason"] = reformatDate($model->reason);
    $response_data["image_base64"] = $model->image_base64;
        
    if (isset($model->image_path)) {
        $str_path = $model->image_path;
    } else {

        $str_path          = generateImage($model->image_base64);
        $model->image_path = $str_path;
        $model->update_image_path();
    }
    $response_data["image_path"] = $str_path;

    $template->assign_vars($response_data);
    $approve_html = "";
    if ($model->req_status == 0 || $model->req_status == 3) {
        $approve_html = '<button id="denied" type="button" data-toggle="modal" data-target="#md-denied" class="btn btn-space btn-secondary">
            <i class="icon icon-left mdi mdi-close"></i> ไม่อนุมัติ</button>
        <button id="approve" type="button" data-toggle="modal" data-target="#md-approve" class="btn btn-space btn-primary">
            <i class="icon icon-left mdi mdi-check-all"></i> อนุมัติ</button>';
    }

    $template->assign_var('approve_html', $approve_html);
}

$data = array(
    "menu_item" => 2,
);

$template->assign_vars($data);
$template->pparse('body');
