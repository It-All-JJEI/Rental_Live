<?php
ini_set("display_errors",1);
       error_reporting(E_ALL);
session_start(); 
include('dbconfig.php'); 
$unitID = $_GET['unitID'];

if(is_numeric($unitID)){
    //connect to database 
<<<<<<< Upstream, based on origin/master
   $conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
=======
 
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
    //this query will insert into rental in and pull data from the rental_item table then delete the unit 
    $sql = " 
	INSERT INTO rental_in (br, unitNum, customer) 
	SELECT br,unitNum,customer from rental_item
	where unitID = :unitID ;"; 

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
	
	$sql = "DELETE from rental_item where unitID = :unitID;" ;
	$cmd = $conn->prepare($sql);
    $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    $cmd->execute(); 
    
    $conn = null; 
    header('Location:unit.php');  
    
    
}
