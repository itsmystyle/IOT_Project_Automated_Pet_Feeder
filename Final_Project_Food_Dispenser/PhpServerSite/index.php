<?php
	session_start();
	error_reporting(0);

  include 'connection.php';

		$error = false;

		if ($_SERVER['REQUEST_METHOD'] != "POST"){
			
		}
		else {
  		if(!empty($_POST['user_name'])){
          //the user name exists
          if(!ctype_alnum($_POST['user_name'])){
              //$errors[] = 'The username can only contain letters and digits.';
  			       echo '<script>window.alert("The username can only contain letters and digits.")</script>';
               $error = true;
          }
          
          if(strlen($_POST['user_name']) > 15){
              //$errors[] = 'The username cannot be longer than 15 characters.';
  			       echo '<script>window.alert("The username cannot be longer than 15 characters.")</script>';
               $error = true;
          }

          if(strlen($_POST['user_name']) < 6){
              //$errors[] = 'The username must be at least 6 characters.';
  			       echo '<script>window.alert("The username must be at least 6 characters.")</script>';
               $error = true;
          }

  	    }else{
  	        //$errors[] = 'The username field must not be empty.';
  			     echo '<script>window.alert("The username field must not be empty")</script>';
             $error = true;
  	    }

  	    if(!empty($_POST['user_pass']) && !empty($_POST['user_pass_check'])){
  	    	//make sure password is right
  	        if($_POST['user_pass'] != $_POST['user_pass_check']){
  	            //$errors[] = 'The two passwords did not match.';
  				    echo '<script>window.alert("The two passwords did not match.")</script>';
              $error = true;
  	        }
  	    }else{
  	        //$errors[] = 'The password and reconfimation password fields must not be empty.';
  			   echo '<script>window.alert("The password and reconfimation password fields must not be empty.")</script>';
           $error = true;
  	    }

  	    if($error){
  	    	exit();
          
  	    }else{

  	    	function getGUID(){
  		        if (function_exists('com_create_guid')){
  		            return com_create_guid();
  		        }else{
  		            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
  		            $charid = strtoupper(md5(uniqid(rand(), true)));
  		            $hyphen = chr(45);// "-"
  		            $uuid = substr($charid, 0, 8).$hyphen
  		                .substr($charid, 8, 4).$hyphen
  		                .substr($charid,12, 4).$hyphen
  		                .substr($charid,16, 4).$hyphen
  		                .substr($charid,20,12);// "}"
  		            return $uuid;
  		        }
  		    }

  		    $GUID = getGUID();

  	    	$sql = "INSERT INTO 
      						internetofthing_users(
      							user_name, 
      							user_pass, 
      							user_email, 
      							user_access_token) 
  					VALUES 
  							('" . mysqli_real_escape_string($conn, $_POST['user_name']) . "', 
  							'" . sha1($_POST['user_pass']) . "', 
  							'" . mysqli_real_escape_string($conn, $_POST['user_email']) . "', 
  							'" . mysqli_real_escape_string($conn, $GUID) . "')";

  			$result = mysqli_query($conn, $sql);

  			if(!$result){
  				echo '<script>window.alert("Unable to register. Please contact us!")</script>';
  			}else{
  				echo '<script>window.alert("Registered Account Successfully")</script>';
  			}
	    }
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme The Band</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px/1.8 Lato, sans-serif;
      color: #777;
  }
  h3, h4 {
      margin: 10px 0 30px 0;
      letter-spacing: 10px;      
      font-size: 20px;
      color: #111;
  }
  .container {
      padding: 80px 120px;
  }
  .person {
      border: 10px solid transparent;
      margin-bottom: 25px;
      width: 80%;
      height: 80%;
      opacity: 0.7;
  }
  .person:hover {
      border-color: #f1f1f1;
  }
  .carousel-inner img {
      width: 50%; /* Set width to 100% */
      margin: auto;
  }
  .carousel-caption h3 {
      color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
  }
  .bg-1 {
      background: #2d2d30;
      color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
      border-top-right-radius: 0;
      border-top-left-radius: 0;
  }
  .list-group-item:last-child {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail p {
      margin-top: 15px;
      color: #555;
  }
  .btn {
      padding: 10px 20px;
      background-color: #333;
      color: #f1f1f1;
      border-radius: 0;
      transition: .2s;
  }
  .btn:hover, .btn:focus {
      border: 1px solid #333;
      background-color: #fff;
      color: #000;
  }
  .modal-header, h4, .close {
      background-color: #333;
      color: #fff !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-header, .modal-body {
      padding: 40px 50px;
  }
  .nav-tabs li a {
      color: #777;
  }
  .navbar {
      font-family: Montserrat, sans-serif;
      margin-bottom: 0;
      background-color: #0d0d50;
      border: 0;
      font-size: 11px !important;
      letter-spacing: 4px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #2d2d30;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }  
  .form-control {
      border-radius: 0;
  }
  textarea {
      resize: none;
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand navbar-right" href="#myPage">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#pet24">PET24</a></li>
        <li><a href="#signup" title="Sign Up to Activate Your Product Today">SIGN UP!</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="prototype.jpg" alt="Our Prototype" width="600px" height="350px">
        <div class="carousel-caption">
          <h3>Our Prototype</h3>
          <p>This is a rough estimate of how our feeder will look like.</p>
        </div>      
      </div>

      <div class="item">
        <img src="app.png" alt="app" width="600px" height="350px">
        <div class="carousel-caption">
          <h3>Our Priend App</h3>
          <p>This app allows you to feed your pets from anywhere in the world, whenever you want to.</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="app.png" alt="sexyboi" width="600px" height="350px">
        <div class="carousel-caption">
          <h3>what's up</h3>
          <p>im sexy and i know it.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="pet24" class="container text-center">
  <h3>PET24</h3>
  <p><em>24 hours, anywhere, anytime, on your demand</em></p>
  <p>With our product, you will never have to worry about taking those long vacations and leaving your pets alone at home. With a click of a button, you have the power to feed your pets from anywhere in the world through the wonders of the IOT.</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>CEO Sohai Chai</strong></p><br>
      <a href="#demo" data-toggle="collapse">
        <img src="fatkid1.jpg" class="img-circle person" alt="CEO Sohai Chai" width="255" height="255">
      </a>
      <div id="demo" class="collapse">
        <p>Loves his girlfriend more than his friend</p>
        <p>Loves Nasi Lemak</p>
        <p>Director of this project.</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Slave Lee</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="fatkid2.jpg" class="img-circle person" alt="Gavin Lee" width="255" height="255">
      </a>
      <div id="demo2" class="collapse">
        <p>Wants to make babies</p>
        <p>Also known as Boss 30cm</p>
        <p>Buys lunch for CEO Sohai Chai</p>
      </div>
    </div>
  </div>
</div>

<!-- Container (Signup Section) -->
<div id="signup" class="bg-1">
  <div class="container">
    <h3 class="text-center">Sign Up Today!</h3>
    <p class="text-center">Sign up now to activate your Feeder!<br> Remember to record your Device ID</p>
    
    <div class="row text-center">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="thumbnail">
          <img src="cat.jpg" alt="San Francisco" width="400" height="300">
          <p><strong>LALALA</strong></p>
          <p>Click on the SignUp button to register</p>
          <button class="btn" data-toggle="modal" data-target="#myModal">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Sign Up!</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="form-group">
              <label for="user_name"><span class="glyphicons glyphicons-user"></span>UserName</label>
              <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your username">
            </div>
            <div class="form-group">
              <label for="user_pass"><span class="glyphicons glyphicons-snowflake"></span>User Password</label>
              <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Enter your password">
            </div>
			<div class="form-group">
              <label for="user_pass_check"><span class="glyphicons glyphicons-snowflake"></span>User Password Validation</label>
              <input type="password" class="form-control" name="user_pass_check" id="user_pass_check" placeholder="Re-Enter your password">
            </div>
			<div class="form-group">
              <label for="user_email"><span class="glyphicons glyphicons-message-full"></span>User Email</label>
              <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Enter your Email">
            </div>
              <button type="submit" class="btn btn-block">Submit 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>We love our fans!</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Fan? Drop a note.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Chicago, US</p>
      <p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  <h3 class="text-center">Some Words From Our Creators</h3>  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Yuan Chai</a></li>
    <li><a data-toggle="tab" href="#menu1">Gavin Lee</a></li>
    <li><a data-toggle="tab" href="#menu2">John Cena</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Yuan Chai</h2>
      <p>Boss Man</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h2>Gavin Lee</h2>
      <p>Im So fucking hungry and so tired. i want to sleep.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h2>John Cena</h2>
      <p>You can't see me</p>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" data-toggle="tooltip" title="Visit w3schools">www.w3schools.com</a></p> 
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>

