
<?php
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: message.php?msg=You are already logged in");
    exit();
}
?><?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("php_includes/db_connects.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }
}
?><?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_connects.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = $_POST['p'];
	$dorc = preg_replace('#[^a-z]#', '', $_POST['dorc']);
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == "" || $dorc == "" || $c == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){
        echo "The username you entered is already taken";
        exit();
	} else if ($e_check > 0){
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit();
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {
	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
		// Hash the password and apply your own mysterious unique salt
		$cryptpass = crypt($p);
		include_once ("php_includes/randStrGen.php");
		$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
		// Add user info into the database table for the main site table
		$sql = "INSERT INTO users (username, email, password, dorc, country, ip, signup, lastlogin, notescheck)
		        VALUES('$u','$e','$p_hash','$dorc','$c','$ip',now(),now(),now())";
		$query = mysqli_query($db_conx, $sql);
		$uid = mysqli_insert_id($db_conx);
		// Establish their row in the useroptions table
		$sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		$query = mysqli_query($db_conx, $sql);
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0755);
		}
		// Email the user their activation link
		echo "signup_success";
		$to = "$e";
		$from = "info@esportsdesignswarm.com";
		$subject = 'DO NOT REPLY eSports Design Swarm Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>eSports Design Swarm Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.esportsdesignswarm.com"><img src="http://www.esportsdesignswarm.com/images/esportsdesignswarmdarkoutlinemed.png" width="36" height="30" alt="esportsdesignswarm" style="border:none; float:left;"></a>eSports Design Swarm Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://www.esportsdesignswarm.com/activation.php?id='.$uid.'&u='.$u.'&e='.$e.'&p='.$p_hash.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
		$headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);

		exit();
	}
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSports Design Swarm</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Orbitron:400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
    <script>
    function restrict(elem){
    	var tf = _(elem);
    	var rx = new RegExp;
    	if(elem == "email"){
    		rx = /[' "]/gi;
    	} else if(elem == "username"){
    		rx = /[^a-z0-9]/gi;
    	}
    	tf.value = tf.value.replace(rx, "");
    }
    function emptyElement(x){
    	_(x).innerHTML = "";
    }
    function checkusername(){
    	var u = _("username").value;
    	if(u != ""){
    		_("unamestatus").innerHTML = 'checking ...';
    		var ajax = ajaxObj("POST", "signup.php");
            ajax.onreadystatechange = function() {
    	        if(ajaxReturn(ajax) == true) {
    	            _("unamestatus").innerHTML = ajax.responseText;
    	        }
            }
            ajax.send("usernamecheck="+u);
    	}
    }
    function signup(){
    	var u = _("username").value;
    	var e = _("email").value;
    	var p1 = _("pass1").value;
    	var p2 = _("pass2").value;
    	var c = _("country").value;
    	var dorc = _("dorc").value;
    	var status = _("status");
    	if(u == "" || e == "" || p1 == "" || p2 == "" || c == "" || dorc == ""){
    		status.innerHTML = "Fill out all of the form data";
    	} else if(p1 != p2){
    		status.innerHTML = "Your password fields do not match";
    	} else if( _("terms").style.display == "none"){
    		status.innerHTML = "Please view the terms of use";
    	} else {
    		_("signupbtn").style.display = "none";
    		status.innerHTML = 'please wait ...';
    		var ajax = ajaxObj("POST", "signup.php");
            ajax.onreadystatechange = function() {
    	        if(ajaxReturn(ajax) == true) {
    	            if(ajax.responseText != "signup_success"){
    					status.innerHTML = ajax.responseText;
    					_("signupbtn").style.display = "block";
    				} else {
    				    window.scrollTo(0,0);
    					_("signupform").innerHTML = "Welcome to the Swarm "+u+", check your email inbox and junk mail box at <u>"+e+"</u> to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
    				}
    	        }
            }
            ajax.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&dorc="+dorc);
    	}
    }
    function openTerms(){
    	_("terms").style.display = "block";
    	emptyElement("status");
    }
    /* function addEvents(){
    	_("elemID").addEventListener("click", func, false);
    }
    window.onload = addEvents; */
    </script>
</head>
<body style="padding-bottom: 70px; padding-top: 70px">
<!-- Navbar -->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img class="navlogo" src="images/esports%20design%20swarm%20small.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="howitworks.html">How it works</a></li>
               <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Categories</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logo</a></li>
                        <li><a href="#">Social Media Package</a></li>
                        <li><a href="#">Twitch TV Package</a></li>
                        <li><a href="#">Banners/Advertising</a></li>
                        <li><a href="#">GIFs</a></li>
                        <li><a href="#">Intros</a></li>
                        <li><a href="#">Video Editing</a></li>
                        <li><a href="#">Small Website Design</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li> -->
                <!--  <li><a href="#">Start Contest</a></li>
                  <li><a href="#">Forums</a></li> -->
                <li href="#contact" data-toggle="modal"><a href="#">Contact Us</a></li>

            </ul>

           <!-- <ul class="nav navbar-nav navbar-right">
                <li> <a href="#">Register</a></li>
                <li href="#signin" data-toggle="modal"><a href="#">Sign In</a></li> -->

              <!--  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign In <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><form class="navbar-form navbar-left" role="textbox">
                            <div class="form-group" >
                                <input type="text" class="form-control" placeholder="Username">
                            </div>

                        </form></li>
                        <li><form class="navbar-form navbar-left" role="textbox">
                            <div class="form-group" >
                                <input type="password" class="form-control" placeholder="Password">
                            </div>

                        </form></li>
                        <label class="remember">
                            <input type="checkbox" value="">
                            Remember me
                        </label>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li> -->
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="jumbotron" style="background-image: url('images/jumbotronlightgrad3.jpg')">
    <div class="row" style="margin-bottom:0px; margin-top:30px;text-align: center;">
        <div class="col-lg-12">
        <h2 style="font-family: 'orbitron', sans-serif"><strong>Become Part of the Swarm:</strong> </h2>
    <div class="container">
     <form name="signupform" id="signupform" onsubmit="return false;" role="form">
                    <div class="row">
                        <div class="col-lg-offset-2 col-lg-4">
                            <label for="username"> Username </label>
                            <input type="username" class="form-control" id="username" placeholder="Enter Username">
                        </div>
                    <div class="col-lg-offset-0 col-lg-4">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>

                 </div>
                <div class="row">
                <div class="col-lg-offset-2 col-lg-4">
                    <label for="pass1">Password</label>
                    <input type="password" class="form-control" id="pass1" placeholder="Password">
                </div>
                <div class="col-lg-offset-0 col-lg-4">
                    <label for="pass2">Confirm Password</label>
                    <input type="password" class="form-control" id="pass2" placeholder="Confirm Password">
                </div>
                </div>
                <div>Designer or Client:</div>
                <select id="dorc" onfocus="emptyElement('status')">
                    <option value=""></option>
                    <option value="d">Designer</option>
                    <option value="c">Client</option>
                </select>
                <div>Country:</div>
                <select id="country" onfocus="emptyElement('status')">
                    <?php include_once("php_includes/template_country_list.php"); ?>
                </select>


                    <br /><br />
                      <div style="text-align:center; text-decoration:none;">
                                      <a href="#" id="terms" onclick="return false" onmousedown="openTerms()">
                                       <a href="legal.html" target="_blank" id="terms"> View the Terms Of Use </a>
                                       <a href="rules.html" target="_blank" id="terms"> View Our Rules </a>
                                       </a>
                                    </div></br>

                   <a id="signupbtn" onclick="signup()"><img src="images/JointheSWARMbuttonsmall.png"></a></br>
                    <span id="status"></span>
            </form>

    </div>


        </div>
    </div>



       <!--  <p class="jthead"><a href="#" class="btn btn-success btn-lg" role="button" id="signupbtn" onclick="signup()">Sign Up</a></p>
        <h2 class="jthead"> Sign up with: <img class="signup" src="images/facebooksmall.png"><img class="signup" src="images/googlesmall.jpg"><img class="signup" src="images/twittersmall.jpg"></h2> -->
</div>
</div>

<div>

</div>
<div class = "navbar navbar-default navbar-inverse navbar-fixed-bottom " >
    <div class ="container">
        <p class="navbar-text pull-left">&copy esportsdesignswarm 2014</p>
        <ul class="nav navbar-nav">
        <p class="navbar-text">Site map:</p>
            <li><a  href="index.html">Index </a></li>
           <li> <a href="howitworks.html">How It Works </a></li>
           <li><a href="legal.html">Our Policies and User Agreement</a> </li>
                       <li><a href="rules.html">Rules of Use</a></li>
            <!-- <li> <a  href="categories.html">Categories </a></li> -->
            <li> <a  href="signup.php">Sign Up</a></li>
        </ul>
    </div>

</div>


<div class="modal fade" id="contact" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class= "modal-header">
                <h3><strong>Contact eSports Design Swarm</strong></h3>

            </div>
            <div class="modal-body">
                <form id="contact-form">
                    <div class="success">Contact form submitted!<br>
                        <strong>I will be in touch soon.</strong>
                    </div>

                    <label class="name clearfix">
                        <input type="text" value="Your Name:">
                        <span class="error">*This is not a valid name.</span><span class="empty">*This field is required.</span>
                    </label>

                    <label class="email clearfix">
                        <input type="text" value="E-mail:">
                        <span class="error">*This is not a valid email address.</span> <span class="empty">*This field is required.</span>
                    </label>
                    <label class="message clearfix">
                        <textarea>Message:</textarea>
                        <span class="error">*The message is too short.</span> <span class="empty">*This field is required.</span>
                    </label><br>
                    <div class="modal-footer">
                        <a href="#" data-type="submit" class="btn btn-success pull-left" >Submit</a>  &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" data-type="reset" class="btn btn-success pull-left" >Reset</a>
                        <a href="#" class="btn btn-success pull-right" data-dismiss = "modal"> Close</a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="signin" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class= "modal-header">
                <h3><strong>Sign In:</strong></h3>

            </div>
            <div class="modal-body">
                <form id="contact-form">

                    <label class="name clearfix">
                        <input type="text" value="Username">
                        <span class="error">*This is not a valid name.</span><span class="empty">*This field is required.</span>
                    </label>

                    <label class="email clearfix">
                        <input type="text" value="Password">
                        <span class="error">*This is not a valid password.</span> <span class="empty">*This field is required.</span>
                    </label>

                    <div class="modal-footer">
                        <a href="#" data-type="submit" class="btn btn-success pull-left" >Sign In</a>  &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-success pull-right" data-dismiss = "modal"> Close</a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/forms.js"></script>
</body>
</html>