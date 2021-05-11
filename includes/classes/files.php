<?php require_once("DBConn.php"); ?>

<?php
	class files{
		public function upload_file(){
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$student_id = $_SESSION["login_user"];
				$date = new DateTime("Pacific/Fiji");
				$date = $date->format('Y-m-d H:i:s');
			
				   //insert file information into db table
					$stmt = $conn->prepare("INSERT INTO files (Student_ID, file_name, uploaded) VALUES(:student_id, :file_name, :date);");
					$stmt->bindParam(":student_id", $student_id);
					$stmt->bindParam(':file_name', $_FILES["fileToUpload"]["name"]);
					$stmt->bindParam(':date',$date);
					$stmt->execute();
					return true;
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function show_file()
		{
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
			
				$student_id = $_SESSION["login_user"];
				$date = new DateTime("Pacific/Fiji");
				$date = $date->format('Y-m-d H:i:s');
					
				   //insert file information into db table
					$stmt = $conn->prepare("SELECT * FROM files WHERE student_id = (:student_id);");
					$stmt->bindParam(":student_id", $student_id);
					$stmt->execute();
					
					if($stmt->execute())
					{
						return $result = $stmt->fetchAll();
						
					}
					
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}	
			
			
		}
	}
	
?>