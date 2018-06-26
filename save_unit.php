<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="file:///C|/Users/LoneStar/Desktop/Rentals/css/main2.css">
<title>Untitled Document</title>
</head>

<body>

	
	<?php 
	require_once("dbconfig.php");
	//init variabes 
	$br = null; 
	$unitNum = null; 
	$moving_date = null; 
    $customer = null; 
	$target_date =null; 
	$delivery_instructions = null;
	$notes = null; 
	$unitID = null; 
	
	//check if there is numeric id in query string
	if((!empty($_GET['unitID'])) && (is_numeric($_GET['unitID']))){
		
		//stroe in a variable 
		$unitID = $_GET['untiID'];
		
		//select all data for the selected unit
		$sql = "SELECT * FROM units where unitID = :unitID"; 
		$cmd = $conn->prepare($sql); 
		$cmd->BindParam(':unitID', $unitID, PDO::PARAM_INT); 
		$cmd->execute(); 
		$units = $cmd->fetchAll(); 
		
		//store each value in a variable for each unti by using a loop 
		foreach($units as $unit){
			$br = $unit['BR'];
			$unitNum = $unit['Unit']; 
			$moving_date = $unit['MovingDate']; 
			$customer = $unit['Customer']; 
			$target_date = $unit['TargetDate'];
			$delivery_instructions = $unit['DeliveryInstructions'];
			$notes = $unit['Notes']; 
			$unitID = $unit['UnitID'];
		}
		
		$conn = null; 
	}
	
	?> 
	
	<h1>Unit Details</h1>
	
	<form action"Unit-View.php" method="post">
		<fieldset>
			<label for="br" class="col-sm-2" >BR.</label>
		<input name="br" id="br" placeholder="Enter the Branch number" required
			   value-"<?php echo $br ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="unitNum" class="col-sm-2">Unit</label>
		<input name="unitNum" id="unitNum" placeholder="Enter the Unit number" required
			   value-"<?php echo $unitNum ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="moving_date" class="col-sm-2">Moving Date</label>
		<input name="moving_date" id="moving_date" placeholder="Enter the Moving Date" required
			   value-"<?php echo $moving_date ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="customer" class="col-sm-2">Customer</label>
		<input name="customer" id="customer" placeholder="Enter the Customer" required
			   value-"<?php echo $customer ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="target_date" class="col-sm-2" >Target Date</label>
		<input name="target_date"  id="target_date" placeholder="Enter the Target Date" required
			   value-"<?php echo $target_date ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="delivery_instructions" class="col-sm-2">Delivery Instruction</label>
		<input name="delivery_instructions" id="delivery_instructions" placeholder="Enter the Delivery Instructions" 
			   value-"<?php echo $delivery_instructions ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="notes" class="col-sm-2">Notes</label>
		<input name="notes" id="notes" placeholder="Enter the Branch number" 
			   value-"<?php echo $br ; ?> " />
		</fieldset>
		
		<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
		
		<button class="btn btn-primary col-sm-offset-2 col-sm-push-100">Submit</button>
			   
	</form>
	
	
	
	
	
</body>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</html>