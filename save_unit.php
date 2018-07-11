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
include('inputLog.php');

//store form values in variable 
$br = $_POST['br'];
   
If(isset($_POST['unitNum'])){
$unitNum = $_POST['unitNum'] ;
    }
 if(isset($_POST['OC'])){
     $OC = $_POST['OC'];
 }  
$moving_date = $_POST['moving_date'];

$customer = $_POST['customer'];

$target_date = $_POST['target_date'];

If(isset($_POST['ins'])){
$ins = $_POST['ins'];
}
If(isset($_POST['eta'])){
$eta = $_POST['eta'];
}
If(isset($_POST['lease'])){
$lease = $_POST['lease'] ;
}
If(isset($_POST['ins'])){
$ins = $_POST['ins'];
}
If(isset($_POST['cvor'])){
$cvor = $_POST['cvor'];
}
If(isset($_POST['pymt'])){
$pymt = $_POST['pymt'];
}
If(isset($_POST['binder'])){
$binder = $_POST['binder'];
}
If(isset($_POST['check_in'])){
$check_in = $_POST['check_in'];
}
If(isset($_POST['check_rec'])){
$check_rec = $_POST['check_rec'];
}
If(isset($_POST['training'])){
$training = $_POST['training'];
}
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
        $sql = "UPDATE rental_item SET br=:br,unitNum=:unitNum,OC=:OC,moving_date=:moving_date,customer=:customer,target_date=:target_date,eta=:eta,lease=:lease,ins=:ins,cvor=:cvor,pymt=:pymt,binder=:binder,check_in=:check_in,check_rec=:check_rec,training=:training,delivery_instructions=:delivery_instructions,notes=:notes where unitID=:unitID";
        
       }
    else{
        $sql = "INSERT INTO rental_item (br, unitNum,OC, moving_date, customer, target_date,eta,lease,ins,cvor,pymt,binder,check_in,check_rec,training, delivery_instructions, notes) VALUES (:br, :unitNum, :OC,:moving_date, :customer, :target_date,:eta,:lease,:ins,:cvor,:pymt,:binder,:check_in,:check_rec,:training, :delivery_instructions, :notes)";    
          }
        
 
        //set up an sql command to save new unit
   
    //store sql query inside cmd variable 
    $cmd= $conn->prepare($sql);
    writeTOFile($sql);
    //bind named placeholders into variables
    $cmd->bindParam(':br', $br, PDO::PARAM_INT, 50);
    $cmd->bindParam(':unitNum', $unitNum, PDO::PARAM_INT, 10);
    $cmd->bindParam(':OC', $OC, PDO::PARAM_STR,10);
    $cmd->bindParam(':moving_date', $moving_date, PDO::PARAM_STR, 8);
    $cmd->bindParam(':customer', $customer, PDO::PARAM_STR, 25);
    $cmd->bindParam(':target_date', $target_date, PDO::PARAM_STR, 8); 
    $cmd->bindParam(':eta', $eta, PDO::PARAM_STR, 8);
    $cmd->bindParam(':lease', $lease);
    $cmd->bindParam(':ins', $ins);
    $cmd->bindParam(':cvor', $cvor);
    $cmd->bindParam(':pymt', $pymt);
    $cmd->bindParam(':binder', $binder, PDO::PARAM_STR, 8);
    $cmd->bindParam(':check_in', $check_in, PDO::PARAM_STR, 8);
    $cmd->bindParam(':check_rec', $check_rec, PDO::PARAM_STR, 8);
    $cmd->bindParam(':training', $training, PDO::PARAM_STR, 8 );
    $cmd->bindParam(':delivery_instructions', $delivery_instructions, PDO::PARAM_STR, 8);
    $cmd->bindParam(':notes', $notes, PDO::PARAM_STR, 8);   
   
   
    if(empty($unitID)){
        $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    }
    
    $cmd->execute(); 
    
    echo'<p>Unit saved Succesfully!</p>'; 
    
    
   } catch(Exception $e){
        echo 'Error ' ,$e->getMessage();
    }
    
    $conn = null; 
    header("refresh:1;url=unit.php"); 
}
else {
    echo 'failed';
}

?>
</body> 

</html>
