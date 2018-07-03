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
	
	<a href="add_unit.php" title="Add Unit">+add a new Unit</a><br>
	
	<?php
        
	$conn = new PDO('mysql:host=localhost; dbname=rentals_spreadsheet', 'root', '');
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select br,unitNum,moving_date,customer,target_date,delivery_instructions,notes, unitID from rental_item ORDER BY unitID";
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

                    <td><a href="add_unit.php?unitID=' .  $unit['unitID'] .'">Edit</a></td>
                    <td><a href="delete_unit.php?unitID=' . $unit['unitID'] . '" onclick="return confirm(\'Are you sure?\');">
                      Delete</a></td></tr>' ;
        }                 
			
	echo '</tbody></table>';	
            

	$conn = null; 
?>	
</body>
</html>