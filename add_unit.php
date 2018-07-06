<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
<title>Untitled Document</title>
</head>

<body>

	
	<?php 
	
	//init variabes 
	$br = null; 
	$unitNum = null; 
        $OC = null; 
	$moving_date = null; 
        $customer = null; 
	$target_date =null; 
	$delivery_instructions = null;
	$notes = null; 
	$unitID = null; 
	$eta = null; 
        $lease = null; 
        $ins = null; 
        $cvor = null; 
        $pymt = null; 
        $binder = null ;
        $check_in = null; 
        $check_rec = null; 
        $training = null; 
                
                
	//check if there is numeric id in query string
	if((!empty($_GET['unitID'])) && (is_numeric($_GET['unitID']))){
		
		//stroe in a variable 
		$unitID = $_GET['unitID'];
		
                $conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
                $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//select all data for the selected unit
		$sql = "SELECT * FROM rental_item where unitID = :unitID"; 
		$cmd = $conn->prepare($sql); 
		$cmd->BindParam(':unitID', $unitID, PDO::PARAM_INT); 
		$cmd->execute(); 
		$units = $cmd->fetchAll(); 
		
		//store each value in a variable for each unti by using a loop 
		foreach($units as $unit){
			$br = $unit['br'];
			$unitNum = $unit['unitNum']; 
                        $OC = $unit['OC'];
			$moving_date = $unit['moving_date']; 
			$customer = $unit['customer']; 
			$target_date = $unit['target_date'];
			$delivery_instructions = $unit['delivery_instructions'];
			$notes = $unit['notes']; 
			$unitID = $unit['unitID'];
                        $eta = $unit['eta'];
                        $lease = $unit['lease']; 
                        $ins = $unit['ins'];
                        $cvor = $unit['cvor'];
                        $pymt = $unit['pymt'];
                        $binder = $unit['binder']; 
                        $check_in = $unit['check_in'];
                        $check_rec = $unit['check_rec']; 
                        $trainig = $unit['training']; 
		}
		
		$conn = null; 
	}
	
	?> 
	<a href="unit.php" title="view Units" > View Units </a> <br> 
	<h1>Unit Details</h1>
        
           
	<form action="save_unit.php" method="post">
		<fieldset>
			<label for="br" class="col-sm-2" >BR.</label>
                        <input  name="br" id="br" placeholder="Enter the Branch number" required
			   value="<?php echo $br ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="unitNum" class="col-sm-2">Unit</label>
		<input name="unitNum" id="unitNum" placeholder="Enter the Unit number" required
			   value="<?php echo $unitNum ; ?> " />
		</fieldset>
		<fieldset>
			<label for="OC" class="col-sm-2">OC</label>
                        <input type="date" name="OC" id="OC" placeholder="Enter the OC" 
			   value="<?php echo $OC ; ?> " />
		</fieldset>
		<fieldset>
			<label for="moving_date" class="col-sm-2">Moving Date</label>
                        <input type="date" name="moving_date" id="moving_date" placeholder="Enter the Moving Date" 
			   value="<?php echo $moving_date ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="customer" class="col-sm-2">Customer</label>
		<input name="customer" id="customer" placeholder="Enter the Customer" 
			   value="<?php echo $customer ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="target_date" class="col-sm-2" >Target Date</label>
		<input type="date" name="target_date"  id="target_date" placeholder="Enter the Target Date"
			   value="<?php echo $target_date ; ?> " />
		</fieldset> 
                 <fieldset>
			<label for="eta" class="col-sm-2">ETA</label>
                        <input type="date" name="eta" id="eta" placeholder="ETA" 
			   value="<?php echo $eta ; ?> " />
		</fieldset>
    
                <fieldset>
			<label for="lease" class="col-sm-2">Lease</label>
		<input type="checkbox" name="check[]" id="lease" placeholder="Lease" 
			   value="<?php echo $lease ; ?> " />
		</fieldset>
                         <fieldset>
			<label for="ins" class="col-sm-2">INS</label>
                        <input type="checkbox" name="check[]" id="ins" placeholder="Insurance" 
			   value="<?php echo $ins; ?> " />
		</fieldset>
            
                <fieldset>
			<label for="cvor" class="col-sm-2">CVOR</label>
		<input type="checkbox" name="check[]" id="cvor" placeholder="CYOR" 
			   value="<?php echo $cvor; ?> " />
		</fieldset>
                <fieldset>
                            <label for="pymt" class="col-sm-2">Pymt</label>
                    <input type="checkbox" name="check[]" id="pymt" placeholder="Payment" 
                               value="<?php echo $pymt ; ?> " />
                    </fieldset>
                <fieldset>
			<label for="binder" class="col-sm-2">Binder</label>
		<input  type="checkbox" name="check[]" id="binder" placeholder="Binder" 
			   value="<?php echo $binder ; ?> " />
		</fieldset>
                <fieldset>
			<label for="check_in" class="col-sm-2">Check Out Sent</label>
		<input type="checkbox"  name="check[]" id="check_in" placeholder="Check out sent" 
			   value="<?php echo $check_in ; ?> " />
		</fieldset>
                <fieldset>
			<label for="check_rec" class="col-sm-2">Check out Received</label>
		<input type="checkbox" name="check[]" id="check_rec" placeholder="Check out Received" 
			   value="<?php echo $check_rec ; ?> " />
		</fieldset>
		 <fieldset>
			<label for="training" class="col-sm-2">Training</label>
		<input name="training" id="training" placeholder="Training" 
			   value="<?php echo $training ; ?> " />
		</fieldset>
		<fieldset>
			<label for="delivery_instructions" class="col-sm-2">Delivery Instruction</label>
		<input   name="delivery_instructions" id="delivery_instructions" placeholder="Enter the Delivery Instructions" 
			   value="<?php echo $delivery_instructions ; ?> " />
		</fieldset>
		
		<fieldset>
			<label for="notes" class="col-sm-2">Notes</label>
                        <input  name="notes" id="notes" placeholder="Enter the Branch number" 
			   value="<?php echo $notes ; ?> " />
		</fieldset>
                
               
		
		<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
              
		<input type="submit" name="btn_save" class="btn btn-primary col-sm-offset-2 col-sm-push-100" >
			   
	</form>
	
</body>		
</html>