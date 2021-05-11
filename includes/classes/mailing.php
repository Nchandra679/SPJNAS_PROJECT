<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class mailing
{	
	public function send_activate_mail($title, $first_name, $last_name, $email)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Registering for SPJNAS Online Platform';
			$mail->Body    = "Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php";
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
			echo 'Message has been sent';
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
	
	public function send_manu_uploaded($title, $first_name, $last_name, $email, $manu_title)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients

		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear " . $title . " . " .  $last_name .  
			"                       
			The manuscript: ". $manu_title . "has been uploaded on your behalf SPJNAS Platform. 
			Please login to see your manuscript status.";   
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Uploading A Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
			echo 'Message has been sent';
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		
	}
	
	public function send_newmanu_uploaded($title, $first_name, $last_name, $email, $manu_title, $password)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear ". $title . "." . $last_name . 
			" 
			The manuscript: " . $manu_title . "has been uploaded on your behalf SPJNAS Platform. Please login to see your manuscript status.\r\n You can login using this email and password:". $password. ". \r\n It is advised you change your password after you login.";   
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Uploading A Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		
	}

	public function send_mail_submit($title, $first_name, $last_name, $email, $manu_title)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear ". $title . "." . $last_name . 
			" 
			The manuscript: " . $manu_title . " has been submitted to SPJNAS for review.";   
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Submitting Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		
	}
	
	public function send_reviewer($title, $first_name, $last_name, $email)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear ". $title . "." . $last_name . 
			" 
			You have been invited to review a manuscript by SPJNAS. Please log in and review this document.";   
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Submitting Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		
	}
	
	public function send_mail_review($title, $first_name, $last_name, $email, $manu_title, $decision)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear ". $title . "." . $last_name . 
			" 
			The manuscript: " . $manu_title . " has been " . $decision. " by SPJNAS after review.";   
			$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Submitting Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
	
	public function send_newmanu_review($title, $first_name, $last_name, $email, $password)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
//			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ii5132835@gmail.com';                 // SMTP username
			$mail->Password = 'binuh3am';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
		
		//Recipients
		$mail->setFrom('ii5132835@gmail.com', 'The South Pacific Journal of Natural and Applied Sciences');
			//$mail->addAddress('S11133846@student.usp.ac.fj','Patrick Sharma');     // Add a recipient
			$name = $first_name + " " + $last_name;
			$body = "Dear ". $title . "." . $last_name . 
			" 
			 You have been invited to review a manuscript by SPJNAS. Please log in and review this document. You can login using this email and password:". $password. " to review the manuscript.  It is advised you change your password after you login.";   
				$mail->addAddress($email, $name);               // Name is optional
			//    $mail->addReplyTo('info@example.com', 'Information');
		//    $mail->addCC('cc@example.com');
		//    $mail->addBCC('bcc@example.com');

			//Attachments
		//	$mail->addAttachment('LeaderElection.zip');         // Add attachments
		//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		
	//		$body = $title + "." + $last_name ;
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Uploading A Manuscript to SPJNAS Online Platform';
			$mail->Body    = $body;
		//	$mail->AltBody = 'Your account as an author has been created. Please verfiy your email via this link: localhost/SPJNAS/activateaccount.php';
			
			$mail->send();
		} 
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		
	}
	
	
}
?>