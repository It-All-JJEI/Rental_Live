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
  $br = null; 
  $unitNum = null; 
  $customer = null; 
  $clean_tank = null; 
  $check_in_pics = null; 
  $quote = null; 
  $returned = null ;
  $unitID = null;        
          //check if there is numeric id in query string
	if((!empty($_GET['unitID'])) && (is_numeric($_GET['unitID']))){
		
		//stroe in a variable 
		$unitID = $_GET['unitID'];
		
                $conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
                $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//select all data for the selected unit
		$sql = "SELECT * FROM rental_in where unitID = :unitID"; 
		$cmd = $conn->prepare($sql); 
		$cmd->BindParam(':unitID', $unitID, PDO::PARAM_INT); 
		$cmd->execute(); 
		$units = $cmd->fetchAll(); 
		
		//store each value in a variable for each unti by using a loop 
		foreach($units as $unit){
			$br = $unit['br'];
			$unitNum = $unit['unitNum']; 
			$customer = $unit['customer']; 
                        $clean_tank = $unit['clean_tank'];
                        $check_in_pics = $unit['check_in_pics'];
                        $quote = $unit['quote']; 
                        $returned = $unit['returned']; 
                        $unitID = $unit['unitID']    ;    
		}
        } 
		$conn = null; 
  
  ?> 
    
    <h1>Unit Details</h1>
        <aside class="form-group">
            <a href="unit.php" title="view Units" > View Units </a> <br> 
        </aside>
    <div class="panel panel-default" > 
        <div class="panel-body">
        <div class="col-lg-8 col-lg-offset-3">
	<form class="form-simple" action="save_unit_in.php" method="post">
         <div class="messages"></div>
            <div class="controls"> 
                <div class="row">
                    <div class="col-md-2">   
                        <fieldset class="form-group">
                            <label  for="br">BR.</label>
                                    <input  name="br" class="form-control" id="br" rows="" placeholder="Enter the Branch number"  value="<?php echo $br ; ?> " />
                                    <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                    
                    <div class="col-md-2">        
                        <fieldset class="form-group">
                                <label for="unitNum" >Unit</label>
                        <input name="unitNum" id="unitNum" class="form-control" placeholder="Enter the Unit number"  value="<?php echo $unitNum ; ?> " />
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
                <div class="row">
                    </div>
                       <div class="col-md-2">
                        <fieldset class="form-group">
                                <label for="clean_tank" >Clean Tank Cert</label>
                                <input type="checkbox" name="clean_tank" id="clean_tank" class="col-md-2 checkbox" placeholder="Clean Tank? " value="<?php echo $clean_tank ; ?> " />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                
                    <div class="col-md-2">
                        <fieldset class="form-group">
                                <label for="check_in_pics" >Check in with pics</label>
                                <input type="checkbox" name="check_in_pics" class="col-md-2 checkobx" id="check_in_pics" placeholder="Check in with pics " value="<?php echo $check_in_pics ; ?> " />
                                <div class="help-block with-errors"></div>
                        </fieldset>
                    </div>
                    <div class="col-md-2">
                        <fieldset class="form-group">
                        <label for="quote"  >Quote Sent</label>
                        <input type="checkbox" name="quote" class="col-md-2" id="quote" placeholder="Quote?" value="<?php echo $quote ; ?> " />
                        <div class="help-block with-errors"></div>
                        </fieldset> 
                    </div>
                 
               
               
                    <div class="col-md-1">
                        <fieldset class="form-group">
                               <label for="returned" >Returned</label>
                               <input type="checkbox" name="eta" class="col-md-2 checkbox" id="returned" placeholder="returned" value="<?php echo $returned ; ?> " />
                               <div class="help-block with-errors"></div>
                       </fieldset>
                    </div>
                </div>
               
                
            </div>
            </div>  
        </div>
    </div>
        </div> 
		<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
              
		<input type="submit" name="btn_save" class="btn btn-primary col-sm-offset-5 col-sm-push-100" >
            </div> 		   
	</form>
	
</body>		
</html>