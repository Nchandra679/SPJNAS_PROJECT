<?php require_once("../includes/classes/Reviewer.php");?>
<?php
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../login.php'); // Redirecting To Home Page
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
    <title>View Reviewer Referee's form</title>
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
                        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
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
                                <a href="#">View Manuscript</a>
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
                        <a href="helpAndSupport.php"><i class="fa fa-fw fa-file"></i> Help and support</a>
                    </li>
                    <li>
                        <a href="faq.php"><i class="fa fa-fw fa-file"></i>FAQ</a>
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
                            View Reviewer Referee's form details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="index.php">Dashboard</a></li>
					  <li class="active">Reviewer Referee's form</li>
					</ol> 
									
		</div>
            <div id="page-inner">

                <!-- /. ROW  -->
                <div class="jumbotron">
		            <div class="form-group">

						<?php
							$rid = $_GET["id"];
							$review_response = new Reviewer();
							$review_data = $review_response->get_SpecificResponses($rid);
							$id = $review_data["ID"];
						?>						
						
                        <h3>Response</h3>
                        <br/><p></p>
						</div>
						<label>Decision Selected:</label>
						<input class="form-check-input" type="text" name = "decision"  value="<?php echo htmlentities( $review_data['Decision'] );?>" readonly /></input>
						
                        <div class="form-check">
                                <label>Comments:</label></br>
                            <?php echo htmlentities( $review_data['Comments'] );?><p></p>
                        </div>						
  
                         <div class="form-check">
                         <h3>Content</h3><p></p>
						 <label class="form-check-label">1.  Does the manuscript have a significant original contribution to science? </label><br/>
                                <input type="text" name="original" value="<?php echo htmlentities( $review_data['Originality'] );?>" readonly class="form-check-input"></input><br/>
                             
                                <label class="form-check-label">2.  Are the interpretations and conclusions sound and justified by the data presented? </label><br/>
                                <input type="text" name="Justify" value="<?php echo htmlentities( $review_data['Justify'] );?>" readonly class="form-check-input"> </input><br/>

                                <label class="form-check-label">3.  Does/Do the author/authors give due credit to previous work?  </label><br/>
                                <input type="text" name="Credit" value="<?php echo htmlentities( $review_data['Credit'] );?>" readonly class="form-check-input"> </input><br/>
                        </div>

                        <div class="form-check">
                         <h3>Presentation</h3><p></p>
                                <label class="form-check-label">1.  Are the title and summary informative and relevant? </label><br/>
                                <input type="text" name="STitle" value="<?php echo htmlentities( $review_data['STitle'] );?>" readonly class="form-check-input"></input><br/>

                                <label class="form-check-label">2.  Is the text clear and well-written? </label><br/>
                                <input type="text" name="Clear" value="<?php echo htmlentities( $review_data['Clear_Text'] );?>" readonly class="form-check-input"></input><br/>

                                <label class="form-check-label">3.  Could the text be shortened with advantage?</label><br/>
                                <input type="text" name="Shorten" value="<?php echo htmlentities( $review_data['Shorten'] );?>" readonly class="form-check-input"></input><br/>

                                <label class="form-check-label">4.  Are all the references adequate and satisfactorily cited? </label><br/>
                                <input type="text" name="References" value="<?php echo htmlentities( $review_data['References_C'] );?>" readonly class="form-check-input"> </input><br/>
                        </div>  

                        <div class="form-check">
                         <h3>Figures and tables</h3><p></p>
                                <label class="form-check-label">1.  Are the illustrations clear and well presented? </label><br/>
                                <input type="text" class=""name="Illustrations" value="<?php echo htmlentities( $review_data['Illustrations'] );?>" readonly class="form-check-input"></input><br/>

                                <label class="form-check-label">2.  Are all the figures relevant and essential? </label><br/>
                                <input type="text" name="Figures" value="<?php echo htmlentities( $review_data['Figures'] );?>" readonly class="form-check-input"></input><br/>
                        </div>
						<p></p><p></p>
							<div class="form-check">
							<?php
								echo "<a href=\"editor_reviewers.php?id=".urlencode($id). "\"> Back </a>";	
							?>
				 </div>
        
                </div>

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