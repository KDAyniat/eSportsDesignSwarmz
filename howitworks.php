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
            <script src="js/login.js"></script>

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
<body style="padding-bottom: 70px; padding-top: 70px">
<?php include_once("php_includes/pageTop.php"); ?>
<div class="container">
    <div class="jumbotron" style=" background-image: url('images/jumbotronlightgrad2.jpg');
    background-repeat: no-repeat;">
        <h2 class="jthead"><img style="margin-top: 0" src="images/esportsdesignswarmmed.png"></h2>
        <h2 class="jthead">How it works:</h2>
        <div id="hiwdiv">
        <p> eSports Design Swarm is the easiest and most cost-effective way to get your design project created.
         Name your price, then watch as our talented swarm of designers submit to your project. </p>
         <p>When the time limit is up, you pick your favorite design.
        We encourage clients to participate in the design process so we have incorporated a feedback and rating system, as well as some nifty features we think you will love.
        </p>
        <p><strong> We offer a 100% money-back guarantee if for any reason you are not satisfied with the submitted designs. </strong></p>
       <!-- <p class="jthead"><a href="signup.php" class="btn btn-success btn-lg" role="button">Get Started</a></p> -->
        </div>
    </div>
</div>


<div class= "container" style="padding-bottom: 30px; margin-bottom: 30px">
    <div class="row">

        <div class="col-sm-4" >
            <h3 style="text-align: center" class="subheadings">Logos</h3>
            <h2 style="text-align: center" class="subheadings"> <span class="glyphicon glyphicon-fire"></span></h2>
        </div>
        <div class="col-sm-4">
            <h3 style="text-align: center" class="subheadings">Cover Images</h3>
            <h2 style="text-align: center" class="subheadings"><span class="glyphicon glyphicon-send"></span></h2>

        </div>
        <div class="col-sm-4">
            <h3 style="text-align: center" class="subheadings">Team Websites</h3>
            <h2 style="text-align: center" class="subheadings"><span class="glyphicon glyphicon-search"></span></h2>

        </div>


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