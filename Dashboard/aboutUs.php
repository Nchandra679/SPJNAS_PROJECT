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
    <title>About us</title>
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
                                <a href="manuscript/index.php">Submit your Paper</a>
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
                        <a href="helpAndSupport.php"><i class="fa fa-fw fa-file"></i> Help and support</a>
                    </li>
                    <li>
                        <a href="faq.php"><i class="fa fa-fw fa-file"></i>FAQ</a>
                    </li>
                    <li>
                        <a class="active-menu" href="aboutUs.php"><i class="fa fa-fw fa-file"></i> About us</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            About the Journal
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="index.php">Dashboard</a></li>
					  <li class="active">About us</li>
					</ol> 
									
		</div>
            <div id="page-inner">

                <!-- /. ROW  -->
<section class="small-12 large-9 medium-9 no-pad region-main-content columns">

 <p><strong>The South Pacific Journal of Natural and Applied Sciences (SPJNAS)</strong> publishes original articles in all areas of natural science, engineering and mathematics. The normal focus of interest is work carried out in the Pacific region. However, any work of specific or general interest to the Pacific region will be considered for publication, and authors based in countries outside the region are encouraged to submit manuscripts.</p>    <p>
<strong>SPJNAS</strong> is published online by CSIRO Publishing on behalf of the <a href="http://www.usp.ac.fj/fst" target="_daughter">Faculty of Science, Technology and Environment</a>, The University of the South Pacific, Fiji. It is a <a href="http://www.publish.csiro.au/nid/252/aid/9917.htm">sponsored</a> online journal and thus available to readers at no charge.</p>    <p>
</p>
<h3><strong>Aims</strong></h3>    <p>
The journal´s purpose is to enable the timely communication of information on scientific research carried out mostly on Pacific matters and contribute to the development of Pacific science. The <a href="http://www.publish.csiro.au/media/client/SPcoverpage.pdf" target="_blank">cover page</a> shows the locations of twelve South Pacific member Countries of The University of the South Pacific.</p>    <p>
The journal publishes original research articles, short communications, case reports, review articles, and book reviews in all areas of science, mathematics and engineering.</p>    <p>
</p><p><h3><strong>Features</strong></h3></p>    <p>
</p><ul>    <li style="list-style:disc;">Electronic Resources from Smithsonian Institution Libraries</li>   <li style="list-style:disc;">Wide coverage and readership in the South Pacific</li>     <li style="list-style:disc;">Internationally peer reviewed</li>  </ul>    <p>
</p><p><h3><strong>Social Media</strong></h3>
</p><p>Follow the journal on social media using hashtag <strong>#SouthPacificJNAS</strong></p>    <p>
</p><div class="Journal_CMS_subtitle">Bibliographic Information</div>   <p></p>
                
            
            <div class="body">
                <p><b>ISSN:</b> 1838-837X<br> <b>eISSN:</b> 1838-8388<br> 
                    <b>Frequency:</b> 2 issues per year<br>
                    <b>Current Issue:</b>
                    
                        <a href="/issue/9249">Volume 35   (2)   </a>
                    <br>
                    </p>
                
            </div>
            <br>
    
            <p><strong>Indexed/Abstracted in:</strong></p>
            <div class="body">
                <ul>
                <li>CAB Abstracts</li>  <li>EBSCO</li>  <li>Scopus</li>   <p>
                </p></ul>
            </div>
        
        <p>
                
                        CSIRO Publishing publishes and distributes scientific, technical and health science books, magazines and journals from Australia to a worldwide audience and conducts these activities autonomously from the research of the Commonwealth Scientific and Industrial Research Organisation (CSIRO). The views expressed in this publication are those of the author(s) and do not necessarily represent those of, and should not be attributed to, the publisher or CSIRO.
                    
            </p>

            </section>
		
			
		
				
			
		
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