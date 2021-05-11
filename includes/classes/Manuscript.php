<?php require_once("DBConn.php"); ?>
<?php require_once("Mailing.php"); ?>
<?php require_once("User.php"); ?>

<?php
	class Manuscript
	{
		public function randomPassword() 
		{
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		}
		
		public function manuscript_upload($article_type, $title, $post_abstract, $key_words, $classification, $manuscript_file, $highlight_file, $coverletter_file, $date)
		{
			$conn = new DBConn();
			$conn = $conn->connect();
			$stmt = $conn->prepare("INSERT INTO Manuscript (ArticleType, Title, Abstract, KeyWords, Classifications, Highlights, Manuscript, Cover_Letter, Date_Upload) 
					VALUES (:article_type, :title, :post_abstract, :key_words, :classification, :highlights, :manuscript, :coverletter, :date_upload)");
				$stmt->bindParam(':article_type', $article_type);
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':post_abstract', $post_abstract);
				$stmt->bindParam(':key_words', $key_words);
				$stmt->bindParam(':classification', $classification);
				$stmt->bindParam(':highlights', $highlight_file);
				$stmt->bindParam(':manuscript', $manuscript_file);
				$stmt->bindParam(':coverletter', $coverletter_file);				
				$stmt->bindParam(':date_upload', $date);
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
		}
		
		public function get_manuscripts_editor()
		{
			$data; 
			try
			{
				$submit = true;
				$conn = new DBConn();
				$conn = $conn->connect();
				$sql_query = $conn->prepare("SELECT * FROM Manuscript WHERE Submit = (:submit);");
				$sql_query->bindParam(':submit', $submit);
				
				if($sql_query->execute())
				{
					$data = $sql_query->fetchAll();
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function add_Mauthor($author_Title, $f_name, $m_name, $l_name, $degree, $email, $date, $title)
		{
			$conn = new DBConn();
			$conn = $conn->connect();
			$sql_query = $conn->prepare("SELECT ID FROM Manuscript WHERE Date_Upload = (:date_upload) AND Title = (:title);");
			$sql_query->bindParam(':date_upload',$date);
			$sql_query->bindParam(':title',$title);

			if($sql_query->execute())
			{				
				$row_1 = $sql_query->fetch();
				$id = $row_1["ID"];
				foreach($email as $key => $n) 
				{						
					$conn = new DBConn();
					$conn = $conn->connect();
					$stmt = $conn->prepare("SELECT * FROM Users
											WHERE Email = (:email);");
					$stmt->bindParam(':email', $n);
				   
					if($stmt->execute())
					{
						$send_mail = new Mailing();
						$user = new User();
						if($rows = $stmt->fetch())
						{
							$u_id = $rows["U_ID"];
							$first_name = $rows["First_Name"];
							$last_name = $rows["Last_Name"];
							$user->author_manuscript($id, $u_id);
							$send_mail->send_manu_uploaded($author_Title[$key], $first_name, $last_name, $n, $title);
						}
						else
						{
							$password = $this->randomPassword();
							if($user->add_user($author_Title[$key], $n, $degree[$key], $f_name[$key], $m_name[$key], $l_name[$key], $password, "Author", "", ""))
							{
								$query = $conn->prepare("SELECT * FROM Users
														WHERE Email = (:email);");
								$query->bindParam(':email', $n);

								if($query->execute())
								{
									$row = $query->fetch();
									$u_id = $row["U_ID"];
									$first_name = $row["First_Name"];
									$last_name = $row["Last_Name"];
									echo $u_id;
									$user->author_manuscript($id, $u_id);
									$send_mail->send_newmanu_uploaded($author_Title[$key], $first_name, $last_name, $n, $title, $password);
								}
							}
						}
					}
				}
				return $id;
			}
		}
		
		public function get_manuscripts($u_id)
		{
			$data;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM manuscriptauthor LEFT JOIN manuscript ON manuscriptauthor.ID = manuscript.ID WHERE U_ID = (:u_id);");
				$stmt->bindParam(':u_id',$u_id);
				
				if($stmt->execute())
				{
					$data = $stmt->fetchAll();
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;	
		}
		
		public function submit_manuscript($id)	
		{
			$data;
			try
			{
				$change = true;
				$review = "Under Review";
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("UPDATE Manuscript SET Submit = (:submit), Review_Process = (:review) WHERE ID = (:id);");
				$stmt->bindParam(':submit', $change);
				$stmt->bindParam(':review', $review);
				$stmt->bindParam(':id',$id);
				$stmt->execute();
				$data = true;
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
		}
		
		public function get_manuscript_details($id)
		{
			$data;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM manuscript WHERE ID = (:id);");
				$stmt->bindParam(':id',$id);
				
				if($stmt->execute())
				{
					$data = $stmt->fetch();
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;	
		}
		
		public function get_manuscript_author($id)
		{
			$data;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM `manuscriptauthor` LEFT JOIN users ON manuscriptauthor.U_ID = users.U_ID
									WHERE manuscriptauthor.ID = (:id)");
				$stmt->bindParam(':id',$id);
				
				if($stmt->execute())
				{
					$data = $stmt->fetchAll();
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function get_manuscript_reviewers($id)
		{
			$data;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM suggested_reviewer WHERE ID = (:id);");
				$stmt->bindParam(':id',$id);
				
				if($stmt->execute())
				{
					$data = $stmt->fetchAll();
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function get_manu_status($id)
		{
			$data = null;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM editor_response WHERE ID = (:id);");
				$stmt->bindParam(':id',$id);
				
				if($stmt->execute())
				{
					if($stmt->rowCount() > 0)
					{
						$data = $stmt->fetch();
					}
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function get_manuscript_mail($id)
		{
			$data = null;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM Manuscript WHERE ID = (:id);");
				$stmt->bindParam(':id',$id);
				
				if($stmt->execute())
				{
					if($stmt->rowCount() > 0)
					{
						$data = $stmt->fetch();
					}
				}
			}
			catch(Exception $ex)
			{
				$data = "error";
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
	}
?>