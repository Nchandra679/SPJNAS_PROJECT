<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/classes/User.php"); ?>
<?php require_once("includes/classes/files.php"); ?>


<?php
 		session_start();
		$user = new User();
		$_SESSION['login_error'] = 0;

		if(isset($_POST['submit_login']))
		{
			$email = $_POST['Email'];
			$password = $_POST['password'];
			
			$login_attempt = $user->login($email, $password);

			if($login_attempt == "Author")
			{
				$_SESSION['login_user']= $email; // Initializing Session
				header("location: Dashboard/index.php");
				$_SESSION["access"] = "Author";
			}
			else if ($login_attempt == "Editor")
			{
				$_SESSION['login_user']= $email;
				$_SESSION["access"] = "Editor";
				header("location: Dashboard/index.php");
				//redirect_to admin dashboard
			}
			else if ($login_attempt == "Reviewer")
			{
				$_SESSION['login_user']= $email;
				echo "Reviewer";
				$_SESSION["access"] = "Reviewer";
				header("location: Dashboard/index.php");
				
			}
			else
			{
				$_SESSION["error"] = 3;
				header("location: login.php");
			}
		}
		else if(isset($_POST['submit_register']))
		{
			$title = $_POST['myList'];
			$email_address = $_POST['Email'];
			$degree = $_POST['degree'];
			$password = $_POST['password'];
			$f_name = $_POST['userf_name'];
			$o_name = $_POST['usero_name'];
			$l_name = $_POST['userl_name'];
			$a_o_s = $_POST['Area_o_Specilzation'];
			$p_number = $_POST['phone_number'];

			$r = $user->add_user($title, $email_address, $degree, $f_name, $o_name, $l_name, $password, "Author", $a_o_s, $p_number);

			if($r)
			{
				$_SESSION["error"] = 1;
				
				redirect_to("login.php");
			}
			else
			{
				$_SESSION["error"] = 2;
				redirect_to("login.php");
			}
    
		}
		else if (isset($_POST['activate_login']))
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$r = $user->activate_login($email, $password);
			
			if($r)
			{
				$_SESSION['error'] = 1;
			}
			else
			{
				$_SESSION['error'] = 2;
			}
			redirect_to("activateaccount.php");
		}
?>


<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            alert('not allowed');
            return false;
        } else {
            return true;
        }
};
</script>