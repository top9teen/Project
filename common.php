<?php
$host                      = "http://localhost/Projected";
$host_jasper_service       = "http://localhost:8080";
$host_jasper_username      = "jasperadmin";
$host_jasper_password      = "jasperadmin";

error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_cache_expire(360);

$pdf_report_address = $host_jasper_service . "/jasperserver/flow.html?j_username=" . $host_jasper_username . "&j_password=" .$host_jasper_password . "&_flowId=viewReportFlow&reportUnit={reportUnit}&decorate=no&output=pdf&req_no={req_no}&sdate={sdate}&edate={edate}&id={id}&emp_name={emp_name}&dept_name={dept_name}&req_status={req_status}";
$excel_report_address = $host_jasper_service . "/jasperserver/flow.html?j_username=" . $host_jasper_username . "&j_password=" .$host_jasper_password . "&_flowId=viewReportFlow&reportUnit={reportUnit}&decorate=no&output=xlsxNoPag&req_no={req_no}&sdate={sdate}&edate={edate}&id={id}&dept_name={dept_name}&emp_name={emp_name}&req_status={req_status}";
define("RPT_SERVER_ADDRESS", $pdf_report_address);
define("XLS_SERVER_ADDRESS", $excel_report_address);
define("UPLOAD_PATH", __DIR__ . "assets/upload/");

