<?php require_once("DBConn.php"); ?>
<?php require_once("Mailing.php"); ?>

<?php
	class User
	{			
		private function password_encryption($pass){
			$password = password_hash($pass, PASSWORD_BCRYPT);
			return $password;
		}
		
		private function password_check($pass, $pas){
			return password_verify($pass, $pas); 
		}
		
		public function author_manuscript($id, $u_id)
		{
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
				$stmt = $conn->prepare("INSERT INTO ManuscriptAuthor (ID, U_ID) 
				VALUES (:id, :u_id)");
				$stmt->bindParam(':id', $id);
				$stmt->bindParam(':u_id', $u_id);
				$stmt->execute();
			}
			catch(Exception $ex)
			{
				$_SESSION["error"] = 2;
				echo "Error: " . $ex->getMessage();
			}
			
		}
		
		public function add_user($title, $email, $degree, $first_name, $o_name, $last_name, $password, $access, $a_o_s, $p_number)
		{
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$hash_password = $this->password_encryption($password);//encrypt password
				$date = new DateTime("Pacific/Fiji");
				$date = $date->format('Y-m-d H:i:s');
				
				//Prepare query and execute 
				$conn = $conn->connect();
				$stmt = $conn->prepare("INSERT INTO Users (Title, First_Name, Other_Name, Last_Name, Degree, Password, Email, Date_Create, Area_of_Speciality, Access_Level, Phone_Number) 
				VALUES (:title, :first_name, :other_name, :last_name, :degree, :password, :email, :date_create, :area_of_speciality, :access_level, :p_number)");
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':first_name', $first_name);
				$stmt->bindParam(':other_name', $o_name);
				$stmt->bindParam(':last_name', $last_name);
				$stmt->bindParam(':degree', $degree);
				$stmt->bindParam(':password', $hash_password);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':date_create', $date);
				$stmt->bindParam(':area_of_speciality', $a_o_s);
				$stmt->bindParam(':access_level', $access);
				$stmt->bindParam(':p_number', $p_number);
				
				if($stmt->execute())
				{
					$_SESSION["error"] = 1;
					
					$m1 = new mailing();
					
					$m1->send_activate_mail($title, $first_name, $last_name, $email);
					
					return true;
				}
				else 
				{
					$_SESSION["error"] = 2; 
				}				
			}
			catch(PDOException $e)
			{
				$_SESSION["error"] = 2;
				echo "Error: " . $e->getMessage();
			}
		}

		public function login($email, $password)
        {
			try
			{
				//Create instance of Database Connection
				$conn = new DBConn();
				$conn = $conn->connect();
		
				//Prepare login query and execute 
				$stmt = $conn->prepare("SELECT U_ID, Email, Account_Active, Password, Access_level FROM Users
										WHERE Email = (:email);");
				$stmt->bindParam(':email', $email);
			   
				if($stmt->execute())
				{
					$rows = $stmt->fetch();
					$q = $rows['Account_Active'];
					if($q)
					{
						if ($this->password_check($password, $rows['Password']))
						{
							//set session once login successful 
							$_SESSION['IDs'] = $rows['U_ID'];
							$_SESSION['login_user']=$email; // Initializing Session
							$date = new DateTime("Pacific/Fiji");
							$date = $date->format('Y-m-d H:i:s');
							
							//Prepare query for log entry and execute
							$stmt = $conn->prepare("INSERT INTO LOG_FILE (U_ID, Date_login) 
													VALUES (:u_id, :Date_login);");
							$stmt->bindParam(':u_id', $rows['U_ID']);
							$stmt->bindParam(':Date_login', $date);
							$stmt->execute();
							
							$stmt = $conn->prepare("SELECT ID FROM Log_File 
								WHERE U_ID = (:u_id) AND Date_login = (:Date_login);");
							$stmt->bindParam(':u_id', $rows['U_ID']);
							$stmt->bindParam(':Date_login', $date);
							$stmt->execute();
							$ans = $stmt->fetch();
							$_SESSION['login_id'] = $ans["ID"];
							
							return $rows['Access_level'];
						}
						else
						{
							$_SESSION["error"] = 3;
							return false;
						}
					}
					else
					{
						$_SESSION["error"] = 3;
					}
					
					
				}
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
        }
		public function change_password($password, $old_password)
		{
			try
			{
				$conn = new DBConn();
				$conn =$conn->connect();
				$hash_password = $this->password_encrypt($password, $conn);//encrypt password
				
				$username = $_SESSION['login_user'];
				$stmt = $conn->prepare("SELECT Pass FROM Users
										WHERE Username = (:Username);");
				$stmt->bindParam(':Username', $username);
			   
				if($stmt->execute())
				{
					while($rows = $stmt->fetch())
					{
						if ($this->password_check($old_password, $rows['Pass']))
						{
							$stm = $conn->prepare("UPDATE Users SET Pass = :password WHERE Username = (:ID);");
							$stm->bindParam(':password', $hash_password);
							$stm->bindParam(':ID', $username );
							if($stm->execute())
							{
								return true;
							}
							else
							{
								return false;
							}
						}
						else
						{
							return false;
						}
					}
				}
				else 
				{
					return false;
				}
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function Get_UserDetails($email)
		{
			$rows = null;
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				//Prepare login query and execute 
				$stmt = $conn->prepare("SELECT * FROM Users
										WHERE Email = (:Email);");
				$stmt->bindParam(':Email', $email);
				
				if($stmt->execute())
				{
					if($stmt->rowCount() > 0)
					{
						$rows = $stmt->fetch();
					}
				}
			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			return $rows;
		}

        public function logout()
        {
            if (isset($_SESSION['user_type']))
                unset($_SESSION['user_type']);
            if (isset($_SESSION['user_id']))
                unset($_SESSION['user_id']);
        }
		
		public function Get_All_UserDetails()
		{
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				//Prepare login query and execute 
				$stmt = $conn->prepare("SELECT * FROM Users;");
				
				if($stmt->execute())
				{	
					$result=$stmt->fetchAll();
					
						 return $result;
					}
					//echo "</table>";
				}
			
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function Update_User($First_Name, $Last_Name, $PNum)
		{
			try
			{
				$conn = new DBConn();
				
				$student_id = $_SESSION["login_user"];
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("UPDATE Users SET First_Name = :First_Name, Last_Name = :Last_Name, Phone_Number= :Phone_Number WHERE Student_ID = (:Student_ID);");
				$stmt->bindParam(':Student_ID', $student_id);
				$stmt->bindParam(':First_Name', $First_Name);
				$stmt->bindParam(':Last_Name', $Last_Name);
				$stmt->bindParam(':Phone_Number', $PNum);
				
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function Show_logs($ID)
		{
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT * FROM log_file WHERE student_id =(:ID);");
				$stmt->bindParam(':ID', $ID);		
				if($stmt->execute())
				{
					
					return 	$result=$stmt->fetchAll();	
				}
			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function activate_login($email, $password)
		{
			try
			{
				$conn = new DBConn();
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("SELECT Email, Password FROM Users
					WHERE Email = (:email);");
				$stmt->bindParam(':email', $email);
				
				if($stmt->execute())
				{
					$rows = $stmt->fetch();
					if ($this->password_check($password, $rows['Password']))
					{
						$stmt = $conn->prepare("UPDATE Users SET Account_Active = TRUE 
						WHERE Email = (:email);");
						$stmt->bindParam(':email', $email);
						if($stmt->execute())
						{
							return true;
						}
					}
				}

			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
		public function update_priviledge($u_id)
		{
			try
			{
				$access_level = "Reviewer";
				$conn = new DBConn();
				
				$student_id = $_SESSION["login_user"];
				$conn = $conn->connect();
				
				$stmt = $conn->prepare("UPDATE Users SET Access_Level = (:access_level) WHERE U_ID = (:u_id);");
				$stmt->bindParam(':Access_Level', $access_level);
				$stmt->bindParam(':U_ID', $u_id);
				
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
		}
	}
?>