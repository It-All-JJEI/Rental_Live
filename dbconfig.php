<?php

//create variables for the connection==
class Database extends PDO 
{
	private $host = "SQL-PRD-01";
	private $db_name = "Rentals_Spreadsheet";
	private $username = "sa";
	private $pass= "Truck34sail" ;
	public $conn;


//try to connect to database if not throw exception 
public function __construct($conn)
{
	$this->conn = null; 
	
	try{
		$this->conn = new PDO("sqlsrv:Server=" . $this->host . ";Database=" . 
	    $this->db_name, $this->username, $this->pass);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $exception)
	{
		echo "Connection error: " . $exception->getMessage(); 	}
		
		
 }
 

}
?>