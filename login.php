<?php
ob_start();
session_start();

require_once 'config/database.php';
require_once 'lib/template.php';

$template = new template();
$template->set_filenames(array(
    'body' => 'login.html')
);

$template->pparse('body');

?>