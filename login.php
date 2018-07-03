<?php

//init session 
session_start(); 

include 'user.php';

//check to see if user is logging out 
if(isset($_GET['out'])){
    //destroy session 
    session_unset(); 
    $_SESSIon = array();
     unset($_SESSION['user'], $_SESSION['access']);
     session_destroy();
}

//check to see if login form has been submitted 
if(isset($_POST['userLogin'])){
    //run information through authenticator 
    if(authenticate($_POST['userLogin'], $_POST['userPassword'])){
        //authentication passwd 
        header("Location: protectd.php");
        die();
        
    }else{
        //authentication error 
        $error = 1; 
        
    }
}

//output error to user 
if(isset($error)) echo 'Login failed: Incorrect username, password or rights <br />';

//output logoutsuccess 
if(isset($_GET['out'])) echo "Logout succesful"; 

?> 