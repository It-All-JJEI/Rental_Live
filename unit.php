<!doctype html>
<html>
<head>
    <meta content="text/html;" charset="utf-8" http-equiv="content-type">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css" type="text/css">
	
<meta charset="utf-8">
<title>Unit</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="unit.php">Rentals Monitor</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
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
	
 <!--Start of PHP -->
	<?php
//include('protected.php');
include('user.php');
include('dbconfig.php'); 
      //if the user has the required access level they will be able to view the add unit button ie rentals only 
       
  
        
    //Open connection to the database and add error mode
	
	$sql = "select br,unitNum,OC,moving_date,customer,target_date,eta,lease,ins,cvor,pymt,binder,check_in,check_rec,training,delivery_instructions,notes, unitID from rental_item ORDER BY unitID";
	$cmd = $conn->prepare($sql);
    $cmd->execute(); 
        //fetch all rows from the table and store them inside $units
	$units = $cmd->fetchAll(); 
	
	//start the table and add the heading to the page 
	echo '<h1> Check Out</h1>';
	echo '<table class="table table-striped" >
			<thead>
					<th>BR.</th>
					<th>Unit</th>
                                        <th>OC</th> 
					<th>Moving Date</th>
					<th>Customer</th>
					<th>Target Date</th>
					<th>ETA</th>
					<th>Lease</th>
					<th>Ins.</th>
					<th>cvor</th>
					<th>Pymt</th>
					<th>Binder</th>
					<th>Check Out Sent </th>
					<th>Check out Rec</th> 
					<th>Training</th>
					<th>Delivery Instructions</th>
					<th>Notes</th>
					<th>Edit</th>                                 
					<th>Delete</th>
					<th>Check In</th> 
					</thead>
					</tbody>';
	//loop through $units and pull out individual columns and format them
	foreach($units as $unit){ ?> 
        <div class="scroll"> 
		<tr><td><?=$unit['br']?></td>
                    <td><?=$unit['unitNum']?></td>
                    <td><?=$unit['OC']?></td>
                    <td><?=$unit['moving_date'] ?></td>
                    <td><?=$unit['customer'] ?></td>
                    <td><?=$unit['target_date'] ?></td>
                    <td><?=$unit['eta'] ?></td>
                    <!--Adds a checkbox that is disabled. will referece checked when the column is 1 -->
                    <td><input type="checkbox" value="yes"<?=$unit['lease']==1 ? "checked='checked'" : "" ?> disabled></td>
                    <td><input type="checkbox"  value="yes" <?=$unit['ins']==1 ? "checked='checked'" : "" ?> disabled></td>
                    <td><input type="checkbox" value="yes"<?=$unit['cvor']==1 ? "checked='checked'" : ""?> disabled></td>
                    <td><input type="checkbox" value="yes"<?=$unit['pymt']==1 ? "checked='checked'" : "" ?> disabled></td>
                    <td><input type="checkbox" value="yes"<?=$unit['binder']==1 ? "checked='checked'" : ""?> disabled></td>
                    <td><input  type="checkbox" value="yes" <?=$unit['check_in']==1 ? "checked='checked'" : "" ?> disabled/></td>
                    <td><input type="checkbox" value="yes"<?=$unit['check_rec']==1 ? "checked='checked'" : "" ?> disabled></td>
                    <td><?=$unit['training'] ?></td>
		    <td><?=$unit['delivery_instructions'] ?></td>
		    <td><?=$unit['notes'] ?></td>
                    
                   <?php if(($_SESSION['access'] =2)){ ?> 
                    <!--add in editing buttons for editing deleting and checking in  -->         
                    <td><a class="btn btn-secondary" href="add_unit.php?unitID=<?= $unit['unitID']?>">Edit</a></td>
                    <td><a class="btn btn-secondary" href="delete_unit.php?unitID=<?= $unit['unitID']  ?>" onclick="return confirm('Are you sure?')">
                      Delete</a></td>
                    <td><a class="btn btn-secondary" href="move.php?unitID=<?= $unit['unitID'] ?>" onclick="return confirm('Do you want to Move to Check In?')">Check In </a></td></tr>
               
        </div>      
                   <?php } }                 
			
	echo '</tbody></table>';	
       
        //second table for check in create heading
        
        echo '<h1> Check In </h1>';
       
        //create query for table then prepare the statment inside the connection variable and execute through the cmd variable 
	$sql = "select br,unitNum,customer,clean_tank,check_in_pics,quote,returned ,unitID from rental_in ORDER BY unitID";
	$cmd = $conn->prepare($sql);
        $cmd->execute(); 
	$units = $cmd->fetchAll(); 
	
	//start the table and add the heading
	
	echo '<table class="table table-striped" >
			<thead>
					<th>BR.</th>
					<th>Unit</th>
					
					<th>Customer</th>
					<th>Clean Tank Cert</th>
					<th>Check in With Pics </th>
					<th>Quote Sent </th>
                                        <th>Returned</th> 
					<th>Edit</th>
                                        <th>Delete</th>
					
					</thead>';
	
	foreach($units as $unit){ ?> 
		<!--loop through units and get individual columns --> 
		<div class="scoll"> 
		<tr><td><?=$unit['br']?></td>
                    <td><?=$unit['unitNum']?></td>
                    <td><?=$unit['customer']?></td>
                     <td><input type="checkbox" value="yes"<?=$unit['clean_tank']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['check_in_pics']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['quote']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['returned']==1 ? "checked='checked'" : ""?> disabled></td>
                    <td><a class="btn btn-secondary"  href="add_unit_in.php?unitID=<?=$unit['unitID']?>">Edit</a></td>
                    <td><a class="btn btn-secondary" href="delete_from_in.php?unitID=<?=$unit['unitID']?>" onclick="return confirm('Are you sure?');">
                      Delete</a></td></tr>
		</div >
      <?php  }   ?>
        
		
	</tbody></table>	
        
	
</body>
</html>