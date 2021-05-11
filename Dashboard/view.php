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
		
		if($num == 1)
		{
			echo "<script>
			alert('Manuscript Uploaded');
			</script>";
		}		
		if($num == 3)
		{
			echo "<script>
			alert('Manuscript Submitted For Review');
			</script>";
		}
		if($num == 10)
		{
			echo "<script>
			alert('Manuscript Not Uploaded. Wrong File Type. Only accepts Word and PDF');
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
    <title>View Manuscript</title>
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
                                <a href="manuscript/index.php">Submit your paper</a>
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
				<?php
					if(isset($_SESSION['login_user']))
					{
						$email = $_SESSION['login_user'];
					}
					$q = "";
					if(isset($_SESSION['IDs']))
					{
						$u_id = $_SESSION['IDs'];
				
						$report ="";
						
						$get_manuscript = new Manuscript();
						
						$result = $get_manuscript->get_manuscripts($u_id);
										
						$report = "<table class=\"table table-bordered table-striped\" style=\"overflow-x:auto;\">";
						$report .= "<thead style=\"background-color: #3E3E3E\">";
						$report .= "<th style=\"color:#ff9900; text-align: center;\"> Title</th>";
						$report .=  "<th style=\"color:#ff9900; text-align: center;\">Submit your paper</th>";
						$report .= "<th style=\"color:#ff9900; text-align: center;\"> Submitted</th>";										
						$report .= "</thead>";											
						
						if($result)
						{
							foreach($result as $key) 
							{
								$report .= "<tr style=\"background-color:white;\">";
								$report .= "<td style=\"text-align: center;\"> " . htmlentities($key['Title']) . "</td>";
								$report .= "<td style=\"text-align: center;\"> ";
								$report .= "<a href=\"view_details_author.php?id=" . urlencode($key["ID"]) . "\">View Details</a>";
								$report .= "</td>";
								$s1;
								if($key['Submit'])
								{
									
									$s1 = "submitted";
								}
								else
								{
									$s1 = "Not Submitted";
								}
								$report .= "<td style=\"text-align: center;\"> " . htmlentities($s1) . "</td>";										
			
								$report .= "</tr>";
							}
						}
						else
						{
							$report .= "<tr style=\"background-color:white;\">";
							$report .=  htmlentities("No Manuscript Uploaded");
							$report .= "</tr>";
						}
														
						$report .= "</table>";
						echo $report;
					}
		?>	
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