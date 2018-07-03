<!DOCTYPE html>
<html>
<head>
    <title> saving unit... </title> 
      <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body> 
<a href="unit.php" title="view unit" > View Units </a> 
<br>
<a href="add_unit.php" title="add unit" > Add unit<br></a>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);


//store form values in variable 
$br = $_POST['br'];
   
If(isset($_POST['unitNum'])){
$unitNum = $_POST['unitNum'] ;
    }
$moving_date = $_POST['moving_date'];
$customer = $_POST['customer'];
$target_date = $_POST['target_date'];
$delivery_instructions = $_POST['delivery_instructions'];
$notes = $_POST['notes'];
 //add unit ID in case of editing        
$unitID =$_POST['unitID'];
        
//create flag to track completion status of the form 
$flag = true; 

if(empty($br)){
    echo 'br is required<br />';
    $flag = false; 
}

if(empty($moving_date)){
    echo 'Moving Date is required<br />';
    $flag = false; 
}
if(empty($customer)){
    echo 'Customer is required<br />';
    $flag = false; 
}
if(empty($target_date)){
    echo 'Target Date is required<br />';
    $flag = false; 
}


//save only if the form is complete 
if($flag){
   
    try{
         $conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
    
    
      //IF there is already a entry with the unitID then append that unitID, if no unitID is found then create a new ID. this is how the edit workflow is handled    
    if(empty($unitID)){
        $sql = "UPDATE rental_item SET br=:br,unitNum=:unitNum,moving_date=:moving_date,customer=:customer,target_date=:target_date,delivery_instructions=:delivery_instructions,notes=:notes where unitID=:unitID";
        
       }
    else{
        $sql = "INSERT INTO rental_item (br, unitNum, moving_date, customer, target_date, delivery_instructions, notes) VALUES (:br, :unitNum, :moving_date, :customer, :target_date, :delivery_instructions, :notes)";    
           }
        
 
        //set up an sql command to save new unit
   
    //store sql query inside cmd variable 
    $cmd= $conn->prepare($sql);
    
    //bind named placeholders into variables
    $cmd->bindParam(':br', $br, PDO::PARAM_INT, 50);
    $cmd->bindParam(':unitNum', $unitNum, PDO::PARAM_INT, 10);
    $cmd->bindParam(':moving_date', $moving_date, PDO::PARAM_STR, 8);
    $cmd->bindParam(':customer', $customer, PDO::PARAM_STR, 25);
    $cmd->bindParam(':target_date', $target_date, PDO::PARAM_STR, 8); 
    $cmd->bindParam(':delivery_instructions', $delivery_instructions, PDO::PARAM_STR, 8);
    $cmd->bindParam(':notes', $notes, PDO::PARAM_STR, 8);
   // $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
   
    if(empty($unitID)){
        $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    }
    
    $cmd->execute(); 
    
    echo'<p>Unit saved Succesfully!</p>'; 
    
    
   } catch(Exception $e){
        echo 'Error ' ,$e->getMessage();
    }
    
    $conn = null; 
//    header("refresh:3;url=unit.php"); 
}
else {
    echo 'failed';
}
?>
</body> 

</html>
