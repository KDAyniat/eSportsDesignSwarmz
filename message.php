<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "activation_failure"){
	$message = '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
} else if($msg == "activation_success"){
	$message = '<h2>Activation Successful</h2></br><h4> <li style="list-style-type:none;" href="#signin" data-toggle="modal"><a href="#">Click here to log in</a></li></h4>';
} else {
	$message = $msg;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>eSports Design Swarm - How it works</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
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

function emptyElement(x){
    _(x).innerHTML = "";
    }
function login(){
    var e = _("email").value;
    var p = _("password").value;
    if(e == "" || p == ""){
    _("status").innerHTML = "Fill out all of the form data";
    } else {
    _("loginbtn").style.display = "none";
    _("status").innerHTML = 'please wait ...';
    var ajax = ajaxObj("POST", "php_includes/login_include.php");
    ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
    if(ajax.responseText == "login_failed"){
    _("status").innerHTML = "Login unsuccessful, please try again.";
    _("loginbtn").style.display = "block";
    } else {
    window.location = "user.php?u="+ajax.responseText;
    }
    }
    }
    ajax.send("e="+e+"&p="+p);
    }
    }



    </script>
</head>
<body style="height:900px;margin-top:70px;">
<?php include_once("php_includes/pageTop.php"); ?>
<div class="container" style="padding-top:50px;margin-top;50px;">
<div class="jumbotron" style="margin:auto;background-image:url(images/jumbotronlightgrad3small.jpg); background-repeat:no-repeat;height:508px; width:1000px;">

<div style="text-align:center;padding:100px"><?php echo $message; ?></div>

</div>
</div>
<?php include_once("php_includes/pageBottom.php"); ?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/forms.js"></script>
</body>
</html>