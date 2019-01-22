<?php
ob_start();
session_start();
require '../../session.php';
require_once '../../common.php';
require_once '../../lib/template.php';

//prepare template
$template = new template();
$template->set_filenames(array(
    'body' => '../view/N5_501.html')
);

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