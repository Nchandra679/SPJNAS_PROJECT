<?php require_once("mailing.php"); ?>


<?php
	$m1 = new mailing();				
	$m1->send_activate_mail("Mr", "Divnesh", "Prasad", "divneshjack@gmail.com");

?>