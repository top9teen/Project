<?php
ob_start();
session_start();
require 'session.php';
require_once 'common.php';

require_once 'config/database.php';
require_once 'models/userModel.php';
include 'utils/base_function.php';

   
//get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$model = new userModel($db);

if( $_SESSION["status"] == "1"){
    header("location: indexmember.php");
    exit;
}else{
    header("location: index.php");
    exit;
}