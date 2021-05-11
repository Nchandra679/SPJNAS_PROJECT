<?php
	session_start();
	
	$user_check=$_SESSION['login_user'];
	if(!isset($user_check))
	{
		header('Location:../../login.php'); // Redirecting To Home Page
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Manuscript</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/basic.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dropzone.css">
    <link rel="stylesheet" href="assets/css/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    
    <link rel="stylesheet" href="assets/css/bootstrap-select.css">
</head>

<body>
<nav class="navbar navbar-light  navbar-fixed-top clean-navbar navbar-light bg-faded" style="background-color: #FF9900;">
        <a class="navbar-brand logo" href="#">LOGO</a>
        <button class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class='collapse navbar-toggleable-xs' id="navcol-1">
            
                <ul class="nav nav-pills">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../helpAndSupport.php">Help and Support</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../faq.php">FAQ</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../aboutUs.php">About us</a></li>
                </ul>
            </div>
    </nav>
    
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Follow the steps to submit a Manuscript</h2>
                    <p>Please enter all required details</p>
                </div>
                <div class="block-content"><div><div class="container">
  <div class="stepwizard">
    <div class="stepwizard-row setup-panel">

      <div class="stepwizard-step col-xs-3">
        <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
        <p><small>Article Type</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p><small>Enter Title</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p><small>Add/Edit/Remove Authors</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
        <p><small>Submit Abstract</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
        <p><small>Enter Key Words</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
        <p><small>Select Classifications</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
        <p><small>Suggest Reviewers</small></p>
      </div>

      <div class="stepwizard-step col-xs-3">
        <a href="#step-8" type="button" class="btn btn-default btn-circle" disabled="disabled">8</a>
        <p><small>Attache files</small></p>
        </div>

        </div>
  </div>

    
  <form name="Manuscript_Form" role="form" action = "menuscriptaction.php" enctype="multipart/form-data"  method ="post">
    <div class="panel panel-primary setup-content" id="step-1">
      <div class="panel-heading">
        <h3 class="panel-title">Type of Article</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">         
    <span></span>
  </button>
           <label class="control-label">Select Article type </label>
			<select name="Article_Type">
               <option value="" disabled selected>Select your Title</option>
			         <option value = "Research Article">Research Article</option>
               <option value = "Short communication">Short communication</option>
               <option value = "Letter to the Editor">Letter to the Editor</option>
               <option value = "Review Article">Review Article</option>
			</select>
        </div>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>

    <div class="panel panel-primary setup-content" id="step-2">
      <div class="panel-heading">
        <h3 class="panel-title">Enter full title of Article</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label">Full article title *</label>
          <input maxlength="200" type="text" required="required" class="form-control" name = "title" placeholder="Title Name" />
        </div>
        <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
		<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>


    <div class="panel panel-primary setup-content" id="step-3">
      <div class="panel-heading">
        <h3 class="panel-title">Author information</h3>
      </div>

      <div class="panel-body">

        <!-- Dynamic Field -->
        <div class="controls rpt">
          <h3>Details</h3>
          <div class="entry">

			    <div class="form-group col-md-6">
			       <label class="control-label">Title *</label>
             <select class="form-control" required="required" name = "myList[]">
               <option value="" disabled selected>Select your Title</option>
			         <option value = "Mr">Mr</option>
               <option value = "Mrs">Mrs</option>
               <option value = "Miss">Miss</option>
               <option value = "Dr">Dr</option>
			         <option value = "Prof">Prof</option>
             </select>
			     </div>
            <div class="form-group col-md-6">
              <label class="control-label">First Name *</label>
              <input class="form-control" maxlength="100" placeholder="First Name" required="required" type="text" name="first_name[]">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Other Name</label>
              <input class="form-control" maxlength="100" placeholder="Middle Name" type="text" name="middle_name[]">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Last Name *</label>
              <input class="form-control" maxlength="100" placeholder="Last Name" required="required" type="text" name="last_name[]">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Academic Degree's</label>
              <input class="form-control" maxlength="100" placeholder="Degress's" type="text" name="academic_degree[]">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Email *</label>
              <input class="form-control" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" required="required" type="text" name="email[]">
            </div>
           

            <button class="btn btn-success btn-add" type="button">Add Author</button>
            <hr>

          </div>
        </div>

        <!-- Dynamic Field End -->
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>

    <div class="panel panel-primary setup-content" id="step-4">
      <div class="panel-heading">
        <h3 class="panel-title">Submit Abstract</h3>
      </div>
      <div class="panel-body">	  	  		
        <div class="form-group">
              <textarea class="form-control" id="text" name="post_abstract" placeholder="Type in your message" style="width:100%;"></textarea>
              <h6 class="pull-right">200 words</h6>
              <button class="btn btn-info" type="submit" >Post Abstract</button>

        </div>
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>


    <div class="panel panel-primary setup-content" id="step-5">
      <div class="panel-heading">
        <h3 class="panel-title">Enter Key words</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label">Enter key words (MAX:5) separated by semi-colon(;)</label>
          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter key words" id="key_words" name="key_words" onkeyup="checkKey(this.value)" />
        </div>
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>


    <div class="panel panel-primary setup-content" id="step-6">
      <div class="panel-heading">
        <h3 class="panel-title">Select Classifications</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
			<label>Select Classifications</label>
			<select name = "classification">
               <option value="" disabled selected>Select Submission Classifications</option>
			   <option value = "Agriculture">Agriculture</option>
			   <option value = "Biology">Biology</option>
               <option value = "Chemistry">Chemistry</option>
			   <option value = "Climate Change">Climate Change</option>
			   <option value = "Computer Science">Computer Science</option>
			   <option value = "Engineering">Engineering</option>
			   <option value = "Geography">Geography</option>
			   <option value = "Marine and Earth Sciences">Marine and Earth Sciences</option>
               <option value = "Physics">Physics</option>
               <option value = "Mathematics">Mathematics</option>
			   <option value = "Computer Science">Statistics</option>
			   <option value = "Information Science">Information Science</option>
            </select>
        </div>
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>

    <div class="panel panel-primary setup-content" id="step-7">
      <div class="panel-heading">
        <h3 class="panel-title">Add reviewers</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
        <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-row">
					<div class="form-group col-md-6">
					<label>Title *</label>
					 <select required="required" name = "reviewer_title[]">
					   <option value="" disabled selected>Select your Title</option>
					   <option value = "Mr">Mr</option>
					   <option value = "Mrs">Mrs</option>
					   <option value = "Miss">Miss</option>
					   <option value = "Dr">Dr</option>
					   <option value = "Prof">Prof</option>
					 </select>
					</div>
                    <div class="form-group col-md-6">
                        <label class="control-label">First Name *</label>
                                <input class="form-control" maxlength="100" placeholder="First Name" required="required" type="text" name="reviewer_firstname[]" >
                    </div>
                    <span></span>
                    <div class="form-group col-md-6">
                        <label class="control-label">Other Name</label>
                                <input class="form-control" maxlength="100" placeholder="Middle Name"  type="text" name="reviewer_middlename[]">
                    </div>
                    <span></span>
                    <div class="form-group col-md-6">
                        <label class="control-label">Last Name *</label>
                    <input class="form-control" maxlength="100" placeholder="Last Name" required="required" type="text" name="reviewer_lastname[]">
                    </div>
                    <span></span>
                    <div class="form-group col-md-6">
                        <label class="control-label">Academic Degree *</label>
                                <input class="form-control" maxlength="100" placeholder="Degress's" type="text" name="reviewer_degree[]">
                    </div>
                    <span></span>
                    <span></span>
                    <div class="form-group col-md-6">
                        <label class="control-label">Email *</label>
                    <input class="form-control" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" required="required" type="text" name="reviewer_email[]">
                    </div>					
                    <span></span>
					<div class="form-group col-md-6">
                        <label class="control-label">Reason *</label>
                    <input class="form-control" maxlength="100" placeholder="Reason to chose this Reviewer" required="required" type="text" name="reviewer_reason[]">
                    </div>
                    <span></span>
                    <div class="form-group col-md-6">
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                    <span></span>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                     <hr>
                     </div>
                    <span></span>
                </div>  <!-- /div.form-inline -->
               
            </div>  <!-- /div[data-role="dynamic-fields"] -->
        </div>  <!-- /div.col-md-12 -->
    </div>  <!-- /div.row -->
</div>


        </div>
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
      </div>
    </div>



    <div class="panel panel-primary setup-content" id="step-8">
      <div class="panel-heading">
        <h3 class="panel-title">Upload Files here</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
			<label class="control-label">Select Manuscript to upload:</label>
			<input type="file" name="manuscript_file" id="manuscript_file">
			<label class="control-label">Select Higlights to upload:</label>
			<input type="file" name="highlight_file" id="highlight_file">
			<label class="control-label">Select Cover Letter to upload:</label>
			<input type="file" name="coverletter_file" id="coverletter_file">
         <div class="form-group col-md-6">
         </div>
        </div>
		<button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
        <button class="btn btn-primary" type="submit" id ="submit" name="submit">Finish!</button>
      </div>
    </div>

  </form>

</div>
</div></div>
            </div>
        </section>
   
    <footer class="page-footer dark">
        <div class="container">
            <div class="row"></div>
        </div>
        <div class="footer-copyright">
            <p>© 2018 Copyright Text</p>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/dropzone-amd-module.min.js"></script>
    <script src="assets/js/dropzone.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/jquery-3.0.0.js"></script>
    <script src="assets/js/jquery-3.1.0.js"></script>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-3.2.0.js"></script>
    <script src="assets/js/jquery-3.2.1.js"></script>
    <script src="assets/js/jquery-3.3.0.js"></script>
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/countrypicker.js"></script>
</body>

</html>

<script>
function checkKey(str)
{
	var s1;

}
</script>

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            alert('not allowed');
            return false;
        } else {
            return true;
        }
};
</script>