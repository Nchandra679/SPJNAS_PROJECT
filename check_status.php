<?php
	require_once("includes/classes/DBConn.php");

	$hint = " ";
	
	$q = $_REQUEST["q"];
	if($q !== "")
	{
		$conn = new DBConn();

		$conn = $conn->connect();
		
		$stmt = $conn->prepare("SELECT Account_Active FROM Users WHERE Email = (:email);");
		$stmt->bindParam(':email', $q);
		$stmt->execute();
		
		while($rows = $stmt->fetch())
		{
			if( $rows['Account_Active'] )
			{
				$hint = " ";
			}
			else
			{
				$hint = "Account has not been activated";
			}
		}
	}
	
	echo $hint;
?>