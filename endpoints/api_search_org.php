<?php
header('Content-Type: application/json');
ob_start();
session_start();
require '../session.php';
require_once '../common.php';
require_once '../config/database.php';
require_once '../models/orgChartModel.php';

//get database connection
$database = new Database();
$db = $database->getConnection();

$model = new orgChartModel($db);

// $_POST["query"] = "หน่วย";
$response_data = array();
if (isset($_POST["query"])) {
    $model->dept_name = $_POST["query"];
    $stmt = $model->getORG();
    $num = $stmt->rowCount();
    if ($num > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response_item = array(
                "id" => $row["id"],
                "name" => $row["activities_name"]
            );

            array_push($response_data, $response_item);
        }
    }
}

echo json_encode($response_data, JSON_UNESCAPED_UNICODE);

