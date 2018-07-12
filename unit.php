<!doctype html>
<html>
<head>
    <meta content="text/html;" charset="utf-8" http-equiv="content-type">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css" type="text/css">
	
<meta charset="utf-8">
<title>Unit</title>
</head>
<!-- add login link to a page  -->
<a href="login.php?out=1" class="btn btn-info "> Logout</a>
<body>
	
	
 <!--Start of PHP -->
	<?php

include('user.php');

  
     
      //if the user has the required access level they will be able to view the add unit button ie rentals only 
           if($_SESSION['access'] = 2 ){
        echo '<a href="add_unit.php" class="btn btn-default col-sm-push-100"  title="Add Unit">+add a new Unit</a><br>';
       
        };
  
        
    //Open connection to the database and add error mode
	$conn = new PDO("sqlsrv:Server=SQL-PRD-01; Database=Rentals_Spreadsheet", "sa" , "Truck34sail" ); 
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
                    <td><a href="add_unit.php?unitID=<?= $unit['unitID']?>">Edit</a></td>
                    <td><a href="delete_unit.php?unitID=<?= $unit['unitID']  ?>" onclick="return confirm('Are you sure?')">
                      Delete</a></td>
                    <td><a href="move.php?unitID=<?= $unit['unitID'] ?>" onclick="return confirm('Do you want to Move to Check In?')">Check In </a></td></tr>
               
        </div>      
                   <?php } }                 
			
	echo '</tbody></table>';	
       
        //second table for check in create heading
        
        echo '<h1> Check In </h1>';
        if($_SESSION['access'] =2){
        echo  '<a href="add_unit_in.php" class="btn btn-default col-sm-push-100" title="Add Unit">+add a new Unit</a><br>';
        };
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
		<tr><td><?=$unit['br']?></td>
                    <td><?=$unit['unitNum']?></td>
                    <td><?=$unit['customer']?></td>
                     <td><input type="checkbox" value="yes"<?=$unit['clean_tank']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['check_in_pics']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['quote']==1 ? "checked='checked'" : ""?> disabled></td>
                     <td><input type="checkbox" value="yes"<?=$unit['returned']==1 ? "checked='checked'" : ""?> disabled></td>
                    <td><a href="add_unit_in.php?unitID=<?=$unit['unitID']?>">Edit</a></td>
                    <td><a href="delete_from_in.php?unitID=<?=$unit['unitID']?>" onclick="return confirm('Are you sure?');">
                      Delete</a></td></tr>
      <?php  }   ?>
        
		
	</tbody></table>	
        
	
</body>
</html>