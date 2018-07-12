<?php
ini_set("display_errors",1);
       error_reporting(E_ALL);
session_start(); 
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
    $conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //create sql query to run 
    $sql = "DELETE  FROM rental_in where unitID = :unitID;";
            
            
    //prepare sql statment and bind named placeholders to variables 
    $cmd = $conn->prepare($sql);
    $cmd->bindValue(':unitID', $unitID, PDO::PARAM_INT );
    $cmd->execute(); 
    //close connection to database 
    $conn = null;
    //redirect to main page 
    header('location:unit.php');
}
 