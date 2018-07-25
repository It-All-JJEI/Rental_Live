<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
					
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    
<title>Add unit</title>
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
   include('protected.php');
   include('dbconfig.php');
  //set all variables to null so that they do not hold valiues from previous entries 
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
    <div class="container py-2 h-100" > 
            <div class="row">
                <div class="mx-auto col-sm-6">
                    <div class="card">
                        <div class="card-header"> 
                            <h4 class="text-center mb-0">Unit Details</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" action="save_unit_in.php" method="post">
                                <div class="text-center justify-content-center"> 
                                    
                                    
                                    <div class="form-group row">

                                        <label class="col-lg-3 col-form-label form-control-label"   for="br">BR.</label>
                                        <div class="col-lg-9"> 
                                           <input  name="br" class="form-control" id="br" rows="" placeholder="Enter the Branch number"  value="<?php echo $br ; ?> " />
                                        </div>
                      
                                    </div>
                                    <div class="form-group row"> 
                    
                                        
                                        <label class="col-lg-3 col-form-label form-control-label"  for="unitNum" >Unit</label>
                                        <div class="col-lg-9">
                                            <input name="unitNum" id="unitNum" class="form-control" placeholder="Enter the Unit number"  value="<?php echo $unitNum ; ?> " />
                                        </div>
                                          
                                     </div>
                
                    <div class="form-group row">      
                        
                            <label class="col-lg-3 col-form-label form-control-label"  for="customer">Customer</label>
                            <div class="col-lg-9">
                            <input name="customer"  class="form-control" id="customer" placeholder="Enter the Customer" value="<?php echo $customer ; ?> " />
                            </div>
                           
                        
                        </div> 
                <div class="form-group row">
                    
                    <div class="form-check form-check-inline offset-lg-2">
                            <label class="form-check-label"  for="clean_tank" >Clean Tank Cert</label>
                            <div class="col-lg-3"> 
                            <input type="checkbox" name="clean_tank" id="clean_tank" class="form-check-inline " placeholder="Clean Tank? " value="<?php echo $clean_tank ; ?> " />
                            </div>
                        
                    </div>
                
                    <div class="form-check form-check-inline">
                        
                                <label class=" form-check-label"  for="check_in_pics" >Check in with pics</label>
                                <div class="col-lg-3"> 
                                    <input type="checkbox" name="check_in_pics" class="form-check-inline " id="check_in_pics" placeholder="Check in with pics " value="<?php echo $check_in_pics ; ?> " />
                                </div>
                </div>
                </div>                     
                <div class="form-group row">                     
                    <div class="form-check form-check-inline offset-lg-3">
                        
                        <label class="form-check-label"  for="quote"  >Quote Sent</label>
                        <div class="col-lg-3">
                         <input type="checkbox" name="quote" class="form-check-input " id="quote" placeholder="Quote?" value="<?php echo $quote ; ?> " />
                        </div>
                       
                    </div>
                 
               
               
                    <div class="form-check form-check-inline">
                        
                               <label class="col-form-label form-control-label"  for="returned" >Returned</label>
                               <div class="col-lg-3">
                               <input type="checkbox" name="eta" class="form-check-inline" id="returned" placeholder="returned" value="<?php echo $returned ; ?> " />
                               </div>
                       
                    </div>
                </div>
               
                
            </div>
			<input name="unitID" id="unitID" type="hidden" value="<?php echo $unitID; ?> "/>
                    <div class="offset-lg-2 text-center"
                    
                    <button class="btn btn-danger" href="unit.php">Cancel</button>  
                    <input type="submit" name="btn_save" class="btn btn-primary col-sm-offset-5 col-sm-push-100" >
                    
                    </div>  
             </form>
            </div>  
        </div>
    </div>
        </div> 
		
            </div> 		   
	
	

</body>		
</html>