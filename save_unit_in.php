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
<a href="add_unit_in.php" title="add unit" > Add unit<br></a>

<?php 
ini_set("display_errors",1);
       error_reporting(E_ALL);

//store form values in variable 
$br = $_POST['br'];
   
If(isset($_POST['unitNum'])){
$unitNum = $_POST['unitNum'] ;
    }
If(isset($_POST['customer'])){
$binder = $_POST['customer'];
}
If(isset($_POST['clean_tank'])){
$check_in = $_POST['clean_tank'];
}
If(isset($_POST['check_in_pics'])){
$check_rec = $_POST['check_in_pics'];
}
If(isset($_POST['quote'])){
$training = $_POST['quote'];
}
If(isset($_POST['returned'])){
$training = $_POST['returned'];
}

 //add unit ID in case of editing        
$unitID =$_POST['unitID'];
 

//create flag to track completion status of the form 
$flag = true; 

if(empty($br)){
    echo 'br is required<br />';
    $flag = false; 
}

if(empty($unitNum)){
    echo 'Unit is required<br />';
    $flag = false; 
}







//save only if the form is complete and flag is true 
if($flag){
   
    try{
        $conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
<<<<<<< Upstream, based on origin/master
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
=======
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
    
    
      //IF there is already a entry with the unitID then append that row, if no unitID is found then create a new ID and row. this is how the edit workflow is handled    
<<<<<<< Upstream, based on origin/master
    if(empty($unitID)){
        $sql = "UPDATE rental_in SET br=:br,unitNum=:unitNum,customer=:customer,clean_tank=:clean_tank,check_in_pics=:check_in_pics,quote=:quote,returned=:returned  where unitID=:unitID";
        
=======
    if($unitID > 0 ){
        $sql = "UPDATE rental_in SET br=:br,unitNum=:unitNum,customer=:customer,clean_tank=:clean_tank,check_in_pics=:check_in_pics,quote=:quote,returned=:returned  where unitID=:unitID"; 
		var_dump($unitID);
			 
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
       }
    else{
         $sql = "INSERT INTO rental_in(br, unitNum, customer, clean_tank,check_in_pics,quote,returned) VALUES (:br, :unitNum, :customer, :clean_tank, :check_in_pics, :quote,:returned)"; 
		 var_dump($unitID); 
          }
        
 
        
   
    //store sql query inside cmd variable 
    $cmd= $conn->prepare($sql);
    
    //bind named placeholders into variables
    $cmd->bindParam(':br', $br, PDO::PARAM_INT);
    $cmd->bindParam(':unitNum', $unitNum, PDO::PARAM_INT);
    $cmd->bindParam(':customer', $customer, PDO::PARAM_STR);
    $cmd->bindParam(':clean_tank', $clean_tank, PDO::PARAM_STR); 
    $cmd->bindParam(':check_in_pics', $check_in_pics, PDO::PARAM_STR);
    $cmd->bindParam(':quote', $quote);
    $cmd->bindParam(':returned', $returned);
    
   
   //bind all paramaters to the variables and save 
<<<<<<< Upstream, based on origin/master
    if(empty($unitID)){
=======
    if($unitID >0){
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
        $cmd->bindParam(':unitID', $unitID, PDO::PARAM_INT);
    }
    //execute query 
    $cmd->execute(); 
    
    echo'<p>Unit saved Succesfully!</p>'; 
    
    
   } catch(Exception $e){
        echo 'Error ' ,$e->getMessage();
    }
    //disconnect and redirect to unit
    $conn = null; 
    header("refresh:1;url=unit.php"); 
}
else {
    echo 'failed';
}

?>
</body> 

</html>
