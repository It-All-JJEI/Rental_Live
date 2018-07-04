<?php

session_start(); 

$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
    $conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
    //create sql query to run 
    $sql = "INSERT INTO rental_in (`br`,`unitNum`,`moving_date`,`customer`,`target_date`,`delivery_instructions`,`notes`) 
SELECT `br`,`unitNum`,`moving_date`,`customer`,`target_date`,`delivery_instructions`,`notes` from rental_item
where unitID = :unitID ;
DELETE from rental_item where unitID = :unitID;

"; 

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
    
    $conn = null; 
    header('Location:unit.php');  
    
    
}