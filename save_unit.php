<!DOCTYPE html>
<html>
<head>
    <title> saving unit... </title> 
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

</head>
<body> 
<a href="unit.php" title="view unit" > View Units </a> 
<br>
<a href="add_unit.php" title="add unit" > Add unit<br></a>

<?php 

 session_start();
 include('dbconfig.php');
//include('inputLog.php');

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
    echo 'BR. is a required Field<br />';
    $flag = false; 
}

if(empty($unitNum)){
    echo 'Unit is a required Field <br />';
    $flag = false; 
}




//save only if the form is complete 
if($flag){
   
    try{
 
    
    
      //IF there is already a entry with the unitID then append that unitID, if no unitID is found then create a new ID. this is how the edit workflow is handled    
    if($unitID > 0 ){
        $sql = "UPDATE rental_item SET br=:br,unitNum=:unitNum,OC=:OC,moving_date=:moving_date,customer=:customer,target_date=:target_date,eta=:eta,lease=:lease,ins=:ins,cvor=:cvor,pymt=:pymt,binder=:binder,check_in=:check_in,check_rec=:check_rec,training=:training,delivery_instructions=:delivery_instructions,notes=:notes where unitID=:unitID";
        var_dump($unitID);
		echo'update';
       }
    else{
        $sql = "INSERT INTO rental_item (br, unitNum,OC, moving_date, customer, target_date,eta,lease,ins,cvor,pymt,binder,check_in,check_rec,training, delivery_instructions, notes) VALUES (:br, :unitNum, :OC,:moving_date, :customer, :target_date,:eta,:lease,:ins,:cvor,:pymt,:binder,:check_in,:check_rec,:training, :delivery_instructions, :notes)";    
           var_dump($unitID);
		   echo'insert';
		  }
        
 
        //set up an sql command to save new unit
   
    //store sql query inside cmd variable 
    $cmd= $conn->prepare($sql);
   // writeTOFile($sql);
    //bind named placeholders into variables
    $cmd->bindParam(':br', $br, PDO::PARAM_INT);
    $cmd->bindParam(':unitNum', $unitNum, PDO::PARAM_INT);
    $cmd->bindParam(':OC', $OC, PDO::PARAM_STR);
    $cmd->bindParam(':moving_date', $moving_date, PDO::PARAM_STR);
    $cmd->bindParam(':customer', $customer, PDO::PARAM_STR);
    $cmd->bindParam(':target_date', $target_date, PDO::PARAM_STR); 
    $cmd->bindParam(':eta', $eta, PDO::PARAM_STR);
    $cmd->bindParam(':lease', $lease);
    $cmd->bindParam(':ins', $ins);
    $cmd->bindParam(':cvor', $cvor);
    $cmd->bindParam(':pymt', $pymt);
    $cmd->bindParam(':binder', $binder, PDO::PARAM_STR);
    $cmd->bindParam(':check_in', $check_in, PDO::PARAM_STR);
    $cmd->bindParam(':check_rec', $check_rec, PDO::PARAM_STR);
    $cmd->bindParam(':training', $training, PDO::PARAM_STR);
    $cmd->bindParam(':delivery_instructions', $delivery_instructions, PDO::PARAM_STR);
    $cmd->bindParam(':notes', $notes, PDO::PARAM_STR);   
   
   //bind variable to named place holder ands save inside cmd 
   if($unitID >0){
        $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    }
    //execute query 
    $cmd->execute(); 
    
    echo'<div class="alert alert-success" role="alert"> 
	<h1 class="alert Heading">Success!</h1>
	<p>Unit Saved</p>
	</div>'; 
   
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
