<?php

//create variables for the connection==
class Database
{
	private $host = "localhost";
	private $db_name = "Rentals_spreadsheet";
	private $username = "root";
	private $pass= " " ;
	public $conn;


//try to connect to database if not throw exception 
public function dbConnection()
{
	$this->conn = null; 
	
	try{
		$this->conn = new PDO("mysqli:host=" . $this->host . ";dbname=" . 
	    $this->db_name, $this->username, $this->password);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $exception)
	{
		echo "Connection error: " . $exception->getMessage(); 	}
		
		
 }
}
?>