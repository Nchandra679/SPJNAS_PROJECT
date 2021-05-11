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
	$u_id = $_GET['u_id'];
	$id = $_GET['id'];
	echo $id;
	$data = new Reviewer();
	$sendback = $data->Assign_UserManuscript($u_id, $id);
	$_SESSION["message"] = 5;
	header("location:editor_reviewers.php?id=" . urlencode($id));
?>