<?php
  require_once 'lib/template.php';
  require_once 'config/database.php';
  require_once 'models/userModel.php';
  $template = new template();
  $template->set_filenames(array(
    'body' => 'login.html')
  );
  
//get database connection
  $database          = new Database();

  
  $db                = $database->getConnection();
  $model             = new userModel($db);


  if (isset($_POST["search"])) {

    $model->prename =$_POST["pre_name"];
    $model->username = $_POST["user_name"];
    $model->userlastname = $_POST["user_lastname"];
    $model->userid = $_POST["user_id"];
    $model->usermajer = $_POST["user_majer"];
    $model->useryear = $_POST["user_year"];
    $model->usermoo = $_POST["user_moo"];
    $model->usertel = $_POST["user_tel"];
    $model->useremail = $_POST["user_email"];
    $model->userpassword =$_POST["user_password"];

    $model->insert();
}
$template->pparse('body');
?>

    