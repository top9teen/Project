<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';
require_once '../../config/database.php';
require_once '../model/report_activitty_Model.php';
include '../../utils/base_function.php';


//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/report_activitty.html')
);

//get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$model = new report_activitty_Model($db);


$response_data = array();

$model->id = $_SESSION["id"];

if (isset($_POST["search"])) {


    $model->year = isNotEmpty($_POST["year"]);
    $model->Semester = isNotEmpty($_POST["Semester"]);
    if( $model->Semester == null ||  $model->Semester == ""){
        $model->Semester = '0';
      
    }
    $stmt = $model->search();

    $rpt_url = RPT_SERVER_ADDRESS;
    $rpt_url = str_replace("{reportUnit}", "/reports/project/page3", $rpt_url);
    $rpt_url = str_replace("{req_no}", isNotEmpty($_POST["req_no"]), $rpt_url);
    $rpt_url = str_replace("{id}", isNotEmpty($_SESSION["id"]), $rpt_url);
    $rpt_url = str_replace("{sdate}", str_replace("-", "/", isNotEmpty($_POST["sdate"])), $rpt_url);
    $rpt_url = str_replace("{edate}", str_replace("-", "/", isNotEmpty($_POST["edate"])), $rpt_url);
    $rpt_url = str_replace("{emp_name}", isNotEmpty($_POST["Semester"]), $rpt_url);
    $rpt_url = str_replace("{dept_name}", isNotEmpty($_POST["year"]), $rpt_url);
    $rpt_url = str_replace("{req_status}","", $rpt_url);

    $template->assign_var("dept_name", isNotEmpty($_POST["dept_name"]));
    $template->assign_var("req_no", isNotEmpty($_POST["req_no"]));
    $template->assign_var("emp_name", isNotEmpty($_POST["emp_name"]));
    $template->assign_var("sdate", isNotEmpty($_POST["sdate"]));
    $template->assign_var("edate", isNotEmpty($_POST["edate"]));

   
    $num = $stmt->rowCount();

    if ($num > 0) {     
        // ชมที่กำหนด
        $Hour = 90;
        // ชม ที่ รวมจาก DB
        $Total = 0;

        $response_data = array();
        $count         = 1;
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row["no"]             = $count;

            $Total      = $Total + $row["activities_hour"];
            $Pername    = $row["pre_name"];
            $Fname      = $row["user_name"];
            $lname      = $row["user_lastname"];
            $Idcard     = $row["user_id"];
            $Majer      = $row["br_name"];
            $user_year  = $row["activities_year"];
            $trem       = $row["activities_trem"];
            $user_moo   = $row["user_moo"];
            // date("Y-m-d H:i", strtotime($model->req_datetime))

            $template->assign_block_vars('request', $row);
            unset($rows);
            $count++;
        }


$sum = $Hour - $Total;
$response_data["Total"]         = $Total; 
$response_data["Hour"]          = $Hour;
$response_data["Sum"]           = $Hour -$Total;
$response_data["Pername"]       = $Pername;
$response_data["Fname"]         = $Fname;
$response_data["lname"]         = $lname;
$response_data["Idcard"]        = $Idcard;
$response_data["Majer"]         = $Majer;
$response_data["user_year"]     = $user_year;
$response_data["user_moo"]      = $user_moo;
$response_data["trem"]          = $trem;
$response_data["display"] = "";
$template->assign_vars($response_data);
        if($sum = 0){

    $template->assign_var("rpt_url", $rpt_url);
        } else{
    
    $template->assign_var("rpt_url", "");
        }

    }else{
    $response_data["display"] = "style=\"display: none\"";
    $template->assign_vars($response_data);
    }
    
} else {
    $response_data["display"] = "style=\"display: none\"";
    $template->assign_var("rpt_url", "");
    $template->assign_vars($response_data);
}
 



$data = array(
    "username" => $_SESSION["username"],
    "type"     => $_SESSION["type"],
    "pre_name" => $_SESSION["pre_name"],
    "user_name" => $_SESSION["user_name"],
    "user_lastname" => $_SESSION["user_lastname"],
    "img" => $_SESSION["img"],
);
$date2 = Date('Y');


$formateDate = $date2+543;

array_push($stack, "apple", "raspberry");



$year = array();

$x=0;
while($x <= 4) {
	array_push($year, $formateDate - $x);
    $x++;
}

foreach ($year as $key => $row) {
    $temp2 = array(
        "key"      => $key,
        "value"    => $row,
        "selected" => "",
    );

    if ($_POST["year"] == $row) {
        $temp2["selected"] = "selected=\"selected\"";
    }
    echo($_POST["year"]);
    $template->assign_block_vars('year', $temp2);
}

$Semester = array(
    "0"  => "เลือก",
    "1" => "1",
    "2" => "2",
);

foreach ($Semester as $key => $row) {
    $temp = array(
        "key"      => $key,
        "value"    => $row,
        "selected" => "",
    );

    if ($_POST["Semester"] == $key) {
        $temp["selected"] = "selected=\"selected\"";
    }
    echo($_POST["Semester"]);
    $template->assign_block_vars('Semester', $temp);
}
$template->assign_vars($data);
$template->pparse('body');
