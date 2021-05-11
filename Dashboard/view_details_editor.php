<?php require_once("../includes/classes/Manuscript.php");?>
<?php
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
	}
	if(isset($_SESSION['message']))
	{
		$num = $_SESSION['message'];
		
		if($num == 4)
		{
			echo "<script>
			alert('Review Submitted');
			</script>"	;
		}		
		if($num == 5)
		{
			echo "<script>
			alert('Reviewer Assigned');
			</script>"	;
		}	
		unset($_SESSION["message"]);
	}
?>



<!DOCTYPE html>
<!-- 
Template Name: BRILLIANT Bootstrap Admin Template
Version: 4.5.6
Author: WebThemez
Website: http://www.webthemez.com/ 
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>View Manuscript Editor</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation" style="background-color: #ff9900">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background-color: #E6004C" href="index.php"><strong><i class=""></i> LOGO HERE</strong></a>
				
		<div id="sideNav" href="">
		<i class="fa fa-bars icon"></i> 
		</div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
					 
					 <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Author<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="view.php">View Manuscript</a>
                            </li>
                            <li>
                                <a href="manuscript/index.php">Upload Manuscript</a>
                            </li>
							</ul>
						</li>	
						<?php
							if(isset($_SESSION['access']))
							{
								if($_SESSION['access'] == "Reviewer" || $_SESSION['access'] == "Editor")
								{

						?>	
                    
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Reviewer<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="view_reviewer.php">View Manuscript</a>
                            </li>
                            </ul>
                        </li>   
                    <li>
					<?php
								;
							}
							if($_SESSION['access'] == "Editor")
							{
					?>
					<li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Editor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="view_editor.php">View Manuscript</a>
                            </li>
                            <li>
                                <a href="assign_review.php">Assign Reviewers</a>
                            </li>
                            </ul>
                        </li>
						<?php 
								;
							}
							}
						?>
						<li>
                        <a  href="#"><i class="fa fa-user fa-fw"></i> Forms<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="forms.php">CSIRO Form</a>
                            </li>
                            </ul>
                        </li> 
                    <li>
                        <a href="HelpAndsupport.php"><i class="fa fa-fw fa-file"></i> Help and support</a>
                    </li>
                                     <li>
                        <a href="faq.php"><i class="fa fa-fw fa-file"></i> FAQ</a>
                    </li>
                    <li>
                        <a href="aboutUs.php"><i class="fa fa-fw fa-file"></i> About us</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
		<?php
			$id = $_GET['id'];
			$m_details = new Manuscript();
			$result = $m_details->get_manuscript_details($id);
			$author_details = $m_details->get_manuscript_author($id);
			$reviewer_details = $m_details->get_manuscript_reviewers($id);
			$manu_status = $m_details-> get_manu_status($id);
		?>
		
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            View Manuscript <small>Welcome</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="#">View Manuscript</a></li>
					  <li class="active">Data</li>
					</ol> 
									
		</div>		
            <div id="page-inner">

                <!-- /. ROW  -->
            <div class="jumbotron">
              <div class="form-row">
              <label class="control-label">Article Type: </label>
			  <?php  
				echo $result['ArticleType'];
			  ?>
			  <p></p>
              
              </div>
              <div class="form-row">
              <label class="control-label">Title: </label>
				<?php  
				echo $result['Title'];
			  ?>
			  <p></p>
              
              </div>
              <div class="form-row">
              <label class="control-label">Keywords: </label>
			  <?php  
				$keywords = explode(';', $result['KeyWords']);
				foreach( $keywords as $keyword_val )
				{
					echo $keyword_val. " , ";
				}
			  ?>
			  <p></p>
              
              </div>
              <div class="form-row">
              <label class="control-label">Classifications: </label>
			  <?php
				echo $result["Classifications"]
			  ?>
			  <p></p>
              </div>
              <div class="form-row">
              <label class="control-label">Authors: </label>
				<?php	
					$report = "<table class=\"table table-bordered table-striped\" style=\"overflow-x:auto;\">";
					$report .= "<thead style=\"background-color: #3E3E3E\">";
					$report .= "<th style=\"color:#ff9900; text-align: center;\"> Title</th>";
					$report .=  "<th style=\"color:#ff9900; text-align: center;\">Name</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Email</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Degree</th>";
					$report .= "</thead>";
					if($reviewer_details)
					{
						foreach($reviewer_details as $key) 
						{
							$report .= "<tr style=\"background-color:white;\">";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key['Title']) . "</td>";
							$name = $key["First_Name"] . " " .  $key["Last_Name"];
							$report .= "<td style=\"text-align: center;\">" . htmlentities($name) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Email"]) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Degree"]) . "</td>";
							$report .= "</tr>";
						}
					}
					$report .= "</table>";
					echo $report;
				?>
			  <p></p>
              
              </div>
              <div class="form-row">
              <label class="control-label">Date upload: </label>
				<?php
					echo $result["Date_Upload"]
				?>
			  <p></p>
              </div>
              <div class="form-row">
                  <label class="control-label">Manuscript: </label></div>
				  <?php  
					$manuscript_file = explode('_', $result['Manuscript']);
					$manuscript_name = $manuscript_file[1];
					echo "<a href=\"download.php?manufile=".urlencode($result['Manuscript']). "\"> $manuscript_name </a>";
					?>
				  <p></p>

              <div class="form-row">
                  <label class="control-label">Cover letter: </label>
				  <?php  
					$coverletter_file = explode('_', $result['Cover_Letter']);
					$coverletter_name = $coverletter_file[1];
					echo "<a href=\"download_documents.php?coverfile=".urlencode($result['Cover_Letter']). "\"> $coverletter_name </a>";
					?>
				  
				  </div><p></p>
			  
			  <div class="class="form-row""><label class="control-label">Highlights: </label>
				<?php  
					$Highlights_file = explode('_', $result['Highlights']);
					$Highlights_name = $Highlights_file[1];
					echo "<a href=\"download_highlights.php?highfile=".urlencode($result['Highlights']). "\"> $Highlights_name </a>";
				?>
			  <p></p>
			  </div>
			  
			  <div class="class="form-row""><label class="control-label">Suggested Reviewers </label>
					<?php	
					$report = "<table class=\"table table-bordered table-striped\" style=\"overflow-x:auto;\">";
					$report .= "<thead style=\"background-color: #3E3E3E\">";
					$report .= "<th style=\"color:#ff9900; text-align: center;\"> Title</th>";
					$report .=  "<th style=\"color:#ff9900; text-align: center;\">Name</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Email</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Degree</th>";	
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Assign Reviewer</th>";											
					$report .= "</thead>";
					if($reviewer_details)
					{
						foreach($reviewer_details as $key) 
						{
							$report .= "<tr style=\"background-color:white;\">";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key['Title']) . "</td>";
							$name = $key["First_Name"] . " " .  $key["Last_Name"];
							$report .= "<td style=\"text-align: center;\">" . htmlentities($name) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Email"]) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Degree"]) . "</td>";	
							$report .= "<td style=\"text-align: center;\"> ";
							$report .= "<a href=\"assignreviewer_auto.php?id=" . urlencode($key["S_ID"]) . "\">Assign</a>";
							$report .= "</td>";							
							$report .= "</tr>";
						}
					}
					$report .= "</table>";
					echo $report;
			?>
			  <p></p>
			  </div>

              <div class="form-row">
                  <label class="control-label">Reviewer Response:</label>
				  <?php
					echo "<a href=\"editor_reviewers.php?id=".urlencode($id). "\"> View Reviewer Responses/ Assign Reviewers to Manuscript</a>";	
					?>
				  </div><p><hr/></p>
				  <?php
					if(is_null($manu_status))
					{
				?>
				  
		<form role="form" action="reviewer_feedback.php" enctype="multipart/form-data" method="post">
             <div class="form-row">
			 
			
             <label class="control-label">Review decision</label>
			 <p></p>
			 </div>
			 <div class="form-row">
			 <input class="form-check-input" type="text" name = "id"  value="<?php echo htmlentities($id );?>" readonly /></input>
			 
			 <p></p>
			 </div>
			<div class="form-row">
             <select class="form-control" required="required" name = "myList">
               <option value="" disabled selected>Decision</option>
			   <option value = "Acceptable in its present form">Acceptable in its present form </option>
			   <option value = "Acceptable after minor revision"> Acceptable after minor revision</option>
			   <option value = "CONSIDER after major revision">CONSIDER after major revision</option>
			   <option value = "Not acceptable">Not acceptable</option>

             </select><p></p>
           </div>
		     <div class="form-row">
			 <label>Comments</label>
			 <textarea class="form-control" value=" " name="Comments" row="3"></textarea><p></p><p></p>
				</div>
		   
              <div class="form-row">
                  
                  <button class="btn btn-success" name="SubmitReview" type="submit" >Submit Review</button>
                  
                  </hr>
              </div>
              </form>
			  
			  <?php 
					;
					}
					else
					{
						echo $manu_status['Decision'];
					}
						
				?>
              </div>
				<footer><p></p>
				
        
				</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	 
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	
	 <script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

      
    <!-- Chart Js -->
    <script type="text/javascript" src="assets/js/Chart.min.js"></script>  
    <script type="text/javascript" src="assets/js/chartjs.js"></script> 

</body>

</html>

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            alert('The Crtl-V and Crtl-C functions are disabled');
            return false;
        } else {
            return true;
        }
};
</script>