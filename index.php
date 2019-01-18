<?php
ob_start();
session_start();
require 'session.php';
require_once 'common.php';
include 'utils/base_function.php';
require_once 'config/database.php';

require_once 'models/activities.php';

 //get database connection
 $database = new Database();
 $db = $database->getConnection();
 // // //prepare object
 $activities = new activities($db);

 $datenew  =  Date('Y-m-d H:i:s');
 $stmt = $activities->getAll();

 $num = $stmt->rowCount();

 if ($num > 0) {

     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

             if ($datenew > $row["activities_enddate"]) {
                 $activities->id = $row["id"];
                 $activities->update();
             }   
     }
 }
 
if($_SESSION["status"] == "1"){
    header("location: /Projected/M0/controller/indexmember.php");
    exit;
}elseif ($_SESSION["status"] == "2") {
    header("location: /Projected/N0/controller/indexadmin.php");
    exit;
}else{
    header("location: /Projected/outsider.php");
    exit;
}