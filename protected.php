<?php

//init sess 
session_start(); 

if(!isset($_SESSION['user'])){
    //user is not logged in redirect to login 
    header("Location: login.php");
    die(); 
    
}

if($_SESSION['access'] != 2){
    //user logged in but not admin 
    header("Location: login.php");
    
    die();
} 
header('Location:unit.php');

?> 

