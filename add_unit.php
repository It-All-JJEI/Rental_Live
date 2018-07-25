<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
			<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
			
<title>Untitled Document</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="unit.php">Rentals Monitor</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="unit.php">View Units <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Add Unit
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="add_unit.php">Check Out</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="add_unit_in.php">Check In</a>
          
          
        </div>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <a class="nav-light" href="login.php?out=1">Logout <span class="sr-only">(current)</span></a>
    </form>
  </div>
</nav>	


	
	<?php 
<<<<<<< Upstream, based on origin/master
	
=======
	include('protected.php');
	include('dbconfig.php');
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
	//init variabes and keep them null to not bring over variables from last entery
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
<<<<<<< Upstream, based on origin/master
		
         $conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
=======
	
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
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
	
    <!-- create form for data entry --> 
<<<<<<< Upstream, based on origin/master
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
=======
	 <div class="container py-2" > 
            <div class="row">
                <div class="mx-auto col-sm-8">
                    <div class="card">
                        <div class="card-header"> 
                            <h4 class="text-center mb-0">Unit Details</h4>
>>>>>>> b1499b5 Removed database connnections in all pages and moved to dbconfig.php not committed to git 
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" action="save_unit.php" method="post">
                                <div class="text-center justify-content-center"> 
                                
                                    <div class="form-group row ">
									
                                        <label class="col-lg-2 col-form-label form-control-label"  for="br">BR.</label>
                                        <div class="col-lg-4"> 
                                            <input  name="br" class="form-control" id="br"  placeholder="Enter the Branch number" required value="<?php echo $br ; ?> " />
                                        </div>

                                        
                                    <label class=" col-lg-2 col-form-label form-control-label" for="unitNum" >Unit</label>
                                    <div class="col-lg-4"> 
                                        <input name="unitNum" id="unitNum" class="form-control" placeholder="Enter the Unit number" required value="<?php echo $unitNum ; ?> " />
                                    </div>
                                      </div>
                                    <div class="form-group row "> 
                                        
                                    <label class="col-lg-2 col-form-label form-control-label" for="OC" >OC</label>
                                    <div class="col-lg-4">
                                        <input type="date" name="OC" id="OC" class="form-control" placeholder="Enter the OC" value="<?php echo $OC ; ?> " />      
                                     </div>
                                  
                                      
                                        <label class=" col-lg-2 col-form-label form-control-label  " for="moving_date">Moving Date</label>
                                            <div class="col-lg-4"> 
                                                <input type="date" name="moving_date" class="form-control" id="moving_date" placeholder="Enter the Moving Date" value="<?php echo $moving_date ; ?> " />
                                            </div>
                                        
                                    </div>
                                     
                                    <div class="form-group row">
 
                                        <label class=" col-lg-2 col-form-label form-control-label" for="customer">Customer</label>
                                            <div class="col-lg-4">
                                              <input name="customer"  class="form-control" id="customer" placeholder="Enter the Customer" value="<?php echo $customer ; ?> " />
                                            </div>

                                        
                                        
                                       
                                        <label class=" col-lg-2 col-form-label form-control-label" for="target_date"  >Target Date</label>
                                            <div class="col-lg-4">
                                              <input type="date" name="target_date" class="form-control" id="target_date" placeholder="Enter the Target Date" value="<?php echo $target_date ; ?> " />
                                            </div>
                                      </div>
                                <div class="form-group row">  
                                    
                                        <label class="col-lg-2 col-form-label form-control-label" for="eta" >ETA</label>
                                        <div class="col-lg-4">
                                        <input type="date" name="eta" class="form-control" id="eta" placeholder="ETA" value="<?php echo $eta ; ?> " />
                                        </div>
                                     
                                                
                                        <label class="col-lg-2 col-form-label col-control-label" for="training" >Training</label>
                                        <div  class="col-lg-4">
                                         <input name="training" id="training" placeholder="Training" class="form-control" value="<?php echo $training ; ?> " />
                                        </div>
                                              
                                        </div>
                                <div class="form-group row "> 
                                    
                                     
                                        <div class="offset-lg-1 form-check form-check-inline">
                                                <label class="form-check-label" for="lease" >Lease</label>
                                                <div class="col-lg-3">
                                                    <input type="checkbox" name="lease" class="form-check-input" id="lease" placeholder="Lease"  value="1" <?php echo $lease ; ?>  />
                                                </div>
                                        </div>
                                            
                                        


                                        <div class="form-check form-check-inline">
                                             
                                                 <label class="form-check-label" for="ins">INS</label>
                                                 <div class="col-lg-3"> 
                                                <input type="checkbox" name="ins" class="form-check-input " id="ins" placeholder="Insurance" value="1" <?php echo $ins; ?>  />
                                                </div>
                                         
                                        </div>   
                                        <div class="form-check form-check-inline"> 
                                            
                                                <label class="form-check-label" for="cvor">CVOR</label>
                                                <div class="col-lg-3"> 
                                                <input type="checkbox" name="cvor" class="form-check-input " id="cvor" placeholder="CVOR" value="1"<?php echo $cvor; ?>  />
                                                </div>
                                            
                                        </div>


                                        <div class="form-check form-check-inline"> 
                                           
                                                    <label class="form-check-label" for="pymt">Pymt</label>
                                                    <div class="col-lg-3"> 
                                                    <input type="checkbox" name="pymt" class="form-check-input" id="pymt" placeholder="Payment"  value="1"<?php echo $pymt ; ?>  />
                                                    </div>
                                          
                                        </div>
                                        <div class="form-check form-check-inline">
                                              
                                                     <label class="col-form-label form-control-label"  for="binder" >Binder</label>
                                                     <div class="col-lg-3"> 
                                                    <input  type="checkbox" name="binder" class="form-check-input" id="binder" placeholder="Binder" value="1"<?php echo $binder ; ?>  />
                                                   </div>
                                             
                                        </div>
                                </div>
                                <div class="form-group row"> 
                                        <div class="offset-lg-1 form-check form-check-inline">
                                                
                                                        <label class="col-form-label form-control-label"  for="check_in">Check Out Sent</label>
                                                        <div class="col-lg-3"> 
                                                        <input type="checkbox"  name="check_in" id="check_in" class="form-check-inline" placeholder="Check out sent"  value="1"<?php echo $check_in ; ?>  />
                                                        </div>
                                              
                                        </div>
                                        
                                    
                                        <div class="form-check form-check-inline">
                                                
                                                    <label class=" col-form-label form-control-label"  for="check_rec" >Check out Received</label>
                                                    <div class="col-lg-2">
                                                    <input type="checkbox" name="check_rec" id="check_rec" placeholder="Check out Received"  class="form-check-inline" value="1" <?php echo $check_rec ; ?>  />
                                                    </div>
                                             
                                        </div>
                                  </div>
                                   
                                 <div class="form-group row">
                                        
                                                    <label  class="offset-lg-1 col-form-label form-control-label" for="delivery_instructions" >Delivery Instruction</label>
													<div class="col-lg-10 offset-lg-1"> 
                                                        <textarea  name="delivery_instructions" class=" form-control" id="delivery_instructions" rows="4" placeholder="Enter the Delivery Instructions" value="<?php echo $delivery_instructions ; ?> " /></textarea>
                                                    </div>             
                                 </div>      
                                  
                                <div class="form-group row">
                                            
                                                        <label class=" offset-lg-1 col-form-label form-control-label"  for="notes" >Notes</label>
                                                        <div class="col-lg-10 offset-lg-1">
                                                        <textarea  name="notes" class="form-control" id="notes" placeholder="Enter Notes" rows="4" value="<?php echo $notes ; ?> " /></textarea> 
                                                        </div>
                                 </div>              
                                </div>
								<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
                                <div class="col-lg-11 text-center"> 
                                    
                                    <button class="btn btn-danger" href="unit.php" >Cancel</button>
                                    <input type="submit" name="btn_save" class="btn btn-primary col-lg-2 " >
                                </div>
                                
                            </form>
                            </div>
                        </div>  
                        
                    </div> 	
                    </div> 
         
        </div>

	
</body>		
</html>
