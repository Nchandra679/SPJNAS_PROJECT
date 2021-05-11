<?php
	require_once("../includes/classes/DBConn.php");
	session_start();
	
	$conn = new DBConn();
	$conn = $conn->connect();
	$id = $_SESSION["login_id"];
	$date = new DateTime("Pacific/Fiji");
	$date = $date->format('Y-m-d H:i:s');
	$stmt = $conn->prepare("UPDATE LOG_FILE SET Date_logout = :Date_logout WHERE ID = (:ID);");
	$stmt->bindParam(':Date_logout', $date);
	$stmt->bindParam(':ID', $id );
	$stmt->execute();

	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: ../login.php"); // Redirecting To Home Page
	}
	else
	{
		header("Location: ../login.php");
	}
	


?>
