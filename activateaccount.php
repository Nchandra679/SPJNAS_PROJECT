<?php
session_start();

?>
<!DOCTYPE html>
<head>

  <title> Home Page </title>
  <meta charset="UTF-8">
  
	<link rel="stylesheet" href="includes/css/new1.css" type="text/css">
	<link href="includes/css/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="includes/css/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
	<link href="includes/css/bootstrap/css/bootstrap1.min.css" rel="stylesheet" />
	<script src="includes/css/bootstrap/js/jquery.min.js" ></script> 
	<script src="includes/css/bootstrap/js/bootstrap1.min.js" ></script>
	
	
  


</head>
<body style="background-color:rgb(240, 240, 240)">

<div class="container-fluid" data-color="purple" data-image="includes/css/assets/img/sidebar-1.jpg">
<div class="sidebar-wrapper">
<div class="container" >

	<div class="row">
		<h2></h2>
	</div>
</div>
<br>
<br>
<div class="container">

<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="form-body" style="background-color:	#AFEEEE">

  <ul class="nav nav-tabs final-login" style="background-color:	#AFEEEE" >
      <li class="active" style="background-color:#AFEEEE"><a data-toggle="tab" href="#sectionA"><font color = "#9c3b92"><b>Account Activation</b></font></a></li>
  </ul>

</div>
<div class="form-body" style="background-color:	white">



    <div class="tab-content" >
        <div id="sectionA" class="tab-pane fade in active">
        <div class="innter-form">
            <form name="Activaation_Form" action ="checklogin.php" class="sa-innate-form" method="post">
            <label>User ID / Email</label>
            <input type="text" name="email">
            <label>Password</label>
            <input type="password" name="password">
            <button style="background-color:#AFEEEE" type="submit" id="activate_login" name="activate_login"><font color = "#9c3b92">Activate</font></button>
			<a href="login.php">Login Page</a>
            </form>
			<?php
                if(isset($_SESSION["error"]))
				{
	                $error = $_SESSION["error"];
					if($error == 1)
					{
					 echo "Account Acitve";
                    }
					else if($error == 2)
					{
						echo "Incorrect Details Provided";
					}
				}
            ?>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    </div>
    </div>
  </div>
</div>
</div>
</body>
<?php
    unset($_SESSION["error"]);
?>
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
   
