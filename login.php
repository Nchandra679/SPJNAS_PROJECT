<?php
	session_start();
	
?>
<!DOCTYPE html>
<head>

  <title> Home Page </title>
  <meta charset="UTF-8">

  	<link rel="stylesheet" href="includes/css/main.css" type="text/css">
	<link rel="stylesheet" href="includes/css/new1.css" type="text/css">
	<link href="includes/css/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="includes/css/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
	<link href="includes/css/bootstrap/css/bootstrap1.min.css" rel="stylesheet" />

	<script src="includes/css/bootstrap/js/jquery.min.js" ></script> 
	<script src="includes/css/bootstrap/js/bootstrap1.min.js" ></script>


</head>

<body>

<div class="main">
<div class="sidebar-wrapper">
<div class="container1" >

	<div class="row">
		<h2></h2>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">

<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="form-body" style="background-color:	#FF9900">

  <ul class="nav nav-tabs final-login" style="background-color:	#FF9900" >
      <li class="active" style="background-color:#AFEEEE"><a data-toggle="tab" href="#sectionA"><font color = "#9c3b92"><b>Sign In</b></font></a></li>
      <li style="background-color:#AFEEEE; "><a data-toggle="tab"href="#sectionB"><font color = "#FF335B  "><b>Register!!</b></font></a></li>
  </ul>

</div>
<div class="form-body" style="background-color: #fff7e6">



    <div class="tab-content" >
        <div id="sectionA" class="tab-pane fade in active">
        <div class="innter-form">
            <form name="Login_Form" action ="checklogin.php" class="sa-innate-form" method="post">
            <label>Email</label>
            <input type="text" onkeyup="AccountStatus(this.value)" name="Email">
            <label>Password</label>
            <input type="password" name="password">
            <button style="background-color:#2EB82E" type="submit" id="submit_login" name="submit_login"><font color = "#FFF">Sign In</font></button>
            <a href="#">Forgot Password?</a>
			<p> <span id="txtemailcheck" ></span></p>
            <label id="error_login"></label>
            </form>
			<?php
                if(isset($_SESSION["error"]))
				{
	                $error = $_SESSION["error"];
					if($error == 1)
					{
                        echo "Registered Author. Please check email and activate account.";
                    }
					else if($error == 2)
					{
						echo "Not Registered Author";
					}
					else if( $error == 3 )
					{
						echo "Incorrect ID/ Password or Account not activated. Please check email.";
					}
				}
            ?>
            </div>

            <div class="clearfix"></div>
        </div>
        <div id="sectionB" class="tab-pane fade">
			<div class="innter-form">
            <form name="Register_Form" onsubmit="return validate_R_Form()" action="checklogin.php" class="sa-innate-form" method="post">
             <label>Title *</label>
             <select name = "myList" id = "myList" >
               <option value="" disabled selected>Select your Title</option>
			   <option value = "Mr">Mr</option>
               <option value = "Mrs">Mrs</option>
               <option value = "Miss">Miss</option>
               <option value = "Dr">Dr</option>
			   <option value = "Prof">Prof</option>
             </select>
			<label>First Name *</label>
            <input type="text" name="userf_name" required>
			<label>Other Names</label>
            <input type="text" name="usero_name">
			<label>Last Name *</label>
            <input type="text" name="userl_name" required>
			<label>Degree *</label>
            <input type="text" name="degree" required>
            <label>Email Address *</label>
            <input type="text" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required onkeyup="CheckEmail(this.value)">
			<p><span id="txtHint"></span></p>
			<label>Password *</label>
            <input type="password" name="password" id="password" pattern=".{8,}"  placeholder="Eight or more characters"  required>
			<label>Confirm Password *</label>
            <input type="password" name="password_1" id ="password_1" pattern=".{8,}"  placeholder="Enter Password Again"  required onkeyup="CheckPass(this.value)">
			<p> <span id="PassCheck" ></span></p>
			<label>Area of Specialization *</label>
            <input type="text" name="Area_o_Specilzation" required>
			<label>Phone Number</label>
			<input type="text" name="phone_number" id ="phone_number">
            <button type="submit" onclick="validate_R_Form()" id ="submit_register" name="submit_register">Join now</button>
			<label id="error_register"></label>
            <p>By clicking Join now, you agree to USP's User Agreement, Privacy Policy, and Cookie Policy.</p>
            </form>
			<label id="regitser_status"></label>
            </div>
            <div class="social-login">
            <p>- - - - - - - - - - - - - Register With Us - - - - - - - - - - - - - </p>
            </div>
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
function validate_R_Form()
{
	var mail = document.forms["Register_Form"]["Email"].value;
	var email_address = mail.substr(10);
	var text = "Incorrect Email Format";
	var pass = document.getElementById("error_register").value;
	var conpass = document.getElementById("error_register").value;

	if(pass != conpass)
	{
		text = "Password do not match";
		document.getElementById("error_register").innerHTML = text;
		return false;
	}
	else
	{
		return true;
	}
}
</script>

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

<script>
	function CheckEmail(str) 
	{
		var xhttp;
		if (str.length == 0) 
		{ 
			document.getElementById("txtHint").innerHTML = "Incorrect Email";
			return;
		}
		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() 
		  {
			if (this.readyState == 4 && this.status == 200) 
			{
			  document.getElementById("txtHint").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", "check.php?q="+str, true);
		  xhttp.send();   
	}
</script>

<script>
	function AccountStatus(str) 
	{
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			  document.getElementById("txtemailcheck").innerHTML = this.responseText;
		};
		xhttp.open("GET", "check_status.php?q="+str, true);
		xhttp.send();   
	}
</script>

<script>
	function CheckPass(str) 
	{
		var text = "Passwords do not match";
		var str_1 = document.getElementById("password").value;
		
		if(str == str_1)
		{
			document.getElementById("PassCheck").innerHTML = "";
		}
		else
		{
			document.getElementById("PassCheck").innerHTML = text;
		}
	}
</script>