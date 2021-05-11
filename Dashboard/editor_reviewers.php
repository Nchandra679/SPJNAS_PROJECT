<?php require_once("../includes/classes/Reviewer.php");?>
<?php
	session_start();
	
	if(isset($_SESSION['message']))
	{
		$num = $_SESSION['message'];
		
		if($num == 5)
		{
			echo "<script>
			alert('Reviewer Assigned');
			</script>";
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
			$respose_details = new Reviewer();
			$response_data = $respose_details->get_Responses($id)
			
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
              <label class="control-label">Assigned Reviewers: </label>
				<?php	
					$report = "<table class=\"table table-bordered table-striped\" style=\"overflow-x:auto;\">";
					$report .= "<thead style=\"background-color: #3E3E3E\">";
					$report .= "<th style=\"color:#ff9900; text-align: center;\"> Title</th>";
					$report .=  "<th style=\"color:#ff9900; text-align: center;\">Name</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Email</th>";
					$report .= "<th style=\"color:#ff9900; text-align: center;\">Degree</th>";
					$report .= 	"<th style=\"color:#ff9900; text-align: center;\">Review Completed</th>";
					$report .= 	"<th style=\"color:#ff9900; text-align: center;\">View Review</th>";
					$report .= "</thead>";

					if($response_data)
					{
						foreach($response_data as $key) 
						{
							$report .= "<tr style=\"background-color:white;\">";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key['Title']) . "</td>";
							$name = $key["First_Name"] . " " .  $key["Last_Name"];
							$report .= "<td style=\"text-align: center;\">" . htmlentities($name) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Email"]) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($key["Degree"]) . "</td>";	
							if($key["Review_Done"])
							{								
								$report .= "<td style=\"text-align: center;\"> " . htmlentities("Review Done") . "</td>";
								$report .= "<td style=\"text-align: center;\"> ";
								$report .= "<a href=\"reviewer_form_viewDetails.php?id=" . urlencode($key["R_ID"]) . "\">View Details</a>";
								$report .= "</td>";
							}
							else
							{
								$report .= "<td style=\"text-align: center;\"> " . htmlentities("Review Not Completed") . "</td>";
								$report .= "<td style=\"text-align: center;\"> " . htmlentities("Review Not Completed") . "</td>";
							}
							$report .= "</tr>";
						}
					}
					$report .= "</table>";
					echo $report;
				?>
			  <p></p>
              
              </div>
			  <div class="form-row">
				 <?php
					echo "<a href=\"view_details_editor.php?id=".urlencode($id). "\"> Back </a>";	
					?>
			  </div>
			  
				  
              
            </div>
				 <div class="jumbotron">
		       
				<form  name ="Reviewer_Form" class="form-inline md-form mr-auto mb-4" action="<?php htmlentities( "editor_reviewers.php?id=".urlencode($id))?>" enctype="multipart/form-data" method="post">
					<input class="form-control mr-sm-2" name = "email" type="text" placeholder="Enter User Email" aria-label="Search">
					<button class="btn btn-outline-warning btn-rounded btn-sm my-0" id="search" name="search" type="submit">Search</button><p></p>
				</form>    
				
				<div class="form-row">
				<?php

					if(isset($_POST['search']))
					{
						$email = $_POST['email'];
						$find_reviewer = new User();
						
						$data = $find_reviewer->Get_UserDetails($email);						
						$report = "<table class=\"table table-bordered table-striped\" style=\"overflow-x:auto;\">";
						$report .= "<thead style=\"background-color: #3E3E3E\">";
						$report .= "<th style=\"color:#ff9900; text-align: center;\"> Title</th>";
						$report .=  "<th style=\"color:#ff9900; text-align: center;\">Name</th>";
						$report .= "<th style=\"color:#ff9900; text-align: center;\">Email</th>";
						$report .= "<th style=\"color:#ff9900; text-align: center;\">Degree</th>";
						$report .= "<th style=\"color:#ff9900; text-align: center;\">Access Level</th>";
						$report .= "<th style=\"color:#ff9900; text-align: center;\">Assign Reviewer to Manuscript</th>";
						$report .= "</thead>";

						if($data)
						{
							$report .= "<tr style=\"background-color:white;\">";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($data['Title']) . "</td>";
							$name = $data["First_Name"] . " " .  $data["Last_Name"];
							$report .= "<td style=\"text-align: center;\">" . htmlentities($name) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($data["Email"]) . "</td>";
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($data["Degree"]) . "</td>";		
							$report .= "<td style=\"text-align: center;\"> " . htmlentities($data["Access_level"]) . "</td>";		
							$report .= "<td style=\"text-align: center;\"> ";
							$report .= "<a href=\"reviewer_manuassign.php?u_id=" . urlencode($data["U_ID"]) . "&id=". urlencode($id) ."\"> Assign </a>";
							$report .= "</td>";							
							$report .= "</tr>";
						}
						else
						{
							echo "No results found";
						}
						
						$report .= "</table>";
						echo $report;
					}

				?> 
				</div>
				
			<footer><p></p>
				
        
				</footer>

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

