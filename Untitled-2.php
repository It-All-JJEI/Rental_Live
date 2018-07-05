<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
			<label for="br" >BR.</label>
		<input name="br" placeholder="Enter the Branch number" required
			   value-"<?php echo $br ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="unitNum" >Unit</label>
		<input name="unitNum" placeholder="Enter the Unit number" required
			   value-"<?php echo $unitNum ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="moving_date" >Moving Date</label>
		<input name="moving_date" placeholder="Enter the Moving Date" required
			   value-"<?php echo $moving_date ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="customer" >Customer</label>
		<input name="customer" placeholder="Enter the Customer" required
			   value-"<?php echo $customer ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="target_date" >Target Date</label>
		<input name="target_date" placeholder="Enter the Target Date" required
			   value-"<?php echo $target_date ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="delivery_instructions" >Delivery Instruction</label>
		<input name="delivery_instructions" placeholder="Enter the Delivery Instructions" 
			   value-"<?php echo $delivery_instructions ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="notes" >Notes</label>
		<input name="br" placeholder="Enter the Branch number" 
			   value-"<?php echo $br ; ?> " />
		</fieldset>
		
		<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
		
		<button>Submit</button>
			   
	</form>
	
	
	
	
	
</body>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</html>