<?php
  

session_start();

require_once 'user.php';
$session  = new USER(); 

//if user session is not active(logged out) this page will help to redirect to login page

if(!$session->is_loggedin()){
    $session->redirect('index.php'); 
}
