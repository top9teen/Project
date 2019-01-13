<?php
ob_start();
session_start();
require 'session.php';
require_once 'common.php';
include 'utils/base_function.php';

if( $_SESSION["status"] == "1"){
    header("location: indexmember.php");
    exit;
}else{
    header("location: indexmember.php");
    exit;
}