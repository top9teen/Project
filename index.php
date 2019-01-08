<?php
  ob_start();
  session_start();

  require_once 'lib/template.php';
  $template = new template();
  
  $template->set_filenames(array(
    'body' => 'index.html')
  );

  $template->pparse('body');
