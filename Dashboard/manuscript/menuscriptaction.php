<?php require_once("../../includes/classes/Manuscript.php");?> 
<?php require_once("../../includes/classes/Manuscript.php");?> 
<?php require_once("../../includes/classes/Reviewer.php"); 
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
	}
?>

<?php
	
	//step 2
	$article_type = $_POST["Article_Type"];
	$title = $_POST["title"];
	//Author details; step 3
	$A_Title = $_POST["myList"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$academic_degree = $_POST["academic_degree"];
	$email = $_POST["email"];
	

	//abstract step 4
	$post_abstract = $_POST["post_abstract"];
	
	//key words; step 5
	$key_words =$_POST["key_words"];
	
	//select classification: step 6
	$classification = $_POST["classification"]; //not sure how will your classification work;
	
	// reviewer infor; step 7;
	$reviewer_title = $_POST["reviewer_title"];
	$reviewer_first_name = $_POST["reviewer_firstname"];
	$reviewer_middle_name = $_POST["reviewer_middlename"];
	$reviewer_last_name = $_POST["reviewer_lastname"];
	$reviewer_academic_degree = $_POST["reviewer_degree"];
	$reviewer_email = $_POST["reviewer_email"];
	$reviewer_reason =$_POST["reviewer_reason"];
	
	$coverletter_name;
	$manuscriptfile_name;
	$highlightfile_name;
	
	if(!empty($_FILES['manuscript_file']))
	{
		$allowed =  array('pdf','docx','doc', 'docm' );
		$filename = $_FILES['manuscript_file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$_SESSION["message"] = 10;
			echo "Not Uploaded";
		}
		else
		{
			date_default_timezone_set('Pacific/Fiji');
			$date = new DateTime();

			$array = explode('.', $filename);
			$file_f = $array[0];
			$file_ext = $array[1];
			$manuscriptfile_name = $date->getTimestamp()."_".$file_f.".".$file_ext;
			$path = "../../includes/classes/manuscript_uploaded/";
			if(move_uploaded_file($_FILES['manuscript_file']['tmp_name'], $path.$manuscriptfile_name)) {
				echo "The file ".  basename( $_FILES['manuscript_file']['name']). 
				" has been uploaded";
								
				 	if(!empty($_FILES['coverletter_file']))
					{
						$allowed =  array('pdf','docx','doc', 'docm' );
						$filename = $_FILES['coverletter_file']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(!in_array($ext,$allowed)) 
						{
							$_SESSION["message"] = 10;
							echo "Not Uploaded";							
						}
						else
						{
							date_default_timezone_set('Pacific/Fiji');
							$date = new DateTime();

							$array = explode('.', $filename);
							$file_f = $array[0];
							$file_ext = $array[1];
							$coverletter_name = $date->getTimestamp()."_".$file_f.".".$file_ext;
							$path = "../../includes/classes/cover_letter/";
							if(move_uploaded_file($_FILES['coverletter_file']['tmp_name'], $path.$coverletter_name)) {
								echo "The file ".  basename( $_FILES['coverletter_file']['name']). 
								" has been uploaded";
							} 
							else{
								echo "There was an error uploading the file, please try again!";
							}
						}
					}

					if(!empty($_FILES['highlight_file']))
					{
						$allowed =  array('pdf','docx','doc', 'docm' );
						$filename = $_FILES['highlight_file']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(!in_array($ext,$allowed)) 
						{
							$_SESSION["message"] = 10;
							echo "Not Uploaded";
						}
						else
						{
							date_default_timezone_set('Pacific/Fiji');
							$date = new DateTime();

							$array = explode('.', $filename);
							$file_f = $array[0];
							$file_ext = $array[1];
							$highlightfile_name = $date->getTimestamp()."_".$file_f.".".$file_ext;
							$path = "../../includes/classes/highlights/";
							if(move_uploaded_file($_FILES['highlight_file']['tmp_name'], $path.$highlightfile_name)) {
								echo "The file ".  basename( $_FILES['highlight_file']['name']). 
								" has been uploaded";
							} 
							else{
								echo "There was an error uploading the file, please try again!";
							}
						}
					}
					
					$manuscript = new Manuscript();
					$date = new DateTime("Pacific/Fiji");
					$date = $date->format('Y-m-d H:i:s');

					$r = $manuscript->manuscript_upload($article_type, $title, $post_abstract, $key_words, $classification, $manuscriptfile_name, $highlightfile_name, $coverletter_name, $date);
					$q = $manuscript->add_Mauthor($A_Title, $first_name, $middle_name, $last_name, $academic_degree, $email, $date, $title);
					
					$review = new Reviewer();
					foreach($reviewer_email as $key => $n) 
					{
						echo $n;
						$review->add_MReviewer($q, $reviewer_title[$key], $reviewer_first_name[$key], $reviewer_middle_name[$key], $reviewer_last_name[$key], $reviewer_academic_degree[$key], $n, $reviewer_reason[$key]);
					}
						
					if($r)
					{
						$_SESSION["message"] = 1;						
					}
			} 
			else{
				echo "There was an error uploading the file, please try again!";
				$_SESSION["message"] = 10;
			}			
		}

	}else{
			$_SESSION["message"] = 10;
		}
//		echo "<script>window.location.assign('../view.php')</script>";	
?>