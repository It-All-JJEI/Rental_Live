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
	
	<a href="file:///C|/Users/LoneStar/Desktop/Rentals/save_unit.php" title="Add Unit">+add a new Unit</a><br>
	
	
	<?php
	
$conn = new PDO('mysql:host=localhost;dbname=rentals', 'root', '');
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from units ORDER BY bookTitle";
	$cmd = $conn->prepare($sql);
	$units = $cmd->fetchAll(); 
	
	//start the table and add the heading
	
	echo '<table >
			<thead>
					<th>BR.</th>
					<th>Unit</th>
					<th>Moving Date</th>
					<th>Customer</th>
					<th>Target Date</th>
					<th>Delivery Instructions</th>
					<th>Notes</th>
					
					
					</thead>
					<tbody>';
	
	foreach($units as $unit){
		
			echo '<tr><td>' . $unit['BR'] . '</td>
			 <tr><td>' . $unit['Unit'] . '</td>
			 <tr><td>' . $unit['MovingDate'] . '</td>
			 <tr><td>' . $unit['Customer'] . '</td>
			 <tr><td>' . $unit['TargetDate'] . '</td>
		     <tr><td>' . $unit['DeliveryInstructions'] . '</td>
		     <tr><td>' . $unit['Notes'] . '</td>'
				;
			
	echo '</tbody></table>';
		
		
	}
	                
	
	
	$conn = null; 
	
	
	
	
	
	?>
	
	
	
</body>
</html>