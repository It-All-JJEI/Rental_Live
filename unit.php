<!doctype html>
<html>
<head>
	<meta content="text/html;" charset="utf-8" http-equiv="content-type">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
	
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	
        <a href="login.php?out=1"> Logout</a>
	<?php
      
 
        if(!isset($_SESSION['access'] )){
        echo '<a href="add_unit.php" title="Add Unit">+add a new Unit</a><br>';
        };
        
      //  include 'protected.php';
        //first table for check ins 
	$conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select br,unitNum,OC,moving_date,customer,target_date,eta,lease,ins,cvor,pymt,binder,check_in,check_rec,training,delivery_instructions,notes, unitID from rental_item ORDER BY unitID";
	$cmd = $conn->prepare($sql);
        $cmd->execute(); 
	$units = $cmd->fetchAll(); 
	
	//start the table and add the heading
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
                                      <th>Move</th> 
					</thead>
					<tbody>';
	
	foreach($units as $unit){ ?> 
		
		<tr><td><?=$unit['br']?></td>
                    <td><?=$unit['unitNum']?></td>
                    <td><?=$unit['OC']?></td>
                    <td><?=$unit['moving_date'] ?></td>
                    <td><?=$unit['customer'] ?></td>
                    <td><?=$unit['target_date'] ?></td>
                    <td><?=$unit['eta'] ?></td>
                    <td><input type="checkbox" value="yes"<?=$unit['lease']==1 ? "checked='checked'" : "" ?>></td>
                    <td><input type="checkbox" "  <?=$unit['ins']==1 ? "checked='checked'" : "" ?>></td>
                    <td><input type="checkbox" value="yes"<?=$unit['cvor']==1 ? "checked='checked'" : ""?>></td>
                    <td><input type="checkbox" value="yes"<?=$unit['pymt']==1 ? "checked='checked'" : "" ?>></td>
                    <td><input type="checkbox" value="yes"<?=$unit['binder']==1 ? "checked='checked'" : ""?>></td>
                    <td><input  type="checkbox" value="yes" <?=$unit['check_in']==1 ? "checked='checked'" : "" ?> /></td>
                    <td><input type="checkbox" value="yes"<?=$unit['check_rec']==1 ? "checked='checked'" : "" ?>></td>
                    <td><?=$unit['training'] ?></td>
		    <td><?=$unit['delivery_instructions'] ?></td>
		    <td><?=$unit['notes'] ?></td>
                    
                             
                    <td><a href="add_unit.php?unitID=<?=   $unit['unitID']?>'">Edit</a></td>
                    <td><a href="delete_unit.php?unitID=' <?= $unit['unitID'] ?> '" onclick="return confirm(\'Are you sure?\');">
                      Delete</a></td>
                    <td><a href="move.php?unitID=' <?= $unit['unitID'] ?> '" onclick="return confirm(\'Do you want to Move to Check In?\');">Move </a></td></tr>
                        
        <?php }                 
			
	echo '</tbody></table>';	
            
         
	 
      
        //second table for check outs 
        
        echo '<h1> Check In </h1>';
        echo  '<a href="add_unit.php?tableNum" title="Add Unit">+add a new Unit</a><br>';
	$sql = "select br,unitNum,moving_date,customer,target_date,delivery_instructions,notes, unitID from rental_in ORDER BY unitID";
	$cmd = $conn->prepare($sql);
        $cmd->execute(); 
	$units = $cmd->fetchAll(); 
	
	//start the table and add the heading
	
	echo '<table class="table table-striped" >
			<thead>
					<th>BR.</th>
					<th>Unit</th>
					<th>Moving Date</th>
					<th>Customer</th>
					<th>Target Date</th>
					<th>Delivery Instructions</th>
					<th>Notes</th>
					<th>Edit</th>
                                        <th>Delete</th>
					
					</thead>
					<tbody>';
	
	foreach($units as $unit){
		
		echo '<tr><td>' . $unit['br'] . '</td>
                    <td>' . $unit['unitNum'] . '</td>
                    <td>' . $unit['moving_date'] . '</td>
                    <td>' . $unit['customer'] . '</td>
                    <td>' . $unit['target_date'] . '</td>
		    <td>' . $unit['delivery_instructions'] . '</td>
		    <td>' . $unit['notes'] . '</td>

                    <td><a href="add_unit.php=' .  $unit['unitID'] .'">Edit</a></td>
                    <td><a href="delete_unit.php?unitID=' . $unit['unitID'] . '" onclick="return confirm(\'Are you sure?\');">
                      Delete</a></td></tr>' ;
        }                 
			
	echo '</tbody></table>';	
        
?>	
</body>
</html>