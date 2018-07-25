<?php
<<<<<<< Upstream, based on origin/master
ini_set("display_errors",1);
       error_reporting(E_ALL);
=======
 
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
session_start(); 
<<<<<<< Upstream, based on origin/master
=======
include('dbconfig.php');
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
<<<<<<< Upstream, based on origin/master
    $conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
=======
    
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
    //create sql query to run 
    $sql = "DELETE  FROM rental_item where unitID = :unitID;";
            
            
    //prepare sql statment and bind named placeholders to variables 
    $cmd = $conn->prepare($sql);
    $cmd->bindValue(':unitID', $unitID, PDO::PARAM_INT );
    $cmd->execute(); 
    //close connection to database 
    $conn = null;
    //redirect to main page 
    header('location:unit.php');
}
 


