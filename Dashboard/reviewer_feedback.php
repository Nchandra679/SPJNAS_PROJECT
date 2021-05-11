<?php require_once("../includes/classes/Reviewer.php");?>
<?php require_once("../includes/classes/User.php");?>
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
	if(isset($_POST['submit']))
	{
		if(isset($_SESSION['IDs']))
		{
			$u_id = $_SESSION['IDs'];
			$id = $_POST['id'];
			$decision = $_POST['decision'];
			$comments = $_POST['Comments'];
			$original = $_POST['original'];
			$justify = $_POST['Justify'];
			$credit = $_POST['Credit'];
			$title = $_POST['STitle'];
			$clear = $_POST['Clear'];
			$shorten = $_POST['Shorten'];
			$references = $_POST['References'];
			$illustrations = $_POST['Illustrations'];
			$figures = $_POST['Figures'];
			
			$review_submission = new Reviewer();
			$data = $review_submission->submit_Review($id, $decision, $comments, $original, $justify, 
			$credit, $title, $clear, $shorten, $references, $illustrations, $figures, $u_id);
			
			$_SESSION["message"] = 2;
			
			header("location: view_reviewer.php");
		}
	}

	if(isset($_POST['register_reviewer']))
	{
		$title = $_POST['myList'];
		$f_name = $_POST['userf_name'];
		$o_name = $_POST['usero_name'];
		$l_name = $_POST['userl_name'];
		$degree = $_POST['degree'];
		$email = $_POST['Email'];
		$a_o_s = $_POST['Area_o_Specilzation'];
		$access = "Reviewer";
		
		$manu = new Manuscript();
		$password = $manu->randomPassword();
		$newuser = new User();
		$newuser->add_user($title, $email, $degree, $f_name, $o_name, $l_name, $password, $access, $a_o_s, "");
		
		$_SESSION["message"] = 5;
		
		header("location: assign_review.php");
	}
	
	if(isset($_POST['SubmitReview']))
	{
		if(isset($_SESSION['IDs']))
		{
			$id = $_POST['id'];
			$decision = $_POST['myList'];
			$comments = $_POST['Comments'];
			$u_id = $_SESSION['IDs'];
			
			$review_submission = new Reviewer();
			$data = $review_submission->submit_editor_response($id, $u_id, $decision, $comments);
			$man_author = new Manuscript();
			$author_val = $man_author-> get_manuscript_author($id);
			$manu_details = $man_author->get_manuscript_mail($id);
			$mailing = new mailing();
			
			foreach($author_val as $key)
			{
				$mailing->send_mail_review($key["Title"], $key["First_Name"], $key["Last_Name"], $key["Email"], $manu_details["Title"], $decision);
			}
			
			$_SESSION["message"] =  4;
			header("location: view_details_editor.php?id=".$id);
		}
		
	}

?>