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
            <a class="navbar-brand" href="index.php"><img class="navlogo" src="images/esports%20design%20swarm%20small.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="howitworks.php">How it works</a></li>
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
               <!-- <li><a href="#">Start Contest</a></li>
                <li><a href="#">Forums</a></li> -->
                <li href="#contact" data-toggle="modal"><a href="#">Contact Us</a></li>

            </ul>

           <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="modal fade" id="contact" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class= "modal-header">
                <h3><strong>Contact eSports Design Swarm</strong></h3>

            </div>
            <div class="modal-body">
                <form id="contact-form">
                    <div class="success">Contact form submitted!<br>
                        <strong>We will be in touch soon.</strong>
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