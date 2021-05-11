<?php require_once("../includes/classes/Manuscript.php");?>
<?php require_once("../includes/classes/mailing.php");?>

<?php
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
	}
?>

<?php

	if($_GET['id'])
	{
		$id = $_GET['id'];
		$u_id;
		$manuscript = new Manuscript();
		$mailing = new mailing();
		$manuscript->submit_manuscript($id);
		if(isset($_SESSION["IDs"]))
		{
			$u_id = $_SESSION["IDs"];
		}
		
		$result = $manuscript->get_manuscript_author($id);
		$manu_details = $manuscript->get_manuscript_mail($id);
		
		foreach($result as $key)
		{
			$title = $key['Title'];
			$first_name = $key['First_Name'];
			$last_name = $key['Last_Name'];
			$email = $key['Email'];
			$manu_title = $manu_details['Title'];
			
			
			$q = $mailing->send_mail_submit($title, $first_name, $last_name, $email, $manu_title);
		}
		$_SESSION["message"] = 3;
	}
	header("location:view.php");
	
?>