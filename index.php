<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <!--   <meta name="viewport" content="width=device-width, initial-scale=1"> -->
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
<div class="jumbotron" style=" background-image: url('images/jumbotronlightgrad.jpg');
    background-repeat: no-repeat;">

 <h2 class="jthead"><img src="images/esportsdesignswarmmed.png"></h2>
    <p class="jthead"><strong>The best place around for all your eSports graphics needs</strong></p>
    <p class="jthead">The Only eSports focused design contest site</p>
 <!--   <p class="jthead"><a href="howitworks.html"><img src="images/HowItWorksbuttonnobrsmall.png"></a></p> -->


</div>
</div>
<div class="container" style="padding:10px; margin:10px auto">
    <p class="jthead">We are looking for premium designers for our launch</p>
    <p class="jthead">Contact Us Today!</p>
    <p class="jthead"><a href="http://www.zendesignz.us/codenameswarm.html"><img src="images/clickherebuttonsmall2.png"></a></p>
</div>


<!-- <iframe width="560" height="315" src="//www.youtube.com/embed/CeylpMtLz5w" frameborder="0" allowfullscreen></iframe> -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:825px; margin:auto;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" data-interval="4000" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="images/Carousel/carousel1.jpg" alt="ad">
            <div class="carousel-caption">

            </div>
        </div>
        <div class="item">
            <img src="images/Carousel/carousel2.jpg" alt="ad">
            <div class="carousel-caption">

            </div>
        </div>
        <div class="item">
            <img src="images/Carousel/carousel3.jpg" alt="ad">
            <div class="carousel-caption">

            </div>
        </div>
        <div class="item">
            <img src="images/Carousel/carousel4.jpg" alt="ad">
            <div class="carousel-caption">

            </div>
        </div>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
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