<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main2.css"> 
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
	
    
	<h1>Unit Details</h1>
        <aside class="form-group">
            <a href="unit.php" title="view Units" > View Units </a> <br> 
        </aside>
        <div class="panel panel-default" > 
            <div class="panel-body">
        <div class="col-lg-8 col-lg-offset-3">
	<form action="save_unit.php" method="post">
         <div class="messages"></div>
            <div class="controls"> 
                <div class="row">
                    <div class="col-md-2">   
                        <fieldset class="form-group">
                            <label  for="br">BR.</label>
                                    <input  name="br" class="form-control" id="br" rows="" placeholder="Enter the Branch number" required value="<?php echo $br ; ?> " />
                                    <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                    
                    <div class="col-md-2">        
                        <fieldset class="form-group">
                                <label for="unitNum" >Unit</label>
                        <input name="unitNum" id="unitNum" class="form-control" placeholder="Enter the Unit number" required value="<?php echo $unitNum ; ?> " />
                                   <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                
                    <div class="col-md-2">
                        <fieldset class="form-group">
                                <label for="OC" >OC</label>
                                <input type="date" name="OC" id="OC" class="form-control" placeholder="Enter the OC" value="<?php echo $OC ; ?> " />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-2">
                        <fieldset class="form-group">
                                <label for="moving_date" >Moving Date</label>
                                <input type="date" name="moving_date" class="form-control" id="moving_date" placeholder="Enter the Moving Date" value="<?php echo $moving_date ; ?> " />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
              
                
                    <div class="col-md-2">      
                        <fieldset class="form-group">
                            <label for="customer">Customer</label>
                            <input name="customer"  class="form-control" id="customer" placeholder="Enter the Customer" value="<?php echo $customer ; ?> " />
                            <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                    <div class="col-md-2">
                        <fieldset class="form-group">
                        <label for="target_date"  >Target Date</label>
                        <input type="date" name="target_date" class="form-control" id="target_date" placeholder="Enter the Target Date" value="<?php echo $target_date ; ?> " />
                        <div class="help-block with-errors"></div>
                        </fieldset> 
                    </div>
                  </div>
                <div class="row">
               
                    <div class="col-md-2">
                        <fieldset class="form-group">
                               <label for="eta" >ETA</label>
                               <input type="date" name="eta" class="form-control" id="eta" placeholder="ETA" value="<?php echo $eta ; ?> " />
                               <div class="help-block with-errors"></div>
                       </fieldset>
                    </div>
                </div>
                <div class="row">
                
                    <div class="col-lg-1">
                        <fieldset class="form-check form-check-inline">
                                <label for="lease" >Lease</label>
                                <input type="checkbox" name="lease" class=" col-md-2 checkbox" id="lease" placeholder="Lease"  value="1" <?php echo $lease ; ?>  />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
              
                
                    <div class="col-md-1">
                         <fieldset class="form-check form-check-inline">
                            <label for="ins">INS</label>
                            <input type="checkbox" name="ins" class="col-md-2 checkbox" id="ins" placeholder="Insurance" value="1" <?php echo $ins; ?>  />
                            <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>   
                    <div class="col-md-1"> 
                        <fieldset class="form-check form-check-inline">
                            <label for="cvor">CVOR</label>
                            <input type="checkbox" name="cvor" class="col-md-2 checkbox" id="cvor" placeholder="CVOR" value="1"<?php echo $cvor; ?>  />
                            <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                
               
                    <div class="col-md-1"> 
                        <fieldset class="form-check form-check-inline">
                                <label for="pymt">Pymt</label>
                                <input type="checkbox" name="pymt" class="col-md-2 checkbox" id="pymt" placeholder="Payment"  value="1"<?php echo $pymt ; ?>  />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                    <div class="col-md-1">
                            <fieldset class="form-check form-check-inline">
                                 <label for="binder" >Binder</label>
                                <input  type="checkbox" name="binder" class="col-md-2 checkbox" id="binder" placeholder="Binder" value="1"<?php echo $binder ; ?>  />
                                <div class="help-block with-errors"></div>
                            </fieldset>
                    </div>
                    <div class="col-md-2">
                            <fieldset class="form-check form-check-inline">
                                    <label  for="check_in">Check Out Sent</label>
                                    <input type="checkbox"  name="check_in" id="check_in" class="col-md-2 checkbox" placeholder="Check out sent"  value="1"<?php echo $check_in ; ?>  />
                                    <div class="help-block with-errors"></div>
                            </fieldset>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-2">
                            <fieldset class="form-check form-check-inline">
                                <label for="check_rec" >Check out Received</label>
                                <input type="checkbox" name="check[]" id="check_rec" placeholder="Check out Received"  class="col-md-2 checkbox" value="1" <?php echo $check_rec ; ?>  />
                                <div class="help-block with-errors"></div>
                            </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                            <fieldset class="form-check form-check-inline">
                                   <label for="training" >Training</label>
                           <input name="training" id="training" placeholder="Training" class="form-control" value="<?php echo $training ; ?> " />
                           <div class="help-block with-errors"></div>
                           </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="form-check form-check-inline">
                                <label for="delivery_instructions" >Delivery Instruction</label>
                                <textarea  name="delivery_instructions" class="form-control" id="delivery_instructions" rows="4" placeholder="Enter the Delivery Instructions" value="<?php echo $delivery_instructions ; ?> " /></textarea>
                        <div class="help-block with-errors"></div>
                        </fieldset>
                    </div> 
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-check form-check-inline">
                                    <label for="notes" >Notes</label>
                                    <textarea  name="notes" class="form-control" id="notes" placeholder="Enter Notes" rows="4" value="<?php echo $notes ; ?> " /></textarea> 
                                    <div class="help-block with-errors">    </div>
                            </fieldset>
                        </div>
                    </div>
               
                </div>  
		<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
              
		<input type="submit" name="btn_save" class="btn btn-primary col-sm-offset-2 col-sm-push-100" >
            </div> 	
            </div> 
        </div>
	</form>
	
</body>		
</html>