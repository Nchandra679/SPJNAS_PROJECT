<?php require_once("../includes/classes/Reviewer.php");?>
<?php require_once("../includes/classes/User.php");?>
<?php require_once("../includes/classes/Manuscript.php");?>
<?php
	session_start();
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
	}
?>

<?php
	$s_id = $_GET['id'];
	$reviewer = new Reviewer();
	$result = $reviewer->get_suggestedreviewer($s_id);
	$pmanu = new Manuscript();
	$password = $pmanu->randomPassword();
	$val;
	$mailing = new mailing();
	
	$user = new User();
	$result_set = $user->Get_UserDetails($result['Email']);
	
	if(is_null($result_set)) 
	{
		$user->add_user($result['Title'], $result['Email'], $result['Degree'], $result['First_Name'], $result['Other_Name'], $result['Last_Name'], $password, " ", " ", " ");
		$result_set = $user->Get_UserDetails($result['Email']);
		$val = $reviewer->add_RREviewer($result['ID'], $result_set['U_ID']);
		
		$mailing->send_newmanu_review($result['Title'], $result['First_Name'], $result['Last_Name'], $result['Email'], $manu_title, $password);
		
	}
	else
	{
		$val = $reviewer->add_RREviewer($result['ID'], $result_set['U_ID']);
		$mailing->send_reviewer($result['Title'], $result['First_Name'], $result['Last_Name'], $result['Email']);
	}
	
	$reviewer->delete_SReviewer($s_id);
	$_SESSION["message"] = 6;
	
	header("location:view_editor.php");
?>


