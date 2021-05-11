<?php

    class DBConn
    {
		
		public function connect()
		{
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "SPJNAS";
			
			try 
			{
				$conn = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
				
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				return $conn;

			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}	
		}
	}
?>