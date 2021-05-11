<?php require_once("DBConn.php"); ?>
<?php require_once("User.php"); ?>


<?php
	class Reviewer
	{	
		public function add_MReviewer($id, $reviewer_title, $reviewer_first_name, $reviewer_middle_name, $reviewer_last_name, $reviewer_academic_degree, $reviewer_email, $reviewer_reason)
		{
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("INSERT INTO Suggested_Reviewer (ID, Title, First_Name, Other_Name, Last_Name, Degree, Email, Reason) 
						VALUES (:id, :title, :reviewer_first_name, :reviewer_middle_name, :reviewer_last_name, :reviewer_academic_degree, :reviewer_email, :reviewer_reason)");
						$stmt->bindParam(':id', $id);
												$stmt->bindParam(':title', $reviewer_title);
						$stmt->bindParam(':reviewer_first_name', $reviewer_first_name);
						$stmt->bindParam(':reviewer_middle_name', $reviewer_middle_name);
						$stmt->bindParam(':reviewer_last_name', $reviewer_last_name);
						$stmt->bindParam(':reviewer_academic_degree', $reviewer_academic_degree);
						$stmt->bindParam(':reviewer_email', $reviewer_email);
						$stmt->bindParam(':reviewer_reason', $reviewer_reason);
						$stmt->execute();
			}
			catch(Exception $ex)
			{
				$_SESSION["error"] = 2;
				echo "Error: " . $ex->getMessage();
			}
		}
		
		public function get_ReviewManuscripts($id)
		{
			$data;
			$r_d = false;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM Response LEFT JOIN Manuscript ON 
									Response.ID = Manuscript.ID WHERE U_ID = (:u_id) AND Review_Done = (:r_d);");
						$stmt->bindParam(':u_id', $id);
						$stmt->bindParam(':r_d', $r_d);

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
		
		public function get_suggestedreviewer($sid)
		{
			$data;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM suggested_reviewer WHERE S_ID = (:s_id);");
						$stmt->bindParam(':s_id', $sid);

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
		
		public function submit_Review($id, $decision, $comments, $original, $justify, $credit, $title, $clear, $shorten, $references, $illustrations, $figures, $u_id)
		{
			$data;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				$review_done = true;
				
				$stmt = $conn->prepare("UPDATE response SET Decision = (:decision), Comments = (:comments), Originality = (:originality), Justify =(:justify),
							Credit = (:credit), STitle = (:title), Clear_Text = (:cleartext), Shorten = (:shorten), References_C = (:references),
							Illustrations = (:illustrations), Figures = (:figures), Review_Done = (:review_done) WHERE ID = (:id) AND U_ID = (:u_id);");
						$stmt->bindParam(':decision', $decision);
						$stmt->bindParam(':comments', $comments);
						$stmt->bindParam(':originality', $original);
						$stmt->bindParam(':justify', $justify);
						$stmt->bindParam(':credit', $credit);
						$stmt->bindParam(':title', $title);
						$stmt->bindParam(':cleartext', $clear);
						$stmt->bindParam(':shorten', $shorten);						
						$stmt->bindParam(':references', $references);						
						$stmt->bindParam(':illustrations', $illustrations);		
						$stmt->bindParam(':figures', $figures);					
						$stmt->bindParam(':review_done', $review_done);					
						$stmt->bindParam(':id', $id);
						$stmt->bindParam(':u_id', $u_id);											

				if($stmt->execute())
				{
					$data = true;
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function add_RReviewer($id, $u_id)
		{
			$data;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("INSERT INTO response (ID, U_ID) 
						VALUES (:id, :u_id);");
						$stmt->bindParam(':id', $id);
						$stmt->bindParam(':u_id', $u_id);

				if($stmt->execute())
				{
					$data = true;
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function delete_SReviewer($s_id)
		{
			$data;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("DELETE FROM `suggested_reviewer` WHERE 
						`suggested_reviewer`.`S_ID` = (:s_id)");
						$stmt->bindParam(':s_id', $s_id);
				if($stmt->execute())
				{
					$data = true;
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;

		}
		
		public function get_Responses($id)
		{
			$data;
			$r_d = true;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM Response LEFT JOIN users ON response.U_ID = users.U_ID 
										WHERE ID = (:id);");
						$stmt->bindParam(':id', $id);

				if($stmt->execute())
				{
					$data = $stmt->fetchAll();
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		public function get_SpecificResponses($rid)
		{
			$data;
			$r_d = true;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM Response LEFT JOIN users ON response.U_ID = users.U_ID 
										WHERE R_ID = (:r_id);");
						$stmt->bindParam(':r_id', $rid);

				if($stmt->execute())
				{
					$data = $stmt->fetch();
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;
		}
		
		public function Assign_UserManuscript($u_id, $id)
		{
			$data;
			$sendback;
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM Users WHERE U_ID = (:u_id);");
						$stmt->bindParam(':u_id', $u_id);

				if($stmt->execute())
				{
					$data_val = $stmt->fetch();
					if($data_val["Access_level"] == "Author")
					{
						$update_user = new User();
						$condition = $update_user->update_priviledge($u_id);
						
						if($condition)
						{
							$data = $this->add_RReviewer($id, $u_id);
						}
					}
					else
					{
						$data = $this->add_RReviewer($id, $u_id);
					}
				}
			}
			catch(Exception $ex)
			{
				$data = false;
				echo "Error: " . $ex->getMessage();
			}
			return $data;	
		}
		
		public function submit_editor_response($id, $u_id, $decision, $comments)
		{
			$data = null;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("INSERT INTO editor_response (ID, U_ID, Decision, Comments) VALUES (:id, :u_id, :decision, :comments) ;");
				$stmt->bindParam(':id', $id);
				$stmt->bindParam(':u_id', $u_id);
				$stmt->bindParam(':decision', $decision);
				$stmt->bindParam(':comments', $comments);
				
				
				if($stmt->execute())
				{
					$submit = true;
					$data = true;
					$stmt = $conn->prepare("UPDATE manuscript SET Review_Process = (:comments), Submit = (:submit) WHERE ID = (:id) ;");
					$stmt->bindParam(':id', $id);
					$stmt->bindParam(':comments', $decision);
					$stmt->bindParam(':submit', $submit);
					
					if($stmt->execute())
					{
						$data = true;					
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
		
		public function get_reviewer_comments($id)
		{
			$data = null;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("SELECT * FROM editor_response WHERE ID = (:id);");
				$stmt->bindParam(':id', $id);				
				
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