<?php

	if($_GET['manufile'])
	{
		$filename = urldecode($_GET['manufile']);
		$filepath = "../includes/classes/manuscript_uploaded/".$filename;
		
		if (file_exists($filepath)) {
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=".basename($filepath));
			header("Content-Type: application/octet-stream");
			header("Content-Transfer-Encoding: binary");
			header('Content-Length: ' . filesize($filepath));

			readfile($filepath);
			
		}
		else{
			echo "File not Found";
		}
	}
?>