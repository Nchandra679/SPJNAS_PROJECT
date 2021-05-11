<?php require_once("../includes/classes/Reviewer.php");?>
<?php
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
	}
?>

<?php

	$u_id = $_GET['id'];
	
	$user = new User();
	$user->update_priviledge($u_id);
	
	$_SESSION["message"] = 5;
	
	header('Location: assign_review.php');
?>